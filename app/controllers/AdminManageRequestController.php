<?php

class AdminManageRequestController extends Controller
{
  public function __construct()
  {
    parent::__construct(new StudyMaterialRequestModel());
  }

  public function index()
  {


    $query = $_GET['query'] ?? '';
    $page = $_GET['page'] ?? 1;
    if ($page < 1) {
      $page = 1;
    }
    $requests = $this->model->getRequestsForAdmin($query, $page);
    $totalData = $this->model->getRequestCountForAdmin($query);

    View::render('admin/requestManagement', [
      'requests' => $requests,
      'totalData' => $totalData,
      'page' => $page,
      'query' => $query
    ]);
  }
}
