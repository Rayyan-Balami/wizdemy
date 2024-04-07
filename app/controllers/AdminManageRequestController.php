<?php

class AdminManageRequestController extends Controller
{
  public function __construct()
  {
    parent::__construct(new StudyMaterialRequestModel());
  }

  public function index()
  {
    $requests = $this->model->showAdmin();
    View::render('admin/requestManagement', [
      'requests' => $requests
    ]);
  }
}
