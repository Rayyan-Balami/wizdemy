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
  public function getAllUsers()
  {
    return $this->select([
      'upv.*'
    ], 'upv')
    ->orderBy('upv.created_at', 'DESC')
      ->getAll();
  }
  public function search($search)
  {
    return $this->select([
      'upv.*'
    ], 'upv')
      ->where('upv.username LIKE :search OR upv.full_name LIKE :search')
      ->bind(['search' => '%' . $search . '%'])
      ->orderBy('upv.created_at', 'DESC')
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

}
