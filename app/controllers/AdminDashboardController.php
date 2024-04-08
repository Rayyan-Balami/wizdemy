<?php

class AdminDashboardController extends Controller
{
  public function __construct()
  {
    parent::__construct(new AdminModel());
  }

  public function index()
  {
    $adminId = Session::get('admin')['admin_id'];
    if (!$adminId) {
      $this->redirect('/admin/login');
      return;
    }
    $userCount = (new UserModel)->getTotalUsersCount();
    $materialCount = (new StudyMaterialModel)->getTotalMaterialsCount();
    $requestCount = (new StudyMaterialRequestModel)->getTotalRequestsCount();
    $projectCount = (new GithubProjectModel)->getTotalProjectsCount();
    // dd(Session::get('admin'));
    View::render('admin/dashboard', [
      'userCount' => $userCount,
      'materialCount' => $materialCount,
      'requestCount' => $requestCount,
      'projectCount' => $projectCount
    ]);
  }

}