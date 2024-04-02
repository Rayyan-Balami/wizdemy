<?php

class AdminManageProjectController extends Controller
{
  public function __construct()
  {
    parent::__construct(new GithubProjectModel());
  }

  public function index()
  {
    $projects = $this->model->getProjectsForAdmin();
    View::render('admin/projectManagement', [
      'projects' => $projects
    ]);
  }
  
}