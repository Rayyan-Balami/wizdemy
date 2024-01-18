<?php
// require config file
require_once __DIR__ . '/config.php';
req_once('assets/components/ToastNotification.php');


$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("failed to connect to database");


/**
 * @name req_once
 * @param string $path
 * @param array $data
 * @return void
 */
function req_once(string $path, array $data = []): void
{
    require_once ROOT_DIR . $path;
}


/**
 * @name showpage
 * @param string $page
 * @return void
 */
function showPage(string $page ): void{
    req_once("assets/pages/$page.php");

}

/**
 * @name show toast notification
 * @param string $msg
 * @param string $type
 * @param int $duration
 * @return void
 */
function showTostMessaage(string $msg, string $type = 'info', int $duration = 3000): void
{
    $toast = new ToastNotification($msg, $duration, $type);
    $toast->show();
}

/**
 * @name validate Signup Form
 * @param array $data
 * @return array
 */
function validateSignupForm(array $data): array
{
    $data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $data['password'] = filter_var($data['password'], FILTER_SANITIZE_STRING);
    $data['confirmPassword'] = filter_var($data['confirmPassword'], FILTER_SANITIZE_STRING);
    $data['agree-terms-condition'] = $data['agree-terms-condition'] ?? '';

    if (empty($data['name'])) {
        return [
            'msg' => "Name is required",
            'status' => false,
            'field' => 'name'
        ];
    } else if (empty($data['email'])) {
        return [
            'msg' => "Email is required",
            'status' => false,
            'field' => 'email'
        ];
    } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        return [
            'msg' => "Invalid Email",
            'status' => false,
            'field' => 'email'
        ];
    } else if (checkEmailExists($data['email'])) {
        return [
            'msg' => "Email already exists",
            'status' => false,
            'field' => 'email'
        ];
    } else if (empty($data['password'])) {
        return [
            'msg' => "Password is required",
            'status' => false,
            'field' => 'password'
        ];
    } else if (strlen($data['password']) < 8) {
        return [
            'msg' => "Password must be atleast 8 characters",
            'status' => false,
            'field' => 'password'
        ];
    } else if (empty($data['confirmPassword'])) {
        return [
            'msg' => "Confirm Password is required",
            'status' => false,
            'field' => 'confirmPassword'
        ];
    } else if ($data['password'] !== $data['confirmPassword']) {
        return [
            'msg' => "Password and Confirm Password must be same",
            'status' => false,
            'field' => 'confirmPassword'
        ];
    } else if (empty($data['agree-terms-condition'])) {
        return [
            'msg' => "Please agree to terms and conditions",
            'status' => false,
            'field' => 'agree-terms-condition'
        ];
    } else {
        return [
            'msg' => "Success",
            'status' => true,
            'field' => ''
        ];
    }

}

/**
 * @name Check if email exists in the database
 * @param string $email
 * @return bool
 */
function checkEmailExists(string $email): bool
{
    global $db;
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result) > 0;
}

/**
 * @name signup user
 * @param array $data
 * @return array
 */
function signup(array $data): array
{
    global $db;

    $name = mysqli_real_escape_string($db, $data['name']);
    $email = mysqli_real_escape_string($db, $data['email']);
    // username is first part of email
    $username = explode('@', $email)[0];
    $username = mysqli_real_escape_string($db, $username);
    $userquery = "INSERT INTO users (email,full_name,username) VALUES ('$email','$name','$username')";
    $result = mysqli_query($db, $userquery);
    if ($result) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user_id = mysqli_insert_id($db);
        $passwordquery = "INSERT INTO user_passwords (user_id,password) VALUES ('$user_id','$password')";
        $result = mysqli_query($db, $passwordquery);
        if (!$result) {
            $userquery = "DELETE FROM users WHERE id='$user_id'";
            mysqli_query($db, $userquery);
            return [
                'msg' => "Something went wrong",
                'status' => false,
                'type' => 'error'
            ];
        }
        return [
            'msg' => "Account created successfully",
            'status' => true,
            'type' => 'success'
        ];
    } else {
        return [
            'msg' => "Something went wrong",
            'status' => false,
            'type' => 'error'
        ];
    }

}


/**
 * @name validate login form
 * @param array $data
 * @return array
 */
function validateLoginForm(array $data): array{
    $data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $data['password'] = filter_var($data['password'], FILTER_SANITIZE_STRING);

    if (empty($data['email'])) {
        return [
            'msg' => "Email is required",
            'status' => false,
            'field' => 'email'
        ];
    } else if (empty($data['password'])) {
        return [
            'msg' => "Password is required",
            'status' => false,
            'field' => 'password'
        ];
    } else {
        return [
            'msg' => "Success",
            'status' => true,
            'field' => ''
        ];
    }
}

/**
 * @name login user
 * @param array $data
 * @return array
 */
function login(array $data): array
{
    global $db;
    //verify email or username
    $email_username = mysqli_real_escape_string($db, $data['email']);
    $query = "SELECT * FROM users WHERE email='$email_username' OR username='$email_username'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $user_id = $user['id'];
        $passwordquery = "SELECT * FROM user_passwords WHERE user_id='$user_id'";
        $result = mysqli_query($db, $passwordquery);
        if (mysqli_num_rows($result) > 0) {
            $password = mysqli_fetch_assoc($result)['password'];
            if (password_verify($data['password'], $password)) {
                return [
                    'user_id' => $user_id,
                    'msg' => "Login success",
                    'status' => true,
                    'type' => 'success'
                ];
            } else {
                return [
                    'msg' => "Invalid password",
                    'status' => false,
                    'type' => 'error'
                ];
            }
        } else {
            return [
                'msg' => "Something went wrong",
                'status' => false,
                'type' => 'error'
            ];
        }
    } else {
        return [
            'msg' => "Invalid email or username",
            'status' => false,
            'type' => 'error'
        ];
    }
}
