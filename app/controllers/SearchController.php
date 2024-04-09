<?php

class SearchController extends Controller
{
    public function __construct()
    {
        parent::__construct(new MaterialViewModel());
    }
    public function index()
    {
        $query = $_GET['q'];
        if (!$query)
            $this->redirect();
        $materials = $this->model->search($query);
        View::render('searchResult', [
            'materials' => $materials
        ]);
    }
    public function searchSuggestions()
    {
        $search = trim($_GET['q']);
        if (!$search) {
            $this->buildJsonResponse([
                'status' => 'error',
                'message' => 'Search query is required'
            ], 400);
        }
        $suggestions = $this->model->searchSuggestions($search);
        // make suggestions string array
        $suggestions = array_map(function ($suggestion) {
            return $suggestion['title'];
        }, $suggestions);

        if ($suggestions) {
            $this->buildJsonResponse([
                'status' => 'success',
                'suggestions' => $suggestions
            ]);
        } else {
            $this->buildJsonResponse([
                'status' => 'error',
                'message' => 'No matches found'
            ]);
        }
    }
    public function search()
    {
        $search = trim($_GET['q']);
        $searchType = $_POST['search_type'];
        $category = $_POST['category'];
        if (!$search) {
            $this->buildJsonResponse([
                'status' => 'error',
                'message' => 'Search query is required'
            ], 400);
        }
        if ($searchType == 'material') {
            $materials = $this->model->search($search, $category);
            $this->buildJsonResponse($materials);
        } else if ($searchType == 'request') {
            $requests = (new StudyMaterialRequestModel())->search($search, $category);
            $this->buildJsonResponse($requests);
        } else if ($searchType == 'project') {
            // change space to _
            $search = str_replace(' ', '_', $search);
            $projects = (new GithubProjectModel())->search($search);
            $this->buildJsonResponse($projects);
        } else if ($searchType == 'user') {
            $users = (new UserProfileViewModel())->search($search);
            $this->buildJsonResponse($users);
        } else {
            $this->buildJsonResponse([
                'status' => 'error',
                'message' => 'Invalid search type'
            ], 400);
        }
    }
}
