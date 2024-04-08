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
            'thumbnail_path'
        ];
    }


    public function show($document_type = 'note')
    {
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
            ->where('mv.document_type = :document_type AND (mv.user_id = :current_user OR mv.private = 0 OR (mv.private = 1 AND fr.follower_id = :current_user))')
            ->bind(['document_type' => $document_type, 'current_user' => $current_user])
            ->orderBy('mv.created_at', 'DESC')
            ->limit(10)
            ->getAll();
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
            'DISTINCT mv.*'
        ], 'mv')
            ->where('mv.material_id = :material_id')
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
    public function getTotalMaterialsCount()
    {
        $result = $this->count()->get();
        return $result['total'];
    }
}