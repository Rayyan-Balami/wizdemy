<?php

class AdminManageReportController extends Controller
{
  public function __construct()
  {
    parent::__construct(new ReportModel());
  }

  public function index()
  {
    $reports = $this->model->showAdmin();
    View::render('admin/reportManagement', [
      'reports' => $reports
    ]);
  }
}