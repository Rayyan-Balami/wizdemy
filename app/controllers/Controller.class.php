<?php

/**
 * Controller class
 * 
 * This class contains methods for handling controller logic
 * 
 * methods: redirect, previousUrl, abort, buildJsonResponse
 */
class Controller
{
    protected $model;

    protected $errors = [];

    /**
     * Controller constructor
     * 
     * @param string $modelName The name of the model to use
     */
    protected function __construct($modelName)
    {
        $this->model = new $modelName();
    }

    /**
     * Redirect to a specified URL
     * 
     * @param string $url The URL to redirect to
     * 
     * @return void
     */
    protected function redirect(string $url = '/')
    {
        header('Location: ' . $url);
        die();
    }

    /**
     * Redirect to the previous URL
     * 
     * @param string $url The URL to redirect to if there is no previous URL
     * 
     * @return void
     */
    protected function previousUrl(string $url = '/')
    {
        if (isset ($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        } else {
            $this->redirect($url);
        }
    }

    /**
     * Abort the request
     * 
     * @param int $code The HTTP status code to return
     * 
     * @return void
     */
    protected function abort(int $code)
    {
        http_response_code($code);
        require_once base_path("views/status.php");
        die();
    }

    /**
     * Build a JSON response
     * 
     * @param mixed $data The data to return in the response
     * @param int $status The HTTP status code to return
     * 
     * @return void
     */
    protected function buildJsonResponse($data, int $status = 200)
    {
        $response = ['data' => $data]; // Wrap data in a 'data' property
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($response);
        die();
    }

}