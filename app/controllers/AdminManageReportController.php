<?php

class AdminManageReportController extends Controller
{
  public function __construct()
  {
    parent::__construct(new ReportModel());
  }

  public function index()
  {

    $query = $_GET['query'] ?? '';
    $page = $_GET['page'] ?? 1;
    if ($page < 1) {
      $page = 1;
    }
    $reports = $this->model->getReportsForAdmin($query, $page);
    $totalData = $this->model->getReportCountForAdmin($query);
    View::render('admin/reportManagement', [
      'reports' => $reports,
      'totalData' => $totalData,
      'page' => $page,
      'query' => $query
    ]);
  }
}