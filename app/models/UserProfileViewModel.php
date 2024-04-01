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
      ->getAll();
  }
}
