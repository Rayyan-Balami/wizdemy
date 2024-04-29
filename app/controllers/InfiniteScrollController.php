<?php

class InfiniteScrollController extends Controller
{
    public function __construct()
    {
        parent::__construct(new StudyMaterialModel());
    }

    public function index()
    {
        $pageNumber = $_GET['page'] ?? 1;
        $pageName = !empty($_GET['currentPage']) ? $_GET['currentPage'] : 'note';
        
        $data = [];

        if ($pageName == 'project') {
            $data = (new GithubProjectModel)->show($pageNumber);
        }else if($pageName == 'note' || $pageName == 'question' || $pageName == 'labreport'){
            $data = $this->model->show( $pageName, $pageNumber);
        }
        sleep(1);
        if($data){
            $this->buildJsonResponse($data);
        }else{
            $this->buildJsonResponse(['error' => 'No data found'], 404);
        }

    }
}