<?php

class AdminManageRequestController extends Controller
{
  public function __construct()
  {
    parent::__construct(new StudyMaterialRequestModel());
  }

  public function index()
  {
    $requests = $this->model->getRequestsForAdmin();
    View::render('admin/adminRequestManagement', [
      'requests' => $requests
    ]);
  }
}
