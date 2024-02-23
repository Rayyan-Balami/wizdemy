<?php

class RegisterModel extends Model
{
  public function __construct(){
    parent::__construct('users');
    $this->fillable = ['full_name', 'username', 'email', 'password'];
  }

  public function register($fullName, $email, $password){

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