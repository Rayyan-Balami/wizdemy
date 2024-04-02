<?php

class AdminManageMaterialController extends Controller
{
  public function __construct()
  {
    parent::__construct(new StudyMaterialModel());
  }

  public function index()
  {
    View::render('admin/dashboard');
  }

}