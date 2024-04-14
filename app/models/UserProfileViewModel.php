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
      ->where('upv.user_id = :user_id')
      ->bind(['user_id' => $user_id])
      ->get();
  }

  public function getUserById($user_id)
  {
    return $this->select([
      'upv.*'
    ], 'upv')
      ->where('upv.user_id = :user_id')
      ->bind(['user_id' => $user_id])
      ->get();
  }
  
  public function search($search)
  {
    return $this->select([
      'upv.*'
    ], 'upv')
      ->where('upv.username LIKE :search OR upv.full_name LIKE :search')
      ->bind(['search' => '%' . $search . '%'])
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
      ) AND upv.status = :status')
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
      ->where('upv.username LIKE :search OR upv.full_name LIKE :search')
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
      ->where('upv.username LIKE :search OR upv.full_name LIKE :search')
      ->bind(['search' => '%' . $search . '%'])
      ->get()['total'];
  }
}
