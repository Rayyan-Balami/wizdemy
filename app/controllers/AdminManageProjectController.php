<?php

class AdminManageProjectController extends Controller
{
  public function __construct()
  {
    parent::__construct(new GithubProjectModel());
  }

  public function index()
  {
    $query = $_GET['query'] ?? '';
    $page = $_GET['page'] ?? 1;
    if ($page < 1) {
      $page = 1;
    }
    
    $projects = $this->model->getProjectsForAdmin($query, $page);
    $totalData = $this->model->getProjectCountForAdmin($query);
    
    View::render('admin/projectManagement', [
      'projects' => $projects,
      'totalData' => $totalData,
      'page' => $page,
      'query' => $query
      
    ]);
  }
  
}