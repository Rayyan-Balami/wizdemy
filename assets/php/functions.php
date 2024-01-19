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
 * @name req
 * @param string $path
 * @param array $data
 * @return void
 */
function req(string $path, array $data = []): void
{
    require ROOT_DIR . $path;
}

/**
 * @name showpage
 * @param string $page
 * @return void
 */
function showPage(string $page): void
{
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
 * @name parse number
 * @param int $number
 * @return string
 */
function parseNumber(int $number): string
{
    if ($number >= 1000000000) {
        return round($number / 1000000000, 1) . 'B';
    } else if ($number >= 1000000) {
        return round($number / 1000000, 1) . 'M';
    } else if ($number >= 1000) {
        return round($number / 1000, 1) . 'K';
    } else {
        return $number;
    }
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
function validateLoginForm(array $data): array
{
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

/**
 * @name validate study material form
 * @param array $data
 * @return array
 */

function validateStudyMaterialForm(array $data): array
{

    $data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
    $data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
    $data['document-type'] = filter_var($data['document-type'], FILTER_SANITIZE_STRING);
    $data['format'] = filter_var($data['format'], FILTER_SANITIZE_STRING);
    $data['education-level'] = filter_var($data['education-level'], FILTER_SANITIZE_STRING);
    $data['semester'] = filter_var($data['semester'], FILTER_SANITIZE_STRING);
    $data['subject'] = filter_var($data['subject'], FILTER_SANITIZE_STRING);
    $data['class'] = filter_var($data['class'], FILTER_SANITIZE_STRING);
    $data['author'] = filter_var($data['author'], FILTER_SANITIZE_STRING);
    $data['thumbnail'] = $data['file']['file-thumbnail'];
    $data['document'] = $data['file']['file-document'];

    if (empty($data['title'])) {
        return [
            'msg' => "Title is required",
            'status' => false,
            'field' => 'title'
        ];
    } else if (empty($data['description'])) {
        return [
            'msg' => "Description is required",
            'status' => false,
            'field' => 'description'
        ];
    } else if (empty($data['document-type'])) {
        return [
            'msg' => "Document type is required",
            'status' => false,
            'field' => 'document-type'
        ];
    } else if (empty($data['format'])) {
        return [
            'msg' => "Format is required",
            'status' => false,
            'field' => 'format'
        ];
    } else if (empty($data['education-level'])) {
        return [
            'msg' => "Education level is required",
            'status' => false,
            'field' => 'education-level'
        ];
    } else if (empty($data['subject'])) {
        return [
            'msg' => "Subject is required",
            'status' => false,
            'field' => 'subject'
        ];
    } else if (empty($data['class'])) {
        return [
            'msg' => "Class is required",
            'status' => false,
            'field' => 'class'
        ];
    } else if (empty($data['author'])) {
        return [
            'msg' => "Author is required",
            'status' => false,
            'field' => 'author'
        ];
    } else if (empty($data['thumbnail']['name'])) {
        return [
            'msg' => "Thumbnail is required",
            'status' => false,
            'field' => 'file-thumbnail'
        ];
    } else if (explode('/', $data['thumbnail']['type'])[0] !== 'image') {
        return [
            'msg' => "Thumbnail must be png or jpeg",
            'status' => false,
            'field' => 'file-thumbnail'
        ];
    } else if ($data['thumbnail']['size'] > 5000000) {
        return [
            'msg' => "Thumbnail must be less than 5MB",
            'status' => false,
            'field' => 'file-thumbnail'
        ];
    } else if (empty($data['document']['name'])) {
        return [
            'msg' => "Document is required",
            'status' => false,
            'field' => 'file-document'
        ];
    } else if ($data['document']['type'] !== 'application/pdf') {
        return [
            'msg' => "Document must be pdf",
            'status' => false,
            'field' => 'file-document'
        ];
    } else if ($data['document']['size'] > 50000000) {
        return [
            'msg' => "Document must be less than 50MB",
            'status' => false,
            'field' => 'file-document'
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
 * @name upload study material
 * @param array $data
 * @return array
 */
function uploadStudyMaterial(array $data): array
{
    global $db;
    $title = mysqli_real_escape_string($db, $data['title']);
    $description = mysqli_real_escape_string($db, $data['description']);
    $document_type = mysqli_real_escape_string($db, $data['document-type']);
    $format = mysqli_real_escape_string($db, $data['format']);
    $education_level = mysqli_real_escape_string($db, $data['education-level']);
    $semester = mysqli_real_escape_string($db, $data['semester']);
    $subject = mysqli_real_escape_string($db, $data['subject']);
    $class = mysqli_real_escape_string($db, $data['class']);
    $author = mysqli_real_escape_string($db, $data['author']);
    $thumbnail = $data['file']['file-thumbnail'];
    $document = $data['file']['file-document'];
    $user_id = $_SESSION['user_id'];

    echo "<pre>";
    echo "</pre>";
    if (!file_exists(ROOT_DIR . "uploads/thumbnails")) {
        mkdir(ROOT_DIR . "uploads/thumbnails");
    }
    if (!file_exists(ROOT_DIR . "uploads/documents")) {
        mkdir(ROOT_DIR . "uploads/documents");
    }

    //create thumbnail destination
    $thumbnail_extension = explode('/', $thumbnail['type'])[1];
    $thumb_name = uniqid() . "." . $thumbnail_extension;
    $thumbnail_destination = ROOT_DIR . "uploads/thumbnails/" . time() . "_" . $thumb_name;
    //create document destination
    $document_extension = explode('/', $document['type'])[1];
    $document_name = uniqid() . "." . $document_extension;
    $document_destination = ROOT_DIR . "uploads/documents/" . time() . "_" . $document_name;

    //move thumbnail to destination
    $thumb_result = move_uploaded_file($thumbnail['tmp_name'], $thumbnail_destination);
    //move document to destination
    $document_result = move_uploaded_file($document['tmp_name'], $document_destination);

    //removve root dir from destination
    $thumbnail_destination = str_replace(ROOT_DIR, '', $thumbnail_destination);
    $document_destination = str_replace(ROOT_DIR, '', $document_destination);

    if ($thumb_result && $document_result) {
        $query = "INSERT INTO study_materials (title,description,document_type,format,education_level,semester,subject,class,author,thumbnail_path,file_path,user_id) VALUES ('$title','$description','$document_type','$format','$education_level','$semester','$subject','$class','$author','$thumbnail_destination','$document_destination','$user_id')";
        $result = mysqli_query($db, $query);
        if ($result) {
            return [
                'msg' => "Study material uploaded successfully",
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
    } else {
        return [
            'msg' => $thumbnail,
            'status' => false,
            'type' => 'error'
        ];
    }
}


/**
 * @name get study materials
 * @return array
 */
function getStudyMaterials(): array
{
    global $db;
    $query = "SELECT 
    study_materials.id,
    study_materials.respond_to,
    study_materials.title,
    study_materials.format,
    study_materials.thumbnail_path,
    study_materials.education_level,
    study_materials.semester,
    study_materials.subject,
    study_materials.class,
    study_materials.author,
    study_materials.created_at,
    users.username
    FROM study_materials
    INNER JOIN users ON study_materials.user_id=users.id
ORDER BY study_materials.created_at DESC LIMIT 10";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        $study_materials = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $study_materials[] = $row;
        }
        return [
            'msg' => "Success",
            'status' => true,
            'type' => 'success',
            'data' => $study_materials
        ];
    } else {
        return [
            'msg' => "No study materials found",
            'status' => false,
            'type' => 'error',
            'data' => []
        ];
    }
}

/**
 * @name get study materials by id
 * @param int $id
 * @return array
 */
function getStudyMaterialById(int $id): array
{
    global $db;
    $query = "SELECT 
    study_materials.id,
    study_materials.respond_to,
    study_materials.title,
    study_materials.description,
    study_materials.document_type,
    study_materials.format,
    study_materials.thumbnail_path,
    study_materials.file_path,
    study_materials.education_level,
    study_materials.semester,
    study_materials.subject,
    study_materials.class,
    study_materials.author,
    study_materials.created_at,
    users.username
    FROM study_materials
    INNER JOIN users ON study_materials.user_id=users.id
    WHERE study_materials.id='$id'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        return [
            'msg' => "Success",
            'status' => true,
            'type' => 'success',
            'data' => mysqli_fetch_assoc($result)
        ];
    } else {
        return [
            'msg' => "No study materials found",
            'status' => false,
            'type' => 'error',
            'data' => []
        ];
    }
}

/**
 * @name get study materials by user id
 * @param int $user_id
 * @return array
 */
function getStudyMaterialsByUserId(int $user_id): array
{
    global $db;
    $query = "SELECT 
    study_materials.id,
    study_materials.respond_to,
    study_materials.title,
    study_materials.format,
    study_materials.thumbnail_path,
    study_materials.education_level,
    study_materials.semester,
    study_materials.subject,
    study_materials.class,
    study_materials.author,
    study_materials.created_at,
    users.username
    FROM study_materials
    INNER JOIN users ON study_materials.user_id=users.id
    WHERE study_materials.user_id='$user_id'
    ORDER BY study_materials.created_at DESC";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        $study_materials = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $study_materials[] = $row;
        }
        return [
            'msg' => "Success",
            'status' => true,
            'type' => 'success',
            'data' => $study_materials
        ];
    } else {
        return [
            'msg' => "No study materials found",
            'status' => false,
            'type' => 'error',
            'data' => []
        ];
    }
}

/**
 * @name get study materials viewcount by user id
 * @description totoal number of views of study material
 * @param int $user_id
 * @return array
 */
function getStudyMaterialViewCount(int $study_material_id): array
{
    global $db;
    $query = "SELECT * FROM views WHERE study_material_id='$study_material_id'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        return [
            'msg' => "Success",
            'status' => true,
            'type' => 'success',
            'data' => mysqli_num_rows($result)
        ];
    } else {
        return [
            'msg' => "No study materials found",
            'status' => false,
            'type' => 'error',
            'data' => 0
        ];
    }
}

/**
 * @name get study materials like count by user id
 * @description totoal number of likes of study material
 * @param int $user_id
 * @return array
 */
function getStudyMaterialLikeCount(int $study_material_id): array
{
    global $db;
    $query = "SELECT * FROM likes WHERE study_material_id='$study_material_id'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        return [
            'msg' => "Success",
            'status' => true,
            'type' => 'success',
            'data' => mysqli_num_rows($result)
        ];
    } else {
        return [
            'msg' => "No study materials found",
            'status' => false,
            'type' => 'error',
            'data' => 0
        ];
    }
}

/**
 * @name get study materials comment count by user id
 * @description totoal number of comments of study material
 * @param int $user_id
 * @return array
 */
function getStudyMaterialCommentCount(int $study_material_id): array
{
    global $db;
    $query = "SELECT * FROM comments WHERE study_material_id='$study_material_id'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        return [
            'msg' => "Success",
            'status' => true,
            'type' => 'success',
            'data' => mysqli_num_rows($result)
        ];
    } else {
        return [
            'msg' => "No study materials found",
            'status' => false,
            'type' => 'error',
            'data' => 0
        ];
    }
}


/**
 * @name get study materials 
 * @param int $user_id
 * @return array
 */


/**
 * @name get user details by user id
 * @param int $user_id
 * @return array
 */
function getUserDetailsById(int $user_id): array
{
    global $db;
    $query = "SELECT * FROM users WHERE id='$user_id'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return [];
    }
}


/**
 * @name get user details by username
 * @param int $username
 * @return array
 */
function getUserDetailsByUsername(string $username): array
{
    global $db;
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        return [
            'status' => true,
            'data' => mysqli_fetch_assoc($result)
        ];
    } else {
        return [
            'status' => false,
            'data' => []
        ];
    }
}

