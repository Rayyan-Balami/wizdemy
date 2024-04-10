<?php

class ReportController extends Controller
{

  public function __construct()
  {
    parent::__construct(new ReportModel());
  }

  public function index($targetType = null, $targetId = null)
  {
    // $request_id = $request_id ?? Session::get('post')['request_id'] ?? null;
    // $requestDetails = null;
    // if ($request_id) {
    //   $requestDetails = (new StudyMaterialRequestModel())->getRequestDetailById($request_id);
    //   if (!$requestDetails) {
    //     Session::flash('error', ['message' => 'Invalid request']);
    //     $this->redirect('/material/create');
    //     return;
    //   }
    // }
    $targetId = $targetId ?? Session::get('post')['target_id'] ?? null;
    $targetType = $targetType ?? Session::get('post')['target_type'] ?? null;
    $reportDetails = null;

    if ($targetId && $targetType) {
      if($targetType == 'user'){
        $reportDetails = (new UserModel())->userDetails($targetId);
      } else if($targetType == 'material'){
        $reportDetails = (new MaterialViewModel())->getMaterialDetailById($targetId);
      } else if($targetType == 'request'){
        $reportDetails = (new StudyMaterialRequestModel())->getRequestDetailById($targetId);
      } else if($targetType == 'project'){
        $reportDetails = (new GithubProjectModel())->getProjectDetailById($targetId);
      }
    }

    // echo "<pre>";
    // echo $targetId;
    // echo $targetType;
    // var_dump($reportDetails);
    // echo "</pre>";
    // die();

    View::render('reportForm', [
      'reportDetails' => $reportDetails,
      'targetId' => $targetId,
      'targetType' => $targetType
    ]);

  }
}