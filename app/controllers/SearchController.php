<?php

class SearchController extends Controller
{
    public function __construct()
    {
        parent::__construct(new MaterialViewModel());
    }
    public function index()
    {
        $search = $_GET['q'] ?? '';
        // $materials = $this->model->searchMaterials($search);
        View::render('searchResult');
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
}