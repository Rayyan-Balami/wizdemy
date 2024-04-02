<?php

class AdminManageReportController extends Controller
{
  public function __construct()
  {
    parent::__construct(new UserModel());
  }

  public function index()
  {
    $users = $this->model->getUsersForAdmin();
    View::render('admin/userManagement', [
      'users' => $users
    ]);
  }
}