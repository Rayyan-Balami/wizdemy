<?php

class AdminController extends Controller
{
  public function __construct()
  {
    parent::__construct('AdminModel');
  }

  public function index()
  {
    View::render('admin/adminDashboard');
  }

  public function loginPage()
  {
    View::render('admin/adminLoginForm');
  }
  public function manageProjects()
  {
    $projects = $this->model->getProjectsForAdmin();
    View::render('admin/adminProjectManagement', [
      'projects' => $projects
    ]);
  }
  public function manageUsers()
  {
    $users = $this->model->getUsersForAdmin();
    View::render('admin/adminUserManagement', [
      'users' => $users
    ]);
  }
  public function manageRequests()
  {
    $requests = $this->model->getRequestsForAdmin();
    View::render('admin/adminRequestManagement', [
      'requests' => $requests
    ]);
  }


  public function loginProcess()
  {
    $email_username = trim($_POST['email_username']);
    $password = trim($_POST['password']);

    //validate email
    if (!Validate::string($email_username, 3, 50)) {
      $this->errors['email'] = 'Invalid email or username';
    }

    //validate password
    if (!Validate::string($password, 8, 16)) {
      $this->errors['password'] = 'Password must be 8 to 16 characters long';
    }

    //check if there are any errors in the flash
    if (!empty($this->errors)) {
      Session::flash('errors', $this->errors);
      Session::flash('old', [
        'email_username' => $email_username
      ]);
      $this->redirect('/login');
    }

    //check if user exists
    $result = $this->model->login($email_username, $password);

    if ($result['status']) {
      Session::flash('success', ['login' => $result['message']]);
      Session::set('admin', [
        'admin_id' => $result['admin']['admin_id'],
        'username' => $result['admin']['username'],
        'email' => $result['admin']['email']
      ]);
      $this->redirect('/admin/dashboard');
    }

    Session::flash('errors', ['login' => $result['message']]);
    Session::flash('old', [
      'email_username' => $email_username
    ]);
    $this->redirect('/admin/login');
  }

  //destroy (logout)
  public function logout()
  {
    Session::flash('success', ['logout' => $_SESSION['admin']['username'] . ', hard works pays off !']);
    Session::remove('admin');
    $this->redirect('/admin/login');
  }
}