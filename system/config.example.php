<?php

// Be sure to update the following lines with your own database

//website config
define('SITE_NAME', 'WizDemy');
define('SITE_DOMAIN', $_SERVER['HTTP_HOST']);
define('SITE_DESCRIPTION', 'WizDemy is a platform for students to share study materials, ask questions and get answers');
define('SITE_AUTHOR', 'Rayyan Balami and Satish Chaudhary');
define('SITE_KEYWORDS', 'study materials, questions, answers, students, education, learning, sharing');

//current status
define('STATUS', 'development');// development or production or maintenance

//db config
define('DATABASE', 'mysql');// your database type
define('DB_HOST', 'localhost');// your database host
define('DB_USER', 'root');// your database username
define('DB_PASS', 'password');// your database password
define('DB_NAME', 'wizdemy');// your database name
define('DB_PORT', '3306');// your database port
define('DB_CHARSET', 'utf8mb4');