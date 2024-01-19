<?php
require_once "functions.php";


// for signup process
if (isset($_GET['signup'])) {
    $response = validateSignupForm($_POST);
    if ($response['status']) {
        $result = signup($_POST);
        if ($result['status']) {
            $_SESSION['toastMessage'] = [
                'msg' => $result['msg'],
                'type' => 'success',
                'duration' => 5000
            ];
            header('location:/login');
        } else {
            $_SESSION['toastMessage'] = [
                'msg' => $result['msg'],
                'type' => 'error',
                'duration' => 5000
            ];
            $_SESSION['old'] = $_POST;
            header('location:/signup');
        }
    } else {
        $_SESSION['toastMessage'] = [
            'msg' => $response['msg'],
            'type' => 'error',
            'duration' => 5000
        ];
        $_SESSION['old'] = $_POST;
        header('location:/signup');
    }

}


// for login process
if (isset($_GET['login'])) {
    $response = validateLoginForm($_POST);
    if ($response['status']) {
        $result = login($_POST);
        if ($result['status']) {
            $_SESSION['Auth'] = true;
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['toastMessage'] = [
                'msg' => $result['msg'],
                'type' => 'success',
                'duration' => 5000
            ];
            header('location:/');
        } else {
            $_SESSION['toastMessage'] = [
                'msg' => $result['msg'],
                'type' => 'error',
                'duration' => 5000
            ];
            $_SESSION['old'] = $_POST;
            header('location:/login');
        }
    } else {
        $_SESSION['toastMessage'] = [
            'msg' => $response['msg'],
            'type' => 'error',
            'duration' => 5000
        ];
        $_SESSION['old'] = $_POST;
        header('location:/login');
    }
}

// for logout process

if (isset($_GET['logout'])) {
    unset($_SESSION['Auth']);
    unset($_SESSION['user_id']);
    $_SESSION['toastMessage'] = [
        'msg' => 'Logout successfully',
        'type' => 'primary',
        'duration' => 5000
    ];
    header('location:/');
}

// for upload process
if (isset($_GET['uploadStudyMaterial'])) {
    $data = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'document-type' => $_POST['document-type'],
        'format' => $_POST['format'],
        'education-level' => $_POST['education-level'],
        'semester' => $_POST['semester'],
        'subject' => $_POST['subject'],
        'class' => $_POST['class'],
        'author' => $_POST['author'],
        'file' => $_FILES,
    ];
    $response = validateStudyMaterialForm($data);
    
    if ($response['status']) {
        $result = uploadStudyMaterial($data);
        if ($result['status']) {
            $_SESSION['toastMessage'] = [
                'msg' => $result['msg'],
                'type' => 'success',
                'duration' => 5000
            ];
            header('location:/upload');
        } else {
            $_SESSION['toastMessage'] = [
                'msg' => $result['msg'],
                'type' => 'error',
                'duration' => 5000
            ];
            $_SESSION['old'] = $_POST;
            header('location:/upload');
        }
    } else {
        $_SESSION['toastMessage'] = [
            'msg' => $response['msg'],
            'type' => 'error',
            'duration' => 5000
        ];
        $_SESSION['old'] = $_POST;
        header('location:/upload');
    }
}