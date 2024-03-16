<?php

class UploadController extends Controller
{
  public function __construct()
  {
    parent::__construct('UploadModel');
  }

  public function index()
  {
    //get request details if request_id is set
    $request_id = $_POST['request_id'] ?? Session::get('post')['request_id'] ?? null;
    $requestDetails = [];
    if($request_id > 0 && !empty($request_id)){
      $requestDetails = $this->model->getRequestDetails($request_id);
    }
    View::render('uploadForm', [
      'requestDetails' => $requestDetails
    ]);
  }
  public function store()
  {
    //hadle html special characters for security purposes and store in variables
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $user_id = Session::get('user')['user_id'];
    $document_type = htmlspecialchars($_POST['document-type']);
    $format = htmlspecialchars($_POST['format']);
    $education_level = htmlspecialchars($_POST['education-level']);
    $semester = htmlspecialchars($_POST['semester']);
    $subject = htmlspecialchars($_POST['subject']);
    $class_faculty = htmlspecialchars($_POST['class-faculty']);
    $author = htmlspecialchars($_POST['author']);
    $request_id = null;
    if(isset($_POST['request_id']) && !empty($_POST['request_id'])){
      $request_id = filter_var($_POST['request_id'], FILTER_SANITIZE_NUMBER_INT);
    }

    $imageFile = $_FILES['imageFile'];
    $documentFile = $_FILES['documentFile'];

    //validate title
    if (!Validate::string($title, 10, 150)) {
      $this->errors['title'] = 'Title: 10-150 characters';
    }

    //validate description
    if (!Validate::string($description, 10, 550)) {
      $this->errors['description'] = 'Description: 10-550 characters';
    }

    //validate subject
    if (!Validate::string($subject, 3, 50)) {
      $this->errors['subject'] = 'Subject: 3-50 characters';
    }

    //validate class faculty
    if (!Validate::string($class_faculty, 2, 15)) {
      $this->errors['class_faculty'] = 'Short Class/Faculty: BCA, CSIT, Management';
    }

    //validate author
    if (!Validate::string($author, 3, 25)) {
      $this->errors['author'] = 'Author: 3-50 characters';
    }

     //validate image file
    $validImageFile = Validate::file(
      $imageFile,
      'image',
      ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'],
      2 * 1024 * 1024 //2MB
    );
    if (!$validImageFile['status']) {
      $this->errors['imageFile'] = $validImageFile['message'];
    }

    //validate document file
    $validDocumentFile = Validate::file(
      $documentFile,
      'document',
      ['application/pdf'],
      5 * 1024 * 1024 //5MB
    );
    if (!$validDocumentFile['status']) {
      $this->errors['documentFile'] = $validDocumentFile['message'];
    }

    //check if there are any errors
    if (!empty($this->errors)) {
      Session::flash('post',['request_id' => $request_id]);
      Session::flash('errors', $this->errors);
      Session::flash('old', [
        'title' => $title,
        'description' => $description,
        'document_type' => $document_type,
        'education_level' => $education_level,
        'semester' => $semester,
        'subject' => $subject,
        'class_faculty' => $class_faculty,
        'format' => $format,
        'author' => $author
      ]);
      $this->redirect('/upload');
    }

    //upload files in the server
    $imageUpload = File::upload($imageFile, 'assets/uploads/thumbnails');
    $documentUpload = File::upload($documentFile, 'assets/uploads/documents');
    if(!$imageUpload['status'] || !$documentUpload['status']){
      Session::flash('post',['request_id' => $request_id]);
      Session::flash('error', [
        'message' => 'Failed to upload file'
      ]);
      Session::flash('old', [
        'title' => $title,
        'description' => $description,
        'document_type' => $document_type,
        'education_level' => $education_level,
        'semester' => $semester,
        'subject' => $subject,
        'class_faculty' => $class_faculty,
        'format' => $format,
        'author' => $author
      ]);
      $this->redirect('/upload');
    }

    //store request in the database
    $result = $this->model->store($user_id, $request_id, $title, $description, $document_type, $format, $education_level, $semester, $subject, $class_faculty, $author, $imageUpload['file_path'], $documentUpload['file_path']);

    if ($result['status']) {
      Session::flash('success', [
        'message' => $result['message']
      ]);
      $this->redirect('/');
    } else {
      Session::flash('post',['request_id' => $request_id]);
      Session::flash('error', [
        'message' => $result['message']
      ]);
      Session::flash('old', [
        'request_id' => $request_id,
        'title' => $title,
        'description' => $description,
        'document_type' => $document_type,
        'education_level' => $education_level,
        'semester' => $semester,
        'subject' => $subject,
        'class_faculty' => $class_faculty,
        'format' => $format,
        'author' => $author
      ]);
      $this->redirect('/upload');
    }
  }
}