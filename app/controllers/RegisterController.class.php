<?php

class RegisterController extends Controller {

  public function __construct(){
    parent::__construct('RegisterModel');
  }

  //index (register form)
  public function index(){
    View::render('signupForm');
  }

  //store (register process)
  public function store(){
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
    $result = $this->model->register($fullName,$email,$password);

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
