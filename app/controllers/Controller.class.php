<?php

class Controller{
    protected $model;

    protected $errors = [];

    protected function __construct($modelName){
        $this->model = new $modelName();
    }
    protected function redirect($url){
        header('Location: ' . $url);
        die();
    }
    protected function previousUrl(){
        header('Location: ' . $_SERVER['HTTP_REFERER'] ?? '/');
        die();
    }

    protected function getErrors(){
        return $this->errors;
    }

    protected function buildJsonResponse($data, $status = 200) {
        $response = ['data' => $data]; // Wrap data in a 'data' property
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($response);
        die();
    }

}