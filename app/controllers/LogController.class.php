<?php

class LogController extends Controller {

  public function __construct(){
    parent::__construct('LogModel');
  }

  //index (login form)
  public function index(){
    View::render('loginForm');
  }

  //store (login process)
  public function store(){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //validate email
    if (!Validate::email($email)){
      $this->errors['email'] = 'Invalid email';
    }

    //validate password
    if (!Validate::string($password, 8, 16)){
      $this->errors['password'] = 'Password must be 8 to 16 characters long';
    }

    //check if there are any errors in the flash
    if ( ! empty($this->errors)){
      Session::flash('errors', $this->errors);
      Session::flash('old', [
        'email' => $email
      ]);
      $this->redirect('/login');
    }

    //check if user exists
    $result = $this->model->login($email,$password);

    if($result['status']){
      Session::flash('success',['login' => $result['message']]);
      Session::set('user', [
        'user_id' => $result['user']['user_id'],
        'username' => $result['user']['username'],
        'email'=> $result['user']['email']
      ]);
      $this->redirect('/');
    }

    Session::flash('errors', ['login' => $result['message']]);
    Session::flash('old', [
      'email' => $email
    ]);
    $this->redirect('/login');
  }

  //destroy (logout)
  public function destroy(){
    Session::flash('success',['logout' => $_SESSION['user']['username'].', Love always comes back!']);
    Session::remove('user');
    $this->redirect('/login');
  }
}