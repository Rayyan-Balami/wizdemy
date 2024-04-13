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

    $userCounts = (new UserModel)->getCounts();
    $materialCounts = (new StudyMaterialModel)->getCounts();
    $requestCounts = (new StudyMaterialRequestModel)->getCounts();
    $projectCounts = (new GithubProjectModel)->getCounts();
    $reportCounts = (new ReportModel)->getCounts();

    $myLogs = (new AdminActionLogModel())->getLogsByAdminId($adminId);

    View::render('admin/dashboard',
      [
        'userCounts' => $userCounts,
        'materialCounts' => $materialCounts,
        'requestCounts' => $requestCounts,
        'projectCounts' => $projectCounts,
        'reportCounts' => $reportCounts,
        'logs' => $myLogs
      ]
    );
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

  public function view($targetType, $targetId){
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
          'materials' => [$target]
        ]);
        break;
      case 'request':
        $target = (new StudyMaterialRequestModel())->getRequestDetailById($targetId);
        View::render('admin/requestManagement', [
          'requests' => [$target]
        ]);
        break;
      case 'project':
        $target = (new GithubProjectModel())->getProjectDetailById($targetId);
        View::render('admin/projectManagement', [
          'projects' => [$target]
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