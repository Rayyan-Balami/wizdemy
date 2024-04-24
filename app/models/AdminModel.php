<?php

class AdminModel extends Model
{
  public function __construct(string $table = 'admins')
  {
    parent::__construct($table);
    $this->fillable = ['username', 'email', 'password', 'status', 'created_at', 'updated_at', 'deleted_at'];
  }

  public function login($email_username, $password)
  {

    $admin = $this->select(['admin_id', 'username', 'email', 'password', 'status'])
      ->where('(username = :username OR email = :email)
        AND deleted_at IS NULL')
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
  public function getAllAdmins($query, $page =1)
  {
    $limit = 10;
    $offset = ($page - 1) * $limit;
    return $this->select(['a.admin_id', 'a.username', 'a.email', 'a.status', 'a.created_at', 'a.updated_at', 'a.deleted_at', 'COUNT(al.admin_id) as logs_count'], 'a')
      ->leftJoin('admin_action_log al', 'a.admin_id = al.admin_id')
      ->where('a.admin_id <> 1 AND (
        a.username LIKE :query 
        OR a.email LIKE :query
        OR a.status LIKE :query
        )
        AND a.deleted_at IS NULL
        ')
      ->bind(['query' => "%$query%"])
      ->groupBy('a.admin_id')
      ->orderBy('a.created_at', 'DESC')
      ->limit($limit)
      ->offset($offset)
      ->getAll();
  }
  public function getAdminsCount($query)
  {
    return $this->select(['COUNT(admin_id) as total'], 'admins')
      ->where('admin_id <> 1 AND (
        username LIKE :query 
        OR email LIKE :query
        OR status LIKE :query
        )
        AND deleted_at IS NULL')
      ->bind(['query' => "%$query%"])
      ->get()['total'];
  }

  public function getAdminById($admin_id)
  {
    $result = $this->select(['a.admin_id', 'a.username', 'a.email', 'a.status', 'a.created_at', 'a.updated_at', 'a.deleted_at', 'COUNT(al.admin_id) as logs_count'], 'a')
      ->leftJoin('admin_action_log al', 'a.admin_id = al.admin_id')
      ->where('a.admin_id = :admin_id
        AND a.deleted_at IS NULL
        ')
      ->bind(['admin_id' => $admin_id])
      ->groupBy('a.admin_id')
      ->get();

    //if admin not found
    if ($result['admin_id'] == null){
      return false;
    }

    return $result;
  }
  public function getAdminStatus($admin_id)
  {
    return $this->select(['status'])
      ->where('admin_id = :admin_id AND admin_id <> 1
        AND deleted_at IS NULL')
      ->bind(['admin_id' => $admin_id])
      ->get();
  }
  public function updateStatus($admin_id, $status)
  {
    $result = $this->update(['status' => $status])
      ->where('admin_id = :admin_id AND admin_id <> 1
        AND deleted_at IS NULL')
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
      ->where('username = :username AND admin_id <> :admin_id
        AND deleted_at IS NULL')
      ->bind(['username' => $username, 'admin_id' => $admin_id])
      ->get();

    if ($admin) {
      return [
        'status' => false,
        'message' => 'Admin username already exists'
      ];
    }

    $admin = $this->select(['admin_id'])
      ->where('email = :email AND admin_id <> :admin_id
        AND deleted_at IS NULL')
      ->bind(['email' => $email, 'admin_id' => $admin_id])
      ->get();

    if ($admin) {
      return [
        'status' => false,
        'message' => 'Admin email already exists'
      ];
    }

    $result = $this->update(['username' => $username, 'email' => $email])
      ->where('admin_id = :admin_id
        AND deleted_at IS NULL')
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
      ->where('admin_id = :admin_id
        AND deleted_at IS NULL')
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
    $result = $this->update([
      'deleted_at' => date('Y-m-d H:i:s')
    ])
      ->where('admin_id = :admin_id AND admin_id <> 1')
      ->appendBindings(['admin_id' => $admin_id])
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

  public function restoreAdmin($admin_id)
  {
    $result = $this->update([
      'deleted_at' => null
    ])
      ->where('admin_id = :admin_id AND admin_id <> 1')
      ->appendBindings(['admin_id' => $admin_id])
      ->execute();

    if ($result) {
      return [
        'status' => true,
        'message' => 'Admin restored successfully'
      ];
    } else {
      return [
        'status' => false,
        'message' => 'Failed to restore admin'
      ];
    }
  }

  public function getDeletedAdmin($search, $page = 1)
  {
    $limit = 10;
    $offset = ($page - 1) * $limit;
    return $this->select(['a.admin_id', 'a.username', 'a.email', 'a.status', 'a.created_at', 'a.updated_at', 'a.deleted_at', 'COUNT(al.admin_id) as logs_count'], 'a')
      ->leftJoin('admin_action_log al', 'a.admin_id = al.admin_id')
      ->where('a.deleted_at IS NOT NULL AND a.admin_id <> 1 AND (
        a.username LIKE :search 
        OR a.email LIKE :search
        OR a.status LIKE :search
        )
        ')
      ->bind(['search' => "%$search%"])
      ->groupBy('a.admin_id')
      ->orderBy('a.created_at', 'DESC')
      ->limit($limit)
      ->offset($offset)
      ->getAll();
  }

  public function getDeletedAdminCount($search)
  {
    return $this->select(['COUNT(admin_id) as total'], 'admins')
      ->where('deleted_at IS NOT NULL AND admin_id <> 1 AND (
        username LIKE :search 
        OR email LIKE :search
        OR status LIKE :search
        )
        ')
      ->bind(['search' => "%$search%"])
      ->get()['total'];
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

  public function getCounts()
  {
    return [
      'total' => $this->count()->get()['total'],
      'active' => $this->count()->where('status = "active" AND admin_id <> 1')->get()['total'],
      'suspend' => $this->count()->where('status = "suspend" AND admin_id <> 1')->get()['total'],
      'deleted' => $this->count()->where('deleted_at IS NOT NULL AND admin_id <> 1')->get()['total']
    ];
  }
}


