<?php

class AdminModel extends Model
{
  public function __construct(string $table = 'admins')
  {
    parent::__construct($table);
    $this->fillable = ['username', 'email', 'password', 'status'];
  }

  public function login($email_username, $password)
  {

    $admin = $this->select(['admin_id', 'username', 'email', 'password', 'status'])
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
  public function getAllAdmins()
  {
    return $this->select(['admin_id', 'username', 'email', 'status', 'created_at'])
      ->where('admin_id <> 1')
      ->getAll();
  }
  public function getAdminStatus($admin_id)
  {
    return $this->select(['status'])
      ->where('admin_id = :admin_id AND admin_id <> 1')
      ->bind(['admin_id' => $admin_id])
      ->get();
  }
  public function updateAdminStatus($admin_id, $status)
  {
    $result = $this->update(['status' => $status])
      ->where('admin_id = :admin_id AND admin_id <> 1')
      ->appendBindings(['admin_id' => $admin_id])
      ->execute();
    if ($result) {
      return [
        'status' => true,
        'message' => 'Admin status updated successfully'
      ];
    } else {
      return [
        'status' => false,
        'message' => 'Failed to update admin status'
      ];
    }

  }
  public function updateAdmin($admin_id, $data)
  {
    $result = $this->update($data)
      ->where('admin_id = :admin_id')
      ->appendBindings(['admin_id' => $admin_id])
      ->execute();
    if ($result) {
      return [
        'status' => true,
        'message' => 'Admin updated successfully'
      ];
    } else {
      return [
        'status' => false,
        'message' => 'Failed to update admin'
      ];
    }
  }
}


