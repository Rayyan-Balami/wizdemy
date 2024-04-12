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
    return $this->select(['a.admin_id', 'a.username', 'a.email', 'a.status', 'a.created_at', 'a.updated_at', 'COUNT(al.admin_id) as logs_count'], 'a')
      ->leftJoin('admin_action_log al', 'a.admin_id = al.admin_id')
      ->where('a.admin_id <> 1')
      ->groupBy('a.admin_id')
      ->getAll();
  }
  public function getAdminById($admin_id)
  {
    return $this->select(['a.admin_id', 'a.username', 'a.email', 'a.status', 'a.created_at', 'a.updated_at', 'COUNT(al.admin_id) as logs_count'], 'a')
      ->leftJoin('admin_action_log al', 'a.admin_id = al.admin_id')
      ->where('a.admin_id = :admin_id')
      ->bind(['admin_id' => $admin_id])
      ->get();
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
  public function updateAdminInfo($admin_id, $username, $email)
  {
    //check if username
    $admin = $this->select(['admin_id'])
      ->where('username = :username AND admin_id <> :admin_id')
      ->bind(['username' => $username, 'admin_id' => $admin_id])
      ->get();

    if ($admin) {
      return [
        'status' => false,
        'message' => 'Admin username already exists'
      ];
    }

    $admin = $this->select(['admin_id'])
      ->where('email = :email AND admin_id <> :admin_id')
      ->bind(['email' => $email, 'admin_id' => $admin_id])
      ->get();

    if ($admin) {
      return [
        'status' => false,
        'message' => 'Admin email already exists'
      ];
    }

    $result = $this->update(['username' => $username, 'email' => $email])
      ->where('admin_id = :admin_id')
      ->appendBindings(['admin_id' => $admin_id])
      ->execute();
    if ($result) {
      return [
        'status' => true,
        'message' => 'Admin info updated successfully'
      ];
    } else {
      return [
        'status' => false,
        'message' => 'Failed to update admin info'
      ];
    }
  }

  public function updateAdminPassword($admin_id, $password)
  {
    $result = $this->update(['password' => password_hash($password, PASSWORD_DEFAULT)])
      ->where('admin_id = :admin_id')
      ->appendBindings(['admin_id' => $admin_id])
      ->execute();
    if ($result) {
      return [
        'status' => true,
        'message' => 'Admin password updated successfully'
      ];
    } else {
      return [
        'status' => false,
        'message' => 'Failed to update admin password'
      ];
    }
  }

  public function deleteAdmin($admin_id)
  {
    $result = $this->delete()
      ->where('admin_id = :admin_id AND admin_id <> 1')
      ->bind(['admin_id' => $admin_id])
      ->execute();
    if ($result) {
      return [
        'status' => true,
        'message' => 'Admin deleted successfully'
      ];
    } else {
      return [
        'status' => false,
        'message' => 'Failed to delete admin'
      ];
    }
  }

  public function addAdmin($username, $email, $password)
  {

    //check if username or email already exists
    $admin = $this->select(['admin_id'])
      ->where('username = :username')
      ->bind(['username' => $username])
      ->get();

    if ($admin) {
      return [
        'status' => false,
        'message' => 'Admin username already exists'
      ];
    }

    $admin = $this->select(['admin_id'])
      ->where('email = :email')
      ->bind(['email' => $email])
      ->get();

    if ($admin) {
      return [
        'status' => false,
        'message' => 'Admin email already exists'
      ];
    }


    $result = $this->insert([
      'username' => $username,
      'email' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT)
    ])->execute();

    if ($result) {
      return [
        'status' => true,
        'message' => 'Admin added successfully'
      ];
    } else {
      return [
        'status' => false,
        'message' => 'Failed to add admin'
      ];
    }

  }
}


