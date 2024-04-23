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
    /**
     * The model instance to use in the controller
     * 
     * @var object
     */
    protected $model;

    protected $errors = [];

    /**
     * Controller constructor
     * 
     * @param object $modelInstance The model instance to use in the controller
     */
    protected function __construct($modelInstance)
    {
        $this->model = $modelInstance;
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
        if (isset ($_SERVER['HTTP_REFERER']) || Session::exists('previous_url')) {
            // header('Location: ' . $_SERVER['HTTP_REFERER']);
            // dd($_SESSION['_flash']['previous_url']);
            $url = Session::get('previous_url') ?? $_SERVER['HTTP_REFERER'];
        }
        $this->redirect($url);
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
        $response = ['data' => $data, 'status' => $status];
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($response);
        die();
    }

    //redirect post 
    protected function redirectPost($url, $method = 'post')
    {
        echo "<form action='$url' method='post' id='redirectPost'>";
        echo "<input type='hidden' name='_method' value='$method'>";
        echo "</form>";
        echo "<script>document.getElementById('redirectPost').submit();</script>";
        die();
    }

}