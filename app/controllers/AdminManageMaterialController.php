<?php

class AdminManageMaterialController extends Controller
{
  public function __construct()
  {
    parent::__construct(new StudyMaterialModel());
  }

  public function index()
  {
    $query = $_GET['query'] ?? '';
    $page = $_GET['page'] ?? 1;
    if ($page < 1) {
      $page = 1;
    }

    $materials = (new MaterialViewModel())->getMaterialsForAdmin($query, $page);
    $totalData = (new MaterialViewModel())->getMaterialsCountForAdmin($query);

    View::render('admin/materialManagement', [
      'materials' => $materials,
      'totalData' => $totalData,
      'page' => $page,
      'query' => $query
      
    ]);
  }

}