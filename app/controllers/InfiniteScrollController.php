<?php

class InfiniteScrollController extends Controller
{
    public function __construct()
    {
        parent::__construct(new MaterialViewModel());
    }

    public function index()
    {
        $pageNumber = $_GET['page'] ?? 1;
        $pageName = $_GET['currentPage']??'';

        if ($pageName == 'project') {
            $data = (new GithubProjectModel)->show($pageNumber);
        }else if($pageName == '' || $pageName == 'question' || $pageName == 'labreport'){
            $data = $this->model->show( $pageName, $pageNumber,);
        }
        // sleep(3);
        if($data){
            $this->buildJsonResponse($data);
        }else{
            $this->buildJsonResponse(['error' => 'No data found'], 404);
        }

    }
}