<?php

class AdminModel extends Model
{
  public function __construct(string $table = 'admins'){
    parent::__construct($table);
    $this->fillable = ['username', 'email', 'password'];
  }

  public function login($email_username, $password){
   
    $admin = $this->select(['admin_id', 'username', 'email', 'password'])
      ->where('username = :username OR email = :email')
      ->bind(['username' => $email_username, 'email' => $email_username])
      ->get();


    if ($admin && password_verify($password, $admin['password'])) {
      return [
        'status' => true,
        'admin' => $admin,
        'message' => $admin['username'] . ' admin ' . SITE_NAME . ' welcomes you'
      ];
    } else {
      return [
        'status' => false,
        'message' => 'Invalid username, email or password'
      ];
    }
  }
}