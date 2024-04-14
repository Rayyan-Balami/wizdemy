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

    View::render(
      'admin/dashboard',
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


  public function adminLog()
  {
    $logs = (new AdminActionLogModel())->getLogs();
    View::render('admin/actionLog', [
      'logs' => $logs
    ]);
  }

  public function view($targetType, $targetId)
  {
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
        if (Session::get('admin')['admin_id'] == 1) {
          $target = (new AdminModel())->getAdminById($targetId);
          View::render('admin/adminManagement', [
            'admins' => [$target]
          ]);
        } else {
          $this->previousUrl();
        }
        break;
      default:
        $this->previousUrl();
        break;
    }
  }
  public function updateStatus($targetType, $targetId, $status)
  {

    // check if user_id and status are set
    if (!isset($targetId) || !isset($status) || !isset($targetType)) {
      $this->buildJsonResponse('Invalid request', 400);
    }
    switch ($targetType) {
      case 'user':
        $model = new UserModel();
        break;
      case 'material':
        $model = new StudyMaterialModel();
        break;
      case 'request':
        $model = new StudyMaterialRequestModel();
        break;
      case 'project':
        $model = new GithubProjectModel();
        break;
      case 'admin':
        $model = new AdminModel();
        break;
      default:
        $this->buildJsonResponse('Invalid request', 400);
        break;
    }

    $result = $model->updateStatus($targetId, $status);

    if ($result['status']) {
      (new AdminActionLogModel())->log(Session::get('admin')['admin_id'], $targetId, $targetType, $status);
      $this->buildJsonResponse($result['message'], 200);
    } else {
      $this->buildJsonResponse($result['message'], 400);
    }

  }
}