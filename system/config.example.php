<?php

// Be sure to update the following lines with your own database

// Website configuration
define('SITE_NAME', 'WizDemy');
define('SITE_DOMAIN', $_SERVER['HTTP_HOST']);
define('SITE_DESCRIPTION', 'WizDemy is a platform for students to share study materials, ask questions and get answers');
define('SITE_AUTHOR', 'Rayyan Balami and Satish Chaudhary');
define('SITE_KEYWORDS', 'study materials, questions, answers, students, education, learning, sharing');

// Current status of the site
define('STATUS', 'development'); // Options: development, production, maintenance

// Database configuration
define('DATABASE', 'mysql'); // Database type (e.g., mysql, pgsql)
define('DB_HOST', 'localhost'); // Database host
define('DB_USER', 'root'); // Database username
define('DB_PASS', 'password'); // Database password (use environment variables for better security)
define('DB_NAME', 'wizdemy'); // Database name
define('DB_PORT', '3306'); // Database port
define('DB_CHARSET', 'utf8mb4'); // Database charset

// Note: For better security, consider using environment variables to store sensitive information like DB_USER and DB_PASS.