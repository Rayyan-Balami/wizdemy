<?php

class RequestController extends Controller
{
  public function __construct()
  {
    parent::__construct('RequestModel');
  }

  public function index()
  {
    $requests = $this->model->show();
    View::render('request', [
      'requests' => $requests
    ]);
  }

  public function create()
  {
    View::render('requestForm');
  }

  public function store()
  {
    //hadle html special characters for security purposes and store in variables
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $user_id = Session::get('user')['user_id'];
    $document_type = htmlspecialchars($_POST['document-type']);
    $education_level = htmlspecialchars($_POST['education-level']);
    $semester = htmlspecialchars($_POST['semester']);
    $subject = htmlspecialchars($_POST['subject']);
    $class_faculty = htmlspecialchars($_POST['class-faculty']);
    

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

    //check if there are any errors
    if (!empty($this->errors)) {
      Session::flash('errors', $this->errors);
      Session::flash('old', [
        'title' => $title,
        'description' => $description,
        'document_type' => $document_type,
        'education_level' => $education_level,
        'semester' => $semester,
        'subject' => $subject,
        'class_faculty' => $class_faculty
      ]);
      $this->redirect('/request/create');
    }

    //store request
    $result = $this->model->create($user_id, $title, $description, $document_type, $education_level, $semester, $subject, $class_faculty);

    if ($result['status']) {
      Session::flash('success', [
        'message' => $result['message']
      ]);
      $this->redirect('/request');
    } else {
      Session::flash('error', [
        'message' => $result['message']
      ]);
      Session::flash('old', [
        'title' => $title,
        'description' => $description,
        'document_type' => $document_type,
        'education_level' => $education_level,
        'semester' => $semester,
        'subject' => $subject,
        'class_faculty' => $class_faculty
      ]);
      $this->redirect('/request/create');
    }
  }

  public function category()
  {    
    $requests = $this->model->show();
    // if(!empty($requests)){
    $this->buildJsonResponse($requests);
  }
}