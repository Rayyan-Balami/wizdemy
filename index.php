<?php
// show error log
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/assets/php/functions.php';

if (isset($_GET['signup'])) {
    showPage('signupForm', ['page_title' => 'Signup']);
} else {
    echo "page not found";
}

unset($_SESSION['error']);
unset($_SESSION['old']);