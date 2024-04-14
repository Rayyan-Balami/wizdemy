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
    
    $projects = $this->model->getProjectsForAdmin($query, $page);
    $totalPages = $this->model->getProjectCountForAdmin($query);
    $data = [ 
      'projects' => $projects,
      'totalPages' => $totalPages,
      'page' => $page,
    ];
    dd($data);
    
    View::render('admin/projectManagement', [
      'projects' => $projects,
      'totalPages' => $totalPages,
      'page' => $page,
    ]);
  }
  
}