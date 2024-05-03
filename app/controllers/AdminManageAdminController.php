<?php

class AdminManageAdminController extends Controller
{
  public function __construct()
  {
    parent::__construct(new AdminModel());
  }

  public function index()
  {
    if (Session::get('admin')['admin_id'] != 1) {
      Session::flash('error', ["unauthorized" => "You are not authorized to access this page"]);
      $this->redirect('/admin/dashboard');
    }

    $query = $_GET['query'] ?? '';
    $page = $_GET['page'] ?? 1;
    if ($page < 1) {
      $page = 1;
    }

    $admins = $this->model->getAllAdmins($query, $page);
    $totalData = $this->model->getAdminsCount($query);


    View::render('admin/adminManagement', [
      'admins' => $admins,
      'totalData' => $totalData,
      'page' => $page,
      'query' => $query,
      'currentPage' => 'adminManagement'
    ]);
  }

  public function add()
  {
    if (Session::get('admin')['admin_id'] != 1) {
      Session::flash('error', ["unauthorized" => "You are not authorized to access this page"]);
      $this->redirect('/admin/dashboard');
    }
    View::render('admin/addAdmin');
  }

  public function addProcess()
  {
    $admin_id = Session::get('admin')['admin_id'];
    if ($admin_id != 1) {
      Session::flash('error', ["unauthorized" => "You are not authorized to access this page"]);
      $this->redirect('/admin/dashboard');
    }
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['newPassword']);
    $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

    //validate username
    if (!Validate::string($username, 3, 20)) {
      $this->errors['username'] = 'Username must be 3 to 20 characters long';
    }

    //validate email
    if (!Validate::email($email)) {
      $this->errors['email'] = 'Invalid email';
    }

    //validate password == confirm password
    if (!Validate::equal($password, $confirmPassword)) {
      $this->errors['confirmPassword'] = 'Passwords do not match';
    }

    //validate password
    if (!Validate::string($password, 8, 16) || !Validate::string($confirmPassword, 8, 16)) {
      $this->errors['password'] = 'Password must be 8 to 16 characters long';
    }

    //check if there are any errors in the flash
    if (!empty($this->errors)) {
      Session::flash('errors', $this->errors);
      Session::flash('old', [
        'username' => $username,
        'email' => $email
      ]);
      $this->redirect('/admin/add/admin');
    }


    $result = $this->model->addAdmin($username, $email, $password);


    if ($result['status']) {
      (new AdminActionLogModel())->log(Session::get('admin')['admin_id'], $result['admin_id'], 'admin', 'Insert new admin');
      Session::flash('success', ['addAdmin' => $result['message']]);
      $this->redirect('/admin/manage/admin');
    } else {
      Session::flash('errors', ['addAdmin' => $result['message']]);
      Session::flash('old', [
        'username' => $username,
        'email' => $email
      ]);
      $this->redirect('/admin/add/admin');
    }
  }

  public function edit($admin_id)
  {
    $currentAdminId = Session::get('admin')['admin_id'];
    if ($currentAdminId != 1) {
      Session::flash('error', ["unauthorized" => "You are not authorized to access this page"]);
      $this->redirect('/admin/dashboard');
    }
    $adminDetails = $this->model->getAdminById($admin_id);
    View::render('admin/editAndSettingAdmin', ['type' => 'edit', 'adminDetails' => $adminDetails]);
  }

  public function updateAdminInfo($admin_id)
  {
    $currentAdminId = Session::get('admin')['admin_id'];
    if ($currentAdminId != 1) {
      Session::flash('error', ["unauthorized" => "You are not authorized to access this page"]);
      $this->redirect('/admin/dashboard');
    }
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);

    //validate username
    if (!Validate::string($username, 3, 20)) {
      $this->errors['username'] = 'Username must be 3 to 20 characters long';
    }

    //validate email
    if (!Validate::email($email)) {
      $this->errors['email'] = 'Invalid email';
    }

    //check if there are any errors in the flash
    if (!empty($this->errors)) {
      Session::flash('errors', $this->errors);
      Session::flash('old', [
        'username' => $username,
        'email' => $email
      ]);
      $this->previousUrl();
    }

    $result = $this->model->updateAdminInfo($admin_id, $username, $email);

    if ($result['status']) {
      (new AdminActionLogModel())->log(Session::get('admin')['admin_id'], $admin_id, 'admin', 'update admin info');
      Session::flash('success', ['updateAdmin' => $result['message']]);
      $this->previousUrl();
    } else {
      Session::flash('errors', ['updateAdmin' => $result['message']]);
      Session::flash('old', [
        'username' => $username,
        'email' => $email
      ]);
      $this->previousUrl();
    }


  }


  public function updateAdminPassword($admin_id)
  {
    $currentAdminId = Session::get('admin')['admin_id'];

    $password = htmlspecialchars($_POST['newPassword']);
    $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

    //validate password == confirm password
    if (!Validate::equal($password, $confirmPassword)) {
      $this->errors['confirmPassword'] = 'Passwords do not match';
    }

    //validate password
    if (!Validate::string($password, 8, 16) || !Validate::string($confirmPassword, 8, 16)) {
      $this->errors['password'] = 'Password must be 8 to 16 characters long';
    }

    //check if there are any errors in the flash
    if (!empty($this->errors)) {
      Session::flash('errors', $this->errors);
      if ($currentAdminId == 1) {
        $this->previousUrl();
      }
    }

    $result = $this->model->updateAdminPassword($admin_id, $password);

    if ($result['status']) {
      (new AdminActionLogModel())->log(Session::get('admin')['admin_id'], $admin_id, 'admin', 'update admin password');
      Session::flash('success', ['updatePassword' => $result['message']]);
      $this->previousUrl();
    } else {
      Session::flash('errors', ['updatePassword' => $result['message']]);
      $this->previousUrl();
    }
  }
}