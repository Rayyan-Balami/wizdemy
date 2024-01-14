<?php
require_once 'functions.php';

if (isset($_GET['signup'])) {
    $response = validateSignupForm($_POST);
    if ($response['status']) {
        $response['msg'] = "Success";
        $response['status'] = true;
        $response['field'] = '';
    } else {
        $_SESSION['error'] = $response;
        header('location: /?signup');
    }

}