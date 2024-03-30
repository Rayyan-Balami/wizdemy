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
        $file = BASE_PATH . $directory . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    // If the class file is not found in any directory, show an error message
    echo 'Class ' . $className . ' not found';
}
