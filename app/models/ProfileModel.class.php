<?php

class ProfileModel extends Model
{
  public function __construct()
  {
    parent::__construct('users');
  }


  public function find($user_id)
  {
    return $this->select([
      'u.user_id',
      'u.private AS is_private',
      'u.username',
      'u.full_name',
      'u.education_level',
      'u.enrolled_course',
      'u.bio',
      'u.created_at',
      'COUNT(DISTINCT f1.follower_id) as followers_count',
      'COUNT(DISTINCT f2.following_id) as following_count',
      'COUNT(DISTINCT r.request_id) as requests_count',
      'COUNT(DISTINCT m.material_id) as materails_count',
      'CASE
        WHEN fr.following_id IS NOT NULL THEN 1
        ELSE 0
    END AS is_current_user_follower'
    ], 'u')
      ->leftJoin('follow_relation as fr', 'u.user_id = fr.following_id AND fr.follower_id = :follower_id')
      ->leftJoin('follow_relation as f1', 'f1.following_id = u.user_id')
      ->leftJoin('follow_relation as f2', 'f2.follower_id = u.user_id')
      ->leftJoin('study_material_requests as r', 'r.user_id = u.user_id')
      ->leftJoin('study_materials as m', 'm.user_id = u.user_id')
      ->where('u.user_id = :user_id')
      ->bind(['user_id' => $user_id, 'follower_id' => Session::get('user')['user_id']])
      ->get();
  }

  public function showUploads($user_id, $document_type = 'note')
  {
    return (new StudyMaterailModel())->select([
      'm.*',
      'u1.username',
      'u2.username as responded_by',
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
      ->where('m.user_id = :user_id AND m.document_type = :document_type')
      ->bind(['user_id' => $user_id, 'document_type' => $document_type])
      ->groupBy('m.material_id')
      ->orderBy('m.created_at', 'DESC')
      ->getAll();
}
}

