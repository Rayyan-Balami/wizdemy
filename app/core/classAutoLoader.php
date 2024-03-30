<?php

// Register the class autoloader
spl_autoload_register('classAutoLoader');

function classAutoLoader($className)
{
    // Define the directories to search for classes
    $directories = [
        'app/controllers/',
        'app/models/',
        'app/middlewares/',
        'app/core/'
    ];

    // Iterate through each directory and try to load the class file
    foreach ($directories as $directory) {
        // $file = BASE_PATH . $directory . $className . '.class.php';
        $model = BASE_PATH . $directory . $className . '.model.php';
        $controller = BASE_PATH . $directory . $className . '.controller.php';
        $middleware = BASE_PATH . $directory . $className . '.middleware.php';
        $core = BASE_PATH . $directory . $className . '.core.php';
        // if (file_exists($file)) {
        //     require_once $file;
        //     return;
        // }
        if (file_exists($model)) {
            require_once $model;
            return;
        } elseif (file_exists($controller)) {
            require_once $controller;
            return;
        } elseif (file_exists($middleware)) {
            require_once $middleware;
            return;
        } elseif (file_exists($core)) {
            require_once $core;
            return;
        } else {
            continue;
        }
    }

    // If the class file is not found in any directory, show an error message
    echo 'Class ' . $className . ' not found';
}
