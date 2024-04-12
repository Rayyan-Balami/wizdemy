<?php

class AdminManageMaterialController extends Controller
{
  public function __construct()
  {
    parent::__construct(new StudyMaterialModel());
  }

  public function index()
  {
    $materials = (new MaterialViewModel())->showAdmin();
    View::render('admin/materialManagement', [
      'materials' => $materials
    ]);
  }

}