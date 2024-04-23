<?php

class AuthController extends Controller
{

  public function __construct()
  {
    parent::__construct(new UserModel());
  }

  //index (login form)
  public function login()
  {
    $previous_url = Session::get('previous_url') ?? null;
    // Clear the previous_url from the session if exists
    if ($previous_url) {
      if (strpos($previous_url, '/admin')) {
      Session::remove('previous_url');
    }
  }

  Session::flash('previous_url', $previous_url);

    View::render('loginForm');
  }

  //store (login process)
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
      // dd($result);
      if ($result['user']['status'] == 'suspend') {
        Session::flash('errors', ['account' => 'Your account has been suspended']);
        $this->redirect('/login');
      }
      Session::flash('success', ['login' => $result['message']]);
      Session::set('user', [
        'user_id' => $result['user']['user_id'],
        'username' => $result['user']['username'],
        'email' => $result['user']['email'],
      ]);
      $this->previousUrl();
    }

    Session::flash('errors', ['login' => $result['message']]);
    Session::flash('old', [
      'email_username' => $email_username
    ]);
    $this->redirect('/login');
  }

  //destroy (logout)
  public function logout()
  {
    Session::flash('success', ['logout' => $_SESSION['user']['username'] . ', Love always comes back!']);
    Session::remove('user');
    $this->redirect('/login');
  }
  public function signup()
  {
    View::render('signupForm');
  }

  public function signupProcess()
  {
    $fullName = htmlspecialchars(trim($_POST['fullName']));
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    //validate full name
    if (!Validate::string($fullName, 7, 60)) {
      $this->errors['fullName'] = 'Full name must be first name and last name';
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
        'fullName' => $fullName,
        'email' => $email
      ]);
      $this->redirect('/signup');
    }

    //store user
    $result = $this->model->signup($fullName, $email, $password);

    if ($result['status']) {
      Session::flash('success', ['signup' => $result['message']]);
      $this->redirect('/login');
    }

    Session::flash('errors', ['signup' => $result['message']]);
    Session::flash('old', [
      'fullName' => $fullName,
      'email' => $email
    ]);
    $this->redirect('/signup');
  }

  public function authStatusAPI()
  {
    $auth = Session::exists('user');
    $this->buildJsonResponse(['auth' => $auth]);
  }

}