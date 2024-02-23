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
    protected function previousUrl($url = '/'){
        if(isset($_SERVER['HTTP_REFERER'])){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }else{
            $this->redirect($url);
        }
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
        require_once base_path("views/status.php");
        die();
    }

    protected function buildJsonResponse($data, $status = 200) {
        $response = ['data' => $data]; // Wrap data in a 'data' property
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($response);
        die();
    }

}