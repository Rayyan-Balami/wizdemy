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
    View::render('admin/adminUserManagement', [
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
      $this->buildJsonResponse($result['message'], 200);
    } else {
      $this->buildJsonResponse($result['message'], 400);
    }
  }
 
  public function deleteUser($user_id)
  {
    $result = $this->model->deleteUser($user_id);
    if ($result['status']) {
      Session::flash('success', ['delete' => $result['message']]);
      $this->redirect('/admin/manage/user');
    } else {
      Session::flash('errors', ['delete' => $result['message']]);
      $this->redirect('/admin/manage/user');
    }
  } 

}