<?php
require_once "config.php";
require_once "/assets/components/ToastNotification.php";

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("failed to connect to database");




/**
 * @name showpage
 * @param string $page
 * array string $data
 * @param string $data
 * @return void
 */
function showPage(string $page, array $data =['']) : void
{
    require_once "./assets/pages/$page.php";
}

/**
 * @name show toast notification
 * @param string $msg
 * @param string $type
 * @param int $duration
 * @return void
 */
function showToast(string $msg, string $type = 'info', int $duration = 300) : void
{
    $toast = new ToastNotification($msg, $duration, $type);
    $toast->show();
}

/**
 * @name validate Signup Form
 * @param array $data
 * @return array
 */
function validateSignupForm(array $data) : array
{
    $errors = [];
    $data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $data['password'] = filter_var($data['password'], FILTER_SANITIZE_STRING);
    $data['confirmPassword'] = filter_var($data['confirmPassword'], FILTER_SANITIZE_STRING);
    $data['agree-terms-conditions'] = $data['agree-terms-conditions'] ?? '';

    if (empty($data['name'])) {
        $errors['msg'] = "Name is required";
        $errors['status'] = false;
        $errors['field'] = 'name';
    }else if (empty($data['email'])) {
        $errors['msg'] = "Email is required";
        $errors['status'] = false;
        $errors['field'] = 'email';
    }else if (empty($data['password'])) {
        $errors['msg'] = "Password is required";
        $errors['status'] = false;
        $errors['field'] = 'password';
    }else if ($data['password']<8) {
        $errors['msg'] = "Password must be 8 characters long";
        $errors['status'] = false;
        $errors['field'] = 'password';
    }else if (empty($data['confirmPassword'])) {
        $errors['msg'] = "Confirm Password is required";
        $errors['status'] = false;
        $errors['field'] = 'confirmPassword';
    }else if ($data['password'] !== $data['confirmPassword']) {
        $errors['msg'] = "Password and Confirm Password must be same";
        $errors['status'] = false;
        $errors['field'] = 'confirmPassword';
    }else if (empty($data['agree-terms-conditions'])) {
        $errors['msg'] = "Please agree to our terms and conditions";
        $errors['status'] = false;
        $errors['field'] = 'agree-terms-conditions';
    }else {
        $errors['msg'] = "Success";
        $errors['status'] = true;
        $errors['field'] = '';
    }

    return $errors;

}
