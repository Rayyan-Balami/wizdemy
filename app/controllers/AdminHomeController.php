<?php

class AdminHomeController extends Controller
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
    $myLogs = (new AdminActionLogModel())->getLogsByAdminId($adminId);
    // dd(Session::get('admin'));
    View::render('admin/dashboard', [
      'userCount' => $userCount,
      'materialCount' => $materialCount,
      'requestCount' => $requestCount,
      'projectCount' => $projectCount,
      'logs' => $myLogs
    ]);
  }


  public function accountSecurity()
  {
    $adminDetails = $this->model->getAdminById(Session::get('admin')['admin_id']);
    View::render('admin/editAndSettingAdmin', [
      'adminDetails' => $adminDetails,
      'type' => 'accountSecurity'
    ]);
  }


  public function adminLog(){
    $logs = (new AdminActionLogModel())->getLogs();
    View::render('admin/actionLog', [
      'logs' => $logs
    ]);
  }

  public function viewLog($targetType, $targetId){
    switch ($targetType) {
      case 'user':
        $target = (new UserProfileViewModel())->getUserById($targetId);
        View::render('admin/userManagement', [
          'users' => [$target] //passing as array to use the same view because there is a foreach loop in the view
        ]);
        break;
      case 'material':
        $target = (new MaterialViewModel())->getMaterialDetailById($targetId);
        View::render('admin/materialManagement', [
          'material' => [$target]
        ]);
        break;
      case 'request':
        $target = (new StudyMaterialRequestModel())->getRequestDetailById($targetId);
        View::render('admin/requestManagement', [
          'request' => [$target]
        ]);
        break;
      case 'project':
        $target = (new GithubProjectModel())->getProjectDetailById($targetId);
        View::render('admin/projectManagement', [
          'project' => [$target]
        ]);
        break;
      case 'admin':
        $target = (new AdminModel())->getAdminById($targetId);
        View::render('admin/adminManagement', [
          'admins' => [$target]
        ]);
        break;
      default:
        $this->previousUrl();
        break;
    }
  }

}