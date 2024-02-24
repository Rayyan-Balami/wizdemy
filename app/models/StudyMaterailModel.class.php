<?php

class StudyMaterailModel extends Model
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
        'mv.*',
        'CASE
            WHEN fr.following_id IS NOT NULL THEN 1
            ELSE 0
        END AS is_current_user_follower'
    ], 'mv')
        ->leftJoin('follow_relation as fr', 'fr.following_id = mv.user_id AND fr.follower_id = :follower_id')
        ->where('(mv.document_type = :document_type AND (mv.private = 0 OR (CASE WHEN fr.following_id IS NOT NULL THEN 1 ELSE 0 END) = 1 OR mv.user_id = :user_id))')
        ->bind(['document_type' => $document_type, 'user_id' => $current_user, 'follower_id' => $current_user])
        ->groupBy('mv.material_id')
        ->paginate($page, 10)
        ->getAll();
}

}