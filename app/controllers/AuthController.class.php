<?php

class AuthController extends Controller {

  public function __construct(){
    parent::__construct('AuthModel');
  }

  //index (login form)
  public function login(){
    View::render('loginForm');
  }

  //store (login process)
  public function loginProcess(){
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
  public function logout(){
    Session::flash('success',['logout' => $_SESSION['user']['username'].', Love always comes back!']);
    Session::remove('user');
    $this->redirect('/login');
  }

    public function signup(){
      View::render('signupForm');
    }
  
    public function signupProcess(){
      $fullName = $_POST['fullName'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirmPassword'];
  
      //validate full name
      if (!Validate::string($fullName, 3, 25)){
       $this->errors['fullName'] = 'Invalid full name';
      }
  
      //validate email
      if (!Validate::email($email)){
        $this->errors['email'] = 'Invalid email';
      }
  
      //validate password == confirm password
      if (!Validate::equal($password, $confirmPassword)){
        $this->errors['confirmPassword'] = 'Passwords do not match';
      }
  
      //validate password
      if (!Validate::string($password, 8, 16) || !Validate::string($confirmPassword, 8, 16)){
        $this->errors['password'] = 'Password must be 8 to 16 characters long';
      }
  
      //check if there are any errors in the flash
      if ( ! empty($this->errors)){
        Session::flash('errors', $this->errors);
        Session::flash('old', [
          'fullName' => $fullName,
          'email' => $email
        ]);
        $this->redirect('/register');
      }
  
      //store user
      $result = $this->model->signup($fullName,$email,$password);
  
      if($result['status']){
        Session::flash('success',['register' => $result['message']]);
        $this->redirect('/login');
      }
  
      Session::flash('errors', ['register' => $result['message']]);
      Session::flash('old', [
        'fullName' => $fullName,
        'email' => $email
      ]);
      $this->redirect('/register');
    }

}