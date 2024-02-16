<?php

// show error log
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

const BASE_PATH = __DIR__.'/../';

require_once BASE_PATH.'app/core/functions.php';
require_once base_path('system/config.php');
require_once base_path('app/core/classAutoLoader.php');

Session::start();
$router = new Router();
require_once base_path('system/routes.php');


$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->run($uri, $method);