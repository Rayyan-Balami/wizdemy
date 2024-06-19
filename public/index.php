<?php

const BASE_PATH = __DIR__ . '/../';

if (!file_exists(BASE_PATH . 'system/config.php')) {
    echo "make sure you have created a config.php file in the system folder";
    echo "follow the instructions in the README.md file to create the config.php file";
    die();
}

require_once BASE_PATH . 'system/config.php';
require_once BASE_PATH . 'app/core/functions.php';
require_once base_path('app/core/classAutoLoader.php');


if (STATUS == 'development') {
    // show error log in development mode
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}elseif (STATUS == 'maintenance') {
    // show 503 Service Unavailable in maintenance mode 
    abort(503); 
}

//if in production mode, continue with the following code

Session::start();
$router = new Router();
require_once base_path('system/routes.php');


$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->run($uri, $method);