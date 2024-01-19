<?php
// show error log
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/assets/php/functions.php';


if (isset($_GET['logout'])) {
    unset($_SESSION['Auth']);
    unset($_SESSION['user_id']);
    $_SESSION['toastMessage'] = [
        'msg' => 'Logout successfully',
        'type' => 'primary',
        'duration' => 5000
    ];
    header('location:/');
} else if (isset($_GET['dashboard']) ) {
    if (isset($_SESSION['Auth'])) {
        showPage('dashboard');
    } else {
        header('location:/?login');
    }
} else if (isset($_GET['signup'])) {
    if (isset($_SESSION['Auth'])) {
        header('location:/');
    } else {
        showPage('signupForm');
    }
} else if (isset($_GET['login'])) {
    if (isset($_SESSION['Auth'])) {
        header('location:/');
    } else {
        showPage('loginForm');
    }
} else {
    showPage('index');

}

unset($_SESSION['error']);
unset($_SESSION['old']);