<?php

class AdminAuthController extends Controller
{
  public function __construct()
  {
    parent::__construct(new AdminModel());
  }

  public function loginPage()
  {
    // Clear the previous_url from the session if exists
    $previous_url = Session::get('previous_url') ?? null;
    // Clear the previous_url from the session if exists
    if ($previous_url) {
      if (!strpos($previous_url, '/admin')) {
      Session::remove('previous_url');
    }
  }

  Session::flash('previous_url', $previous_url);

    View::render('admin/loginForm');
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
      if ($result['admin']['status'] == 'suspend') {
        Session::flash('errors', ['account' => 'Your account has been suspended']);
        $this->redirect('/admin/login');
      }
      Session::flash('success', ['login' => $result['message']]);
      Session::set('admin', [
        'admin_id' => $result['admin']['admin_id'],
        'username' => $result['admin']['username'],
        'email' => $result['admin']['email'],
      ]);
      $this->previousUrl();
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