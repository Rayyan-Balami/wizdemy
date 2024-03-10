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
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $current_user = null;
        if (Session::exists('user')) {
            $current_user = Session::get('user')['user_id'];
        }

        return $this->select([
            'DISTINCT mv.*'
        ], 'mv')
        ->leftJoin('follow_relation as fr', 'fr.following_id = mv.user_id')
        ->where('mv.document_type = :document_type AND (mv.user_id = :current_user OR mv.private = 0 OR (mv.private = 1 AND fr.follower_id = :current_user))')
        ->bind(['document_type' => $document_type, 'current_user' => $current_user])
        ->paginate($page, 10)
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