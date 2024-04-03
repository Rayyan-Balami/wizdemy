<?php

class AdminManageUserController extends Controller
{
  public function __construct()
  {
    parent::__construct(new UserModel());
  }

  public function index()
  {
    $users = (new UserProfileViewModel())->getAllUsers();
    View::render('admin/userManagement', [
      'users' => $users
    ]);
  }

  // api
  public function updateUserStatus()
  {
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];

    // check if user_id and status are set
    if (!isset($user_id) || !isset($status)) {
      $this->buildJsonResponse('Invalid request', 400);
    }

    $userStatus = $this->model->getUserStatus($user_id);
    if ($userStatus['status'] == $status) {
      $this->buildJsonResponse('User status is already ' . $status, 400);
    }

    $result = $this->model->updateUserStatus($user_id, $status);
    if ($result['status']) {
      (new AdminActionLogModel())->log(Session::get('admin')['admin_id'], $user_id, 'user', 'update_status_to_' . $status);
      $this->buildJsonResponse($result['message'], 200);
    } else {
      $this->buildJsonResponse($result['message'], 400);
    }
  }

  public function delete($user_id)
  {
    if (!isset($user_id)) {
      $this->buildJsonResponse('Invalid request', 400);
    }
    $result = $this->model->deleteUserById($user_id);
    if ($result['status']) {
      (new AdminActionLogModel())->log(Session::get('admin')['admin_id'], $user_id, 'user', 'delete');
      $this->buildJsonResponse($result['message'], 200);
    } else {
      $this->buildJsonResponse($result['message'], 400);
    }
  }

  public function edit($user_id)
  {
    $user = $this->model->userDetails($user_id);
    View::render('admin/editUser', [
      'user' => $user
    ]);
  }

  public function updateUserProfile($user_id)
  {
    $userName = htmlspecialchars(trim($_POST['username']));
    $bio = htmlspecialchars(trim($_POST['bio']));

    //validate username
    if (!Validate::string($userName, 3, 20)) {
      $this->errors['username'] = 'Username must be 3 to 20 characters long';
    }

    //validate bio
    if (!Validate::string($bio, 0, 150)) {
      $this->errors['bio'] = 'Bio must be less than 150 characters long';
    }

    //check if there are any errors in the flash
    if (!empty($this->errors)) {
      Session::flash('errors', $this->errors);
      Session::flash('old', [
        'username' => $userName,
        'bio' => $bio
      ]);
      $this->redirect('/admin/edit/user/' . $user_id . '#profile');
    }

    $result = $this->model->updateUserDetails($user_id, ['username' => $userName, 'bio' => $bio]);

    if ($result['status']) {
      Session::flash('success', ['profile' => 'Admin '. Session::get('admin')['username'] . ', Users ' . $result['message']]);
      
    } else {
      Session::flash('errors', ['profile' => 'Admin '. Session::get('admin')['username'] . ', Users ' . $result['message']]);
      Session::flash('old', [
        'username' => $userName,
        'bio' => $bio
      ]);
      
    }

    $this->redirect('/admin/edit/user/' . $user_id . '#profile');
  }

  public function updateUserInfo($user_id)
  {
    $fullName = htmlspecialchars(trim($_POST['fullName']));
    $email = htmlspecialchars(trim($_POST['email']));
    $userType = htmlspecialchars(trim($_POST['userType']));
    $educationLevel = htmlspecialchars(trim($_POST['educationLevel']));
    $enrolledCourse = htmlspecialchars(trim($_POST['enrolledCourse']));
    $schoolName = htmlspecialchars(trim($_POST['school']));
    $phoneNumber = htmlspecialchars(trim($_POST['phoneNumber']));

    //validate full name
    if (!Validate::string($fullName, 7, 60)) {
      $this->errors['full_name'] = 'Full name must be first name and last name';
    }

    //validate email
    if (!Validate::email($email)) {
      $this->errors['email'] = 'Invalid email';
    }

    $allowedUserTypes = ['student', 'teacher', 'institution'];
    //validate user type
    if (!in_array($userType, $allowedUserTypes)) {
      $this->errors['user_type'] = 'Invalid user type';
    }

    $allowedEducationLevels = ['school', '+2', 'diploma', 'bachelor', 'master', 'phd'];

    //validate education level
    if (!in_array($educationLevel, $allowedEducationLevels)) {
      $this->errors['education_level'] = 'Education level must be 3 to 50 characters long';
    }

    //validate enrolled course
    if (!Validate::string($enrolledCourse, 0, 50)) {
      $this->errors['enrolled_course'] = 'Enrolled course must be 3 to 50 characters long';
    }

    //validate school name
    if (!Validate::string($schoolName, 0, 50)) {
      $this->errors['school_name'] = 'School name must be 3 to 50 characters long';
    }

    //validate phone number
    if (!Validate::phone($phoneNumber) && !empty($phoneNumber)) {
      $this->errors['phone_number'] = 'Invalid phone number';
    }

    //check if there are any errors in the flash
    if (!empty($this->errors)) {
      Session::flash('errors', $this->errors);
      Session::flash('old', [
        'user_id' => $user_id, // add user_id to old data to redirect to the same user
        'full_name' => $fullName,
        'email' => $email,
        'user_type' => $userType,
        'education_level' => $educationLevel,
        'enrolled_course' => $enrolledCourse,
        'school_name' => $schoolName,
        'phone_number' => $phoneNumber
      ]);
      $this->redirect('/admin/edit/user/' . $user_id . '#personalInformation');
    }

    $result = $this->model->updateUserDetails($user_id, ['full_name' => $fullName, 'email' => $email, 'user_type' => $userType, 'education_level' => $educationLevel, 'enrolled_course' => $enrolledCourse, 'school_name' => $schoolName, 'phone_number' => $phoneNumber]);
    if ($result['status']) {
      (new AdminActionLogModel())->log(Session::get('admin')['admin_id'], $user_id, 'user', 'update_info');
      Session::flash('success', ['update' => 'Admin '. Session::get('admin')['username'] . ', Users ' . $result['message']]);
      
    } else {
      Session::flash('errors', ['update' => 'Admin '. Session::get('admin')['username'] . ', Users ' . $result['message']]);
    }

    $this->redirect('/admin/edit/user/' . $user_id . '#personalInformation');

  }

  public function updatePassword($user_id)
  {
    $newPassword = trim($_POST['newPassword']);
    $confirmPassword = trim($_POST['confirmPassword']);

    //validate new password
    if (!Validate::string($newPassword, 8, 16)) {
      $this->errors['newPassword'] = 'New password must be 8 to 16 characters long';
    }

    //validate confirm password
    if ($newPassword != $confirmPassword) {
      $this->errors['confirmPassword'] = 'Passwords do not match';
    }

    //check if there are any errors in the flash
    if (!empty($this->errors)) {
      Session::flash('errors', $this->errors);
      $this->redirect('/admin/edit/user/' . $user_id . '#password');   
    }

    $result = $this->model->adminUpdatePassword($user_id, $newPassword);

    if ($result['status']) {
      Session::flash('success', ['password' => $result['message']]);
    } else {
      Session::flash('errors', ['password' => $result['message']]);
    }

    $this->redirect('/admin/edit/user/' . $user_id . '#password');

  }
}