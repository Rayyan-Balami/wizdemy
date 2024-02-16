<?php

class LogModel extends Model
{
  public function __construct(){
    parent::__construct('users');
  }

  public function login($username_email, $password){
    $user = $this->select(['user_id', 'username', 'email', 'password'])
      ->where('username', $username_email)
      ->orWhere('email', $username_email)
      ->get();

    if ($user && password_verify($password, $user['password'])) {
      return [
        'status' => true,
        'user' => $user,
        'message' => $user['username'] . ' ' . SITE_NAME . ' welcomes you'
      ];
    } else {
      return [
        'status' => false,
        'message' => 'Invalid username, email or password'
      ];
    }
  }

}