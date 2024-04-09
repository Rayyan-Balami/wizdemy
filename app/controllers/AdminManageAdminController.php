<?php

class AdminManageAdminController extends Controller
{
  public function __construct()
  {
    parent::__construct(new AdminModel());
  }

  public function index()
  {
    if(Session::get('admin')['admin_id']!=1){
      Session::flash('error', ["unauthorized"=>"You are not authorized to access this page"]);
      $this->redirect('/admin/dashboard');
    }
    $admins = $this->model->getAllAdmins();
    
    View::render('admin/adminManagement', ['admins' => $admins]);
  }
  public function updateAdminStatus()
  {
    $admin_id = $_POST['admin_id'];
    $status = $_POST['status'];

    // check if user_id and status are set
    if (!isset($admin_id) || !isset($status)) {
      $this->buildJsonResponse('Invalid request', 400);
    }

    $userStatus = $this->model->getAdminStatus($admin_id);
    if ($userStatus['status'] == $status) {
      $this->buildJsonResponse('User status is already ' . $status, 400);
    }

    $result = $this->model->updateAdminStatus($admin_id, $status);
    if ($result['status']) {
      (new AdminActionLogModel())->log(Session::get('admin')['admin_id'], $admin_id, 'admin', 'update_status_to_' . $status);
      $this->buildJsonResponse($result['message'], 200);
    } else {
      $this->buildJsonResponse($result['message'], 400);
    }
  }
  
}