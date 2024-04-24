<?php

class UserProfileViewModel extends Model
{
  public function __construct(string $table = 'user_profile_view')
  {
    parent::__construct($table);
  }


  public function profileData($user_id)
  {
    return $this->select([
      'upv.*'
    ], 'upv')
      ->where('upv.user_id = :user_id AND upv.deleted_at IS NULL')
      ->bind(['user_id' => $user_id])
      ->get();
  }

  public function getUserById($user_id)
  {
    return $this->select([
      'upv.*'
    ], 'upv')
      ->where('upv.user_id = :user_id AND upv.deleted_at IS NULL')
      ->bind(['user_id' => $user_id])
      ->get();
  }

  public function search($search)
  {
    return $this->select([
      'upv.*'
    ], 'upv')
      ->where('(upv.username LIKE :search 
              OR upv.full_name LIKE :search
              ) AND upv.deleted_at IS NULL
              And upv.status = :status

              ')
      ->bind(['search' => '%' . $search . '%', 'status' => 'active'])
      ->orderBy('upv.followers_count', 'DESC')
      ->getAll();
  }
  public function searchSuggestions($search)
  {
    return $this->select([
      'DISTINCT upv.username as title',
    ], 'upv')
      ->where('(
                upv.username LIKE :search 
            OR upv.full_name LIKE :search
            OR upv.email LIKE :search
            OR upv.phone_number LIKE :search
            OR upv.user_type LIKE :search
            OR upv.education_level LIKE :search
            OR upv.enrolled_course LIKE :search
      ) AND upv.status = :status
        AND upv.deleted_at IS NULL
      ')
      ->bind(['search' => '%' . $search . '%', 'status' => 'active'])
      ->limit(5)
      ->getAll();
  }

  public function getUserForAdmin($search, $page = 1)
  {
    $limit = 10;
    $offset = ($page - 1) * $limit;
    return $this->select([
      'upv.*'
    ], 'upv')
      ->where('(upv.username LIKE :search 
      OR upv.full_name LIKE :search
      OR upv.email LIKE :search
      OR upv.phone_number LIKE :search
      OR upv.user_type LIKE :search
      OR upv.education_level LIKE :search
      OR upv.enrolled_course LIKE :search
      OR upv.status LIKE :search)
      AND upv.deleted_at IS NULL
      ')
      ->bind(['search' => '%' . $search . '%'])
      ->orderBy('upv.created_at', 'DESC')
      ->limit($limit)
      ->offset($offset)
      ->getAll();
  }
  public function getUserCountForAdmin($search)
  {
    return $this->select([
      'COUNT(upv.user_id) as total'
    ], 'upv')
      ->where('(upv.username LIKE :search 
      OR upv.full_name LIKE :search
      OR upv.email LIKE :search
      OR upv.phone_number LIKE :search
      OR upv.user_type LIKE :search
      OR upv.education_level LIKE :search
      OR upv.enrolled_course LIKE :search
      OR upv.status LIKE :search)
      AND upv.deleted_at IS NULL
      ')
      ->bind(['search' => '%' . $search . '%'])
      ->get()['total'];
  }

  public function getDeletedUser($search, $page = 1)
  {
    $limit = 10;
    $offset = ($page - 1) * $limit;
    return $this->select([
      'upv.*'
    ], 'upv')
      ->where('(upv.username LIKE :search 
      OR upv.full_name LIKE :search
      OR upv.email LIKE :search
      OR upv.phone_number LIKE :search
      OR upv.user_type LIKE :search
      OR upv.education_level LIKE :search
      OR upv.enrolled_course LIKE :search
      OR upv.status LIKE :search)
      AND upv.deleted_at IS NOT NULL
      ')
      ->bind(['search' => '%' . $search . '%'])
      ->orderBy('upv.created_at', 'DESC')
      ->limit($limit)
      ->offset($offset)
      ->getAll();
  }

  public function getDeletedUserCount($search)
  {
    return $this->select([
      'COUNT(upv.user_id) as total'
    ], 'upv')
      ->where('(upv.username LIKE :search 
      OR upv.full_name LIKE :search
      OR upv.email LIKE :search
      OR upv.phone_number LIKE :search
      OR upv.user_type LIKE :search
      OR upv.education_level LIKE :search
      OR upv.enrolled_course LIKE :search
      OR upv.status LIKE :search)
      AND upv.deleted_at IS NOT NULL
      ')
      ->bind(['search' => '%' . $search . '%'])
      ->get()['total'];

  }

}
