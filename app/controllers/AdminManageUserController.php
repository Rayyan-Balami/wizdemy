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

}