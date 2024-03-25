<?php

class SettingsController extends Controller {

  public function __construct(){
    parent::__construct('SettingsModel');
  }

  public function myInformation(){
    $user = $this->model->userDetails(Session::get('user')['user_id']);
    View::render('myInformation', ['user' => $user]);
  }

  public function accountSecurity(){
    $user = $this->model->userPreferences(Session::get('user')['user_id']);
    View::render('accountSecurity', ['user' => $user]);
  }

  public function profile(){
    $userName = htmlspecialchars(trim($_POST['username']));
    $bio = htmlspecialchars(trim($_POST['bio']));

    //validate username
    if (!Validate::string($userName, 3, 20)){
      $this->errors['username'] = 'Username must be 3 to 20 characters long';
    }

    //validate bio
    if (!Validate::string($bio, 0, 150)){
      $this->errors['bio'] = 'Bio must be less than 150 characters long';
    }

    //check if there are any errors in the flash
    if ( ! empty($this->errors)){
      Session::flash('errors', $this->errors);
      Session::flash('old', [
        'username' => $userName,
        'bio' => $bio
      ]);
      $this->redirect('/myInformation');
    }

    $result = $this->model->updateUserDetails(Session::get('user')['user_id'], ['username' => $userName, 'bio' => $bio]);

    if($result['status']){
      Session::flash('success',['profile' => $result['message']]);
      $this->redirect('/myInformation');
    }else{
      Session::flash('errors', ['profile' => $result['message']]);
      Session::flash('old', [
        'username' => $userName,
        'bio' => $bio
      ]);
      $this->redirect('/myInformation');
    }
  }

  public function personal(){
    $fullName = htmlspecialchars(trim($_POST['name']));
    $userType = htmlspecialchars(trim($_POST['user-type']));
    $educationLevel = htmlspecialchars(trim($_POST['educationLevel']));
    $enrolledCourse = htmlspecialchars(trim($_POST['enrolled-course']));
    $schoolName = htmlspecialchars(trim($_POST['school']));
    $phoneNumber = htmlspecialchars(trim($_POST['phoneNumber']));

    //validate full name
    if (!Validate::string($fullName, 3, 50)){
      $this->errors['full_name'] = 'Full name must be 3 to 50 characters long';
    }

    $allowedUserTypes = ['student', 'teacher', 'institution'];
    //validate user type
    if (!in_array($userType, $allowedUserTypes)){
      $this->errors['user_type'] = 'Invalid user type';
    }

    //validate education level
    if (!Validate::string($educationLevel, 3, 50)){
      $this->errors['education_level'] = 'Education level must be 3 to 50 characters long';
    }

    //validate enrolled course
    if (!Validate::string($enrolledCourse, 3, 50)){
      $this->errors['enrolled_course'] = 'Enrolled course must be 3 to 50 characters long';
    }

    //validate school name
    if (!Validate::string($schoolName, 3, 50)){
      $this->errors['school_name'] = 'School name must be 3 to 50 characters long';
    }

    //validate phone number
    if (!Validate::phone($phoneNumber)){
      $this->errors['phone_number'] = 'Invalid phone number';
    }

    //check if there are any errors in the flash
    if ( ! empty($this->errors)){
      Session::flash('errors', $this->errors);
      Session::flash('old', [
        'full_name' => $fullName,
        'user_type' => $userType,
        'education_level' => $educationLevel,
        'enrolled_course' => $enrolledCourse,
        'school_name' => $schoolName,
        'phone_number' => $phoneNumber
      ]);
      $this->redirect('/myInformation');
    }

    $result = $this->model->updateUserDetails(Session::get('user')['user_id'], ['full_name' => $fullName, 'user_type' => $userType, 'education_level' => $educationLevel, 'enrolled_course' => $enrolledCourse, 'school_name' => $schoolName, 'phone_number' => $phoneNumber]);

    if($result['status']){
      Session::flash('success',['personal' => $result['message']]);
      $this->redirect('/myInformation');
    }else{
      Session::flash('errors', ['personal' => $result['message']]);
      Session::flash('old', [
        'full_name' => $fullName,
        'user_type' => $userType,
        'education_level' => $educationLevel,
        'enrolled_course' => $enrolledCourse,
        'school_name' => $schoolName,
        'phone_number' => $phoneNumber
      ]);
      $this->redirect('/myInformation');
    }

  }

  public function password(){
    $currentPassword = trim($_POST['currentPassword']);
    $newPassword = trim($_POST['newPassword']);
    $confirmPassword = trim($_POST['confirmPassword']);

    //validate current password
    if (!Validate::string($currentPassword, 8, 16)){
      $this->errors['currentPassword'] = 'Current password must be 8 to 16 characters long';
    }

    //validate new password
    if (!Validate::string($newPassword, 8, 16)){
      $this->errors['newPassword'] = 'New password must be 8 to 16 characters long';
    }

    //validate confirm password
    if ($newPassword != $confirmPassword){
      $this->errors['confirmPassword'] = 'Passwords do not match';
    }

    //check if there are any errors in the flash
    if ( ! empty($this->errors)){
      Session::flash('errors', $this->errors);
      $this->redirect('/accountSecurity');
    }

    $result = $this->model->updatePassword(Session::get('user')['user_id'], $currentPassword, $newPassword);

    if($result['status']){
      Session::flash('success',['password' => $result['message']]);
      $this->redirect('/accountSecurity');
    }else{
      Session::flash('errors', ['password' => $result['message']]);
      $this->redirect('/accountSecurity');
    }
  }

  public function preferences(){
    $private = isset($_POST['private']) ? 1 : 0;
    $allowEmail = isset($_POST['allow_email']) ? 1 : 0;
    $allowPhone = isset($_POST['allow_phone']) ? 1 : 0;

    $result = $this->model->updatePreferences(Session::get('user')['user_id'], ['private' => $private, 'allow_email' => $allowEmail, 'allow_phone' => $allowPhone]);

    if($result['status']){
      Session::flash('success',['preferences' => $result['message']]);
      $this->redirect('/accountSecurity');
    }else{
      Session::flash('errors', ['preferences' => $result['message']]);
      $this->redirect('/accountSecurity');
    }
  }
}