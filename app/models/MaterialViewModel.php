<?php

class MaterialViewModel extends Model
{
    public function __construct(string $table = 'material_view')
    {
        parent::__construct($table);

    }

    public function show($document_type = 'note', $page = 1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $current_user = Session::get('user')['user_id'] ?? null;
        // It performs a left join with the 'follow_relation' table (alias 'fr') on the condition that the 'following_id' in 'fr' matches the 'user_id' in 'mv'.
        // The selection is further filtered by the 'where' clause which checks for three conditions:
        // 1. The 'document_type' in 'mv' matches the provided 'document_type'.
        // 2. The 'user_id' in 'mv' matches the provided 'current_user'.
        // 3. The material is not private ('mv.private' is 0) OR the material is private ('mv.private' is 1) but the 'follower_id' in 'fr' matches the provided 'current_user'.
        // The function binds the 'document_type' and 'current_user' parameters to the query, paginates the results (10 per page), and returns all matching records.

        return $this->select([
            'DISTINCT mv.*'
        ], 'mv')
            ->leftJoin('follow_relation as fr', 'fr.following_id = mv.user_id')
            ->where('mv.document_type = :document_type AND mv.status <> :status AND (mv.user_id = :current_user OR mv.private = 0 OR (mv.private = 1 AND fr.follower_id = :current_user))')
            ->bind([
                'document_type' => $document_type,
                'current_user' => $current_user,
                'status' => 'suspend'
            ])
            ->limit($limit)
            ->offset($offset)
            ->getAll();

    }
    public function view($material_id)
    {

        return $this->select([
            'mv.*'
        ], 'mv')
            ->where('mv.material_id = :material_id')
            ->bind(['material_id' => $material_id])
            ->get();
    }
    public function showAdmin()
    {
        return $this->select([
            'DISTINCT mv.*'
        ], 'mv')
            ->where('mv.status <> :status')
            ->bind(['status' => 'suspend'])
            ->limit(10)
            ->getAll();
    }

    //shows suspended materials too in owner's profile
    public function showUploadsByCurrentUser($document_type = 'note')
    {
        $current_user = Session::get('user')['user_id'] ?? null;
        return $this->select([
            'mv.*'
        ], 'mv')
            ->where('mv.user_id = :current_user AND mv.document_type = :document_type')
            ->bind(['current_user' => $current_user, 'document_type' => $document_type])
            ->groupBy('mv.material_id')
            ->limit(10)
            ->getAll();
    }

    // does not show suspended materials while viewing other profiles
    public function showUploadsByUserId($user_id, $document_type = 'note')
    {
        return $this->select([
            'mv.*'
        ], 'mv')
            ->where('mv.user_id = :user_id AND mv.document_type = :document_type AND mv.status <> :status')
            ->bind(['user_id' => $user_id, 'document_type' => $document_type, 'status' => 'suspend'])
            ->groupBy('mv.material_id')
            ->limit(10)
            ->getAll();
    }

    public function getMaterialDetailById($material_id)
    {
        return $this->select([
            'mv.*'
        ], 'mv')
            ->where('mv.material_id = :material_id')
            ->bind(['material_id' => $material_id])
            ->get();
    }


    public function searchSuggestions($search)
    {
        return $this->select([
            'DISTINCT mv.title',
        ], 'mv')
            ->where('(
                mv.title LIKE :search 
            OR mv.subject LIKE :search 
            OR mv.author LIKE :search
            OR mv.class_faculty LIKE :search
            OR mv.semester LIKE :search
            OR mv.education_level LIKE :search
            )
            AND mv.status <> :status')
            ->bind([
                'search' => "%$search%",
                'status' => 'suspend'
            ])
            ->limit(10)
            ->getAll();

    }
    public function search($search, $document_type = 'note')
    {
        $current_user = Session::get('user')['user_id'] ?? null;
        return $this->select([
            'DISTINCT mv.*'
        ], 'mv')
            ->leftJoin('follow_relation as fr', 'fr.following_id = mv.user_id')
            ->where('(
                mv.title LIKE :search 
            OR mv.subject LIKE :search 
            OR mv.author LIKE :search
            OR mv.class_faculty LIKE :search
            OR mv.semester LIKE :search
            OR mv.education_level LIKE :search
            )
            AND mv.document_type = :document_type
            AND (mv.user_id = :current_user OR mv.private = 0 OR (mv.private = 1 AND fr.follower_id = :current_user))
            AND mv.status <> :status')
            ->bind([
                'search' => "%$search%",
                'document_type' => $document_type,
                'current_user' => $current_user,
                'status' => 'suspend'
            ])
            ->limit(10)
            ->getAll();
    }
}