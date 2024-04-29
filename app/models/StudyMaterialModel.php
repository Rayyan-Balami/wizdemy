<?php

class StudyMaterialModel extends Model
{

    public function __construct(string $table = 'study_materials')
    {
        parent::__construct($table);
        $this->fillable = [
            'user_id',
            'request_id',
            'title',
            'description',
            'document_type',
            'format',
            'education_level',
            'semester',
            'subject',
            'class_faculty',
            'author',
            'file_path',
            'status',
            'thumbnail_path',
            'deleted_at'
        ];
    }

    public function baseQuery()
    {
        return $this->select([
            'DISTINCT m.*',
            'u1.private',
            'u1.username',
            'u1.deleted_at as user_deleted_at',
            'u1.status as user_status',
            'u2.username as responded_to',
            'COUNT(DISTINCT l.like_id) as likes_count',
            'COUNT(DISTINCT c.comment_id) as comments_count',
            'COUNT(DISTINCT v.view_id) as views_count'
        ], 'm')
            ->leftJoin('users as u1', 'u1.user_id = m.user_id')
            ->leftJoin('study_material_requests as r', 'r.request_id = m.request_id')
            ->leftJoin('users as u2', 'u2.user_id = r.user_id')
            ->leftJoin('likes as l', 'l.material_id = m.material_id')
            ->leftJoin('comments as c', 'c.material_id = m.material_id')
            ->leftJoin('views as v', 'v.material_id = m.material_id')
            ->leftJoin('follow_relation as fr', 'fr.following_id = m.user_id');
    }

    public function show($document_type = 'note', $page = 1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $current_user = Session::get('user')['user_id'] ?? null;

        return $this->baseQuery()
            ->where('(
                        m.document_type = :document_type
                    AND (m.user_id = :current_user OR u1.private = 0 OR (u1.private = 1 AND fr.follower_id = :current_user))
                    AND m.status <> :status
                    AND u1.status <> :status
                    AND u1.deleted_at IS NULL)
                    ')
            ->bind([
                'document_type' => $document_type,
                'current_user' => $current_user,
                'status' => 'suspend'
            ])
            ->groupBy('m.material_id')
            ->orderBy('m.created_at', 'DESC')
            ->limit($limit)
            ->offset($offset)
            ->getAll();
    }
    public function view($material_id)
    {

        return $this->baseQuery()
            ->where('(
                m.material_id = :material_id
            AND m.status <> :status
            AND u1.status <> :status
            AND u1.deleted_at IS NULL)
            ')
            ->bind([
                'material_id' => $material_id,
                'status' => 'suspend'
            ])
            ->groupBy('m.material_id')
            ->get();

    }
    //shows suspended materials too in owner's profile
    public function showUploadsByCurrentUser($document_type = 'note')
    {
        $current_user = Session::get('user')['user_id'] ?? null;

        return $this->baseQuery()
            ->where('(
                m.user_id = :current_user AND m.document_type = :document_type
            AND u1.deleted_at IS NULL)
            ')
            ->bind([
                'current_user' => $current_user,
                'document_type' => $document_type
            ])
            ->groupBy('m.material_id')
            ->orderBy('m.created_at', 'DESC')
            ->getAll();
    }

    // does not show suspended materials while viewing other profiles
    public function showUploadsByUserId($user_id, $document_type = 'note')
    {

        return $this->baseQuery()
            ->where('(
                m.user_id = :user_id AND m.document_type = :document_type
            AND m.status <> :status
            AND u1.status <> :status
            AND u1.deleted_at IS NULL)
            ')
            ->bind([
                'user_id' => $user_id,
                'document_type' => $document_type,
                'status' => 'suspend'
            ])
            ->groupBy('m.material_id')
            ->orderBy('m.created_at', 'DESC')
            ->getAll();
    }

    public function getMaterialDetailById($material_id)
    {

        return $this->baseQuery()
            ->where('(
                m.material_id = :material_id
            AND m.status <> :status
            AND u1.status <> :status
            AND u1.deleted_at IS NULL)
            ')
            ->bind([
                'material_id' => $material_id,
                'status' => 'suspend'
            ])
            ->groupBy('m.material_id')
            ->get();
    }

    public function getMaterialDetailByRequestId($request_id, $page = 1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;

        return $this->baseQuery()
            ->where('(
                m.request_id = :request_id
            AND m.status <> :status
            AND u1.status <> :status
            AND u1.deleted_at IS NULL)
            ')
            ->bind([
                'request_id' => $request_id,
                'status' => 'suspend'
            ])
            ->groupBy('m.material_id')
            ->limit($limit)
            ->offset($offset)
            ->getAll();
    }

    public function getTotalRespondedMaterials($request_id)
    {

        return $this->select([
            'COUNT(DISTINCT m.material_id) as total'
        ], 'm')
        ->leftJoin('users as u', 'u.user_id = m.user_id')
            ->where('m.request_id = :request_id
            AND m.status <> :status
            AND u.deleted_at IS NULL')
            ->bind(['request_id' => $request_id, 'status' => 'suspend'])
            ->get()['total'];
    }


    public function searchSuggestions($search)
    {

        return $this->select([
            'DISTINCT m.title',
        ], 'm')
            ->leftJoin('users as u', 'u.user_id = m.user_id')
            ->where('(
                m.title LIKE :search 
            OR m.description LIKE :search
            OR m.document_type LIKE :search
            OR m.format LIKE :search
            OR m.education_level LIKE :search
            OR m.subject LIKE :search 
            OR m.author LIKE :search
            OR m.class_faculty LIKE :search
            OR m.semester LIKE :search
            )
            AND m.status <> :status
            AND u.status <> :status
            AND u.deleted_at IS NULL')
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

        return $this->baseQuery()
            ->where('(
                m.title LIKE :search 
            OR m.description LIKE :search
            OR m.document_type LIKE :search
            OR m.format LIKE :search
            OR m.education_level LIKE :search
            OR m.subject LIKE :search 
            OR m.author LIKE :search
            OR m.class_faculty LIKE :search
            OR m.semester LIKE :search
            )
            AND m.document_type = :document_type
            AND (m.user_id = :current_user OR u1.private = 0 OR (u1.private = 1 AND fr.follower_id = :current_user))
            AND m.status <> :status
            AND u1.status <> :status
            AND u1.deleted_at IS NULL
            ')
            ->bind([
                'search' => "%$search%",
                'document_type' => $document_type,
                'current_user' => $current_user,
                'status' => 'suspend'
            ])
            ->groupBy('m.material_id')
            ->orderBy('m.created_at', 'DESC')
            ->getAll();
    }

    public function getMaterialsForAdmin($query, $page = 1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        return $this->select([
            'DISTINCT m.*',
            'u.username',
        ], 'm')
            ->leftJoin('users as u', 'u.user_id = m.user_id')
            ->where('(
            m.title LIKE :query
        OR m.description LIKE :query
        OR m.document_type LIKE :query
        OR m.format LIKE :query
        OR m.education_level LIKE :query
        OR m.subject LIKE :query
        OR m.author LIKE :query
        OR m.class_faculty LIKE :query
        OR m.semester LIKE :query
        OR u.username LIKE :query
        OR m.status LIKE :query)
        AND u.deleted_at IS NULL')
            ->bind(['query' => '%' . $query . '%'])
            ->orderBy('m.created_at', 'DESC')
            ->limit($limit)
            ->offset($offset)
            ->getAll();

    }
    public function getMaterialsCountForAdmin($query)
    {

        return $this->select([
            'COUNT(DISTINCT m.material_id) as total'
        ], 'm')
            ->leftJoin('users as u', 'u.user_id = m.user_id')
            ->where('(
            m.title LIKE :query
        OR m.description LIKE :query
        OR m.document_type LIKE :query
        OR m.format LIKE :query
        OR m.education_level LIKE :query
        OR m.subject LIKE :query
        OR m.author LIKE :query
        OR m.class_faculty LIKE :query
        OR m.semester LIKE :query
        OR u.username LIKE :query
        OR m.status LIKE :query)
        AND u.deleted_at IS NULL')
            ->bind(['query' => '%' . $query . '%'])
            ->get()['total'];


    }


    public function store($user_id, $request_id, $title, $description, $document_type, $format, $education_level, $semester, $subject, $class_faculty, $author, $thumbnail_path, $file_path)
    {
        $upload = $this->insert([
            'user_id' => $user_id,
            'request_id' => $request_id,
            'title' => $title,
            'description' => $description,
            'document_type' => $_POST['document_type'] ?? $document_type,
            'format' => $format,
            'education_level' => $education_level,
            'semester' => $semester,
            'subject' => $subject,
            'class_faculty' => $class_faculty,
            'author' => $author,
            'file_path' => $file_path,
            'thumbnail_path' => $thumbnail_path
        ])->execute();

        if ($upload) {
            return [
                'status' => true,
                'message' => 'Upload successful. Tell your friends about it!'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Upload failed. Please try again later'
            ];
        }
    }
    public function getMaterialById($material_id)
    {
        $material = $this->select([
            'DISTINCT m.*'
        ], 'm')
            ->leftJoin('users as u', 'u.user_id = m.user_id')
            ->where('m.material_id = :material_id AND u.deleted_at IS NULL')
            ->bind(['material_id' => $material_id])
            ->get();

        if ($material) {
            return $material;
        } else {
            return false;
        }
    }
    public function updateMaterial($material_id, $title, $description, $document_type, $format, $education_level, $semester, $subject, $class_faculty, $author, $thumbnail_path, $file_path)
    {
        $update = $this->update([
            'title' => $title,
            'description' => $description,
            'document_type' => $document_type,
            'format' => $format,
            'education_level' => $education_level,
            'semester' => $semester,
            'subject' => $subject,
            'class_faculty' => $class_faculty,
            'author' => $author,
            'thumbnail_path' => $thumbnail_path,
            'file_path' => $file_path
        ])
            ->where('material_id = :material_id')
            ->appendBindings(['material_id' => $material_id])
            ->execute();


        if ($update) {
            return [
                'status' => true,
                'message' => 'Update successful'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Update failed. Please try again later'
            ];
        }
    }

    function deleteMaterial($material_id)
    {
        $delete = $this->delete()
            ->where('material_id = :material_id')
            ->bind(['material_id' => $material_id])
            ->execute();


        if ($delete) {
            return [
                'status' => true,
                'message' => 'Material deleted successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Material deletion failed. Please try again later'
            ];
        }
    }

    public function getCounts()
    {
        return [
            'total' => $this->count()->get()['total'],
            'note' => $this->count()->where('document_type = "note"')->get()['total'],
            'question' => $this->count()->where('document_type = "question"')->get()['total'],
            'labreport' => $this->count()->where('document_type = "labreport"')->get()['total'],
            'active' => $this->count()->where('status = "active"')->get()['total'],
            'suspend' => $this->count()->where('status = "suspend"')->get()['total'],
            'responded' => $this->count()->where('request_id IS NOT NULL')->get()['total'],
        ];
    }

    public function updateStatus($material_id, $status)
    {
        $result = $this->update([
            'status' => $status
        ])
            ->where('material_id = :material_id')
            ->appendBindings(['material_id' => $material_id])
            ->execute();

        if ($result) {
            return [
                'status' => true,
                'message' => 'Status updated successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Status update failed. Please try again later'
            ];
        }
    }

}