<?php
// show error log
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/assets/php/functions.php';

$request = $_SERVER['REQUEST_URI'];

// Remove any query parameters
if (($pos = strpos($request, '?')) !== false) {
    $request = substr($request, 0, $pos);
}

// Trim leading and trailing slashes
$request = trim($request, '/');

switch ($request) {
    case '':
        showPage('index');
        break;
    case 'login':
        if (isset($_SESSION['Auth'])) {
            header('location:/');
        } else {
            showPage('loginForm');
        }
        break;
    case 'signup':
        if (isset($_SESSION['Auth'])) {
            header('location:/');
        } else {
            showPage('signupForm');
        }
        break;
    case 'profile':
        if (isset($_SESSION['Auth'])) {
            showPage('profile');
        } else {
            header('location:/?login');
        }
        break;
    case 'u':
        $result = getUserDetailsByUsername($_GET['uname']);
        if ($result['status']) {
            print_r($result);
        } else {
            showPage('404');
        }
        break;
    case 'upload':
        if (isset($_SESSION['Auth'])&& $_SESSION['Auth']&& $_SESSION['user_id']) {
            $user = getUserDetailsById($_SESSION['user_id']);
            showPage('upload');
        } else {
            header('location:/?login');
        }
        break;
    case 'post/search':
        showPage('search');

        break;
    default:
        showPage('404');
        break;
}

// if (isset($_GET['logout'])) {
//     unset($_SESSION['Auth']);
//     unset($_SESSION['user_id']);
//     $_SESSION['toastMessage'] = [
//         'msg' => 'Logout successfully',
//         'type' => 'primary',
//         'duration' => 5000
//     ];
//     header('location:/');
// } else if (isset($_GET['dashboard']) ) {
//     if (isset($_SESSION['Auth'])) {
//         showPage('dashboard');
//     } else {
//         header('location:/?login');
//     }
// } else if (isset($_GET['signup'])) {
//     if (isset($_SESSION['Auth'])) {
//         header('location:/');
//     } else {
//         showPage('signupForm');
//     }
// } else if (isset($_GET['login'])) {
//     if (isset($_SESSION['Auth'])) {
//         header('location:/');
//     } else {
//         showPage('loginForm');
//     }
// } else {
//     showPage('index');

// }

unset($_SESSION['error']);
unset($_SESSION['old']);