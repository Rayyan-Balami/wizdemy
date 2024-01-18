<?php
require_once "functions.php";

if (isset($_GET['signup'])) {
    $response = validateSignupForm($_POST);
    if ($response['status']) {
        $result = signup($_POST);
        if ($result['status']) {
            $_SESSION['toastMessage'] = $result;
            header('location:/index.php?login');
        } else {
            $_SESSION['toastMessage'] = $result;
            $_SESSION['old'] = $_POST;
            header('location:/index.php?signup');
        }
    } else {
        $_SESSION['toastMessage'] = [
            'msg' => $response['msg'],
            'type' => 'error',
            'duration' => 5000
        ];
        $_SESSION['old'] = $_POST;
        header('location:/index.php?signup');
    }

}