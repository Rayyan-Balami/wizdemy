<?php

class AuthModel extends Model
{
  public function __construct(string $table = 'users'){
    parent::__construct($table);
    $this->fillable = ['full_name', 'username', 'email', 'password'];
  }

  public function login($email_username, $password){
    $user = $this->select(['user_id', 'username', 'email', 'password'])
      ->where('username = :username OR email = :email')
      ->bind(['username' => $email_username, 'email' => $email_username])
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

  public function signup($fullName, $email, $password){

    // Check if email already exists
    $user = $this->select(['user_id'])
    ->where('email = :email')
    ->bind(['email' => $email])
    ->get();

    if($user){
      return [
        'status' => false,
        'message' => 'Email already exists | GO LOGIN'
      ];
    }


    $user = $this->insert([
      'full_name' => $fullName,
      'username' => substr($email, 0, strpos($email, '@')),
      'email' => $email,
      'password' => password_hash($password, PASSWORD_BCRYPT)
    ])->execute();

    if($user){
      return [
        'status' => true,
        'message' => substr($fullName, 0, strpos($fullName, ' ')).' registered successfully | GO LOGIN'
      ];
    }else{
      return [
        'status' => false,
        'message' => 'Signup failed'
      ];
    }
  }

}