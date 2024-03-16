<?php

class StudyMaterialModel extends Model
{

    public function __construct()
    {
        parent::__construct('material_view'); // view with all datas from study_materials, users, study_material_requests, likes, comments, views.

        $this->fillable = ['title', 'description', 'file_path', 'user_id', 'respond_to', 'document_type', 'format', 'education_level', 'semester', 'subject', 'author', 'thumbnail_path', 'class_faculty'];
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
            ->limit(10)
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
}