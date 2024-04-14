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


    View::render(
      'admin/dashboard',
      [
        'userCounts' => $userCounts,
        'materialCounts' => $materialCounts,
        'requestCounts' => $requestCounts,
        'projectCounts' => $projectCounts,
        'reportCounts' => $reportCounts,
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
    if (Session::get('admin')['admin_id'] != 1) {
      $this->previousUrl();
    }
    $query = $_GET['query'] ?? '';
    $page = $_GET['page'] ?? 1;
    if ($page < 1) {
      $page = 1;
    }

    $logs = (new AdminActionLogModel())->getLogs($query, $page);
    $totalData = (new AdminActionLogModel())->getLogsCount($query);

    View::render('admin/actionLog', [
      'logs' => $logs,
      'totalData' => $totalData,
      'query' => $query,
      'page' => $page

    ]);
  }

  public function myLog($id)
  {
    $adminId = Session::get('admin')['admin_id'];
    if ($adminId != $id) {
      Session::flash('error', ['message' => 'You are not authorized to view this page']);
      $this->previousUrl();
    }
    $query = $_GET['query'] ?? '';
    $page = $_GET['page'] ?? 1;
    if ($page < 1) {
      $page = 1;
    }

    $logs = (new AdminActionLogModel())->getLogsByAdminId($adminId, $query, $page);
    $totalData = (new AdminActionLogModel())->getLogsCountByAdminId($adminId, $query);

    View::render('admin/actionLog', [
      'logs' => $logs,
      'totalData' => $totalData,
      'query' => $query,
      'page' => $page
    ]);
  }

  public function view($targetType, $targetId)
  {
    $page = 1;
    $totalData = 1;
    $query = '';

    switch ($targetType) {
      case 'user':
        $target = (new UserProfileViewModel())->getUserById($targetId);
        View::render('admin/userManagement', [
          'users' => [$target], //passing as array to use the same view because there is a foreach loop in the view
          'page' => $page,
          'totalData' => $totalData,
          'query' => $query
        ]);
        break;
      case 'material':
        $target = (new MaterialViewModel())->getMaterialDetailById($targetId);
        View::render('admin/materialManagement', [
          'materials' => [$target],
          'page' => $page,
          'totalData' => $totalData,
          'query' => $query
        ]);
        break;
      case 'request':
        $target = (new StudyMaterialRequestModel())->getRequestDetailById($targetId);
        View::render('admin/requestManagement', [
          'requests' => [$target],
          'page' => $page,
          'totalData' => $totalData,
          'query' => $query
        ]);
        break;
      case 'project':
        $target = (new GithubProjectModel())->getProjectDetailById($targetId);
        View::render('admin/projectManagement', [
          'projects' => [$target],
          'page' => $page,
          'totalData' => $totalData,
          'query' => $query
        ]);
        break;
      case 'admin':
        if (Session::get('admin')['admin_id'] == 1) {
          $target = (new AdminModel())->getAdminById($targetId);
          View::render('admin/adminManagement', [
            'admins' => [$target],
            'page' => $page,
            'totalData' => $totalData,
            'query' => $query
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
      case 'report':
        $model = new ReportModel();
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


  public function delete($targetType, $targetId)
  {
    // check if user_id and status are set
    if (!isset($targetId) || !isset($targetType)) {
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

    // making 1st char uppercase of target type because the model method is in camel case
    //eg: deleteUser, deleteMaterial, deleteRequest, deleteProject, deleteAdmin
    $method = 'delete' . ucfirst($targetType);

    $result = $model->$method($targetId);

    if ($result['status']) {
      (new AdminActionLogModel())->log(Session::get('admin')['admin_id'], $targetId, $targetType, 'delete');
      $this->buildJsonResponse($result['message'], 200);
    } else {
      $this->buildJsonResponse($result['message'], 400);
    }
  }
}