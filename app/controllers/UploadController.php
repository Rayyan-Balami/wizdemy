<?php

class UploadController extends Controller
{
  public function __construct()
  {
    parent::__construct(new StudyMaterialModel());
  }

  public function index($request_id = null)
  {
    $request_id = $request_id ?? Session::get('post')['request_id'] ?? null;
    $requestDetails = null;

    if ($request_id) {
      $requestDetails = (new StudyMaterialRequestModel())->getRequestDetailById($request_id);
      if (!$requestDetails) {
        Session::flash('error', ['message' => 'Invalid request']);
        $this->redirect('/material/create');
        return;
      }
    }

    View::render('uploadForm', ['requestDetails' => $requestDetails]);
  }

  public function store($request_id = null)
  {
    //hadle html special characters for security purposes and store in variables
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $user_id = Session::get('user')['user_id'];
    $document_type = htmlspecialchars($_POST['document-type']);
    $format = htmlspecialchars($_POST['format']);
    $education_level = htmlspecialchars($_POST['educationLevel']);
    $semester = htmlspecialchars($_POST['semester']);
    $subject = htmlspecialchars($_POST['subject']);
    $class_faculty = htmlspecialchars($_POST['classFaculty']);
    $author = htmlspecialchars($_POST['author']);


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
    if (!empty ($this->errors)) {
      Session::flash('post', ['request_id' => $request_id]);
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
      $this->redirect('/material/create');
    }

    //upload files in the server
    $imageUpload = File::upload($imageFile, 'assets/uploads/thumbnails');
    $documentUpload = File::upload($documentFile, 'assets/uploads/documents');
    if (!$imageUpload['status'] || !$documentUpload['status']) {
      Session::flash('post', ['request_id' => $request_id]);
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
      $this->redirect('/material/create');
    }

    //store material in the database
    $result = $this->model->store(
      $user_id,
      $request_id,
      $title,
      $description,
      $document_type,
      $format,
      $education_level,
      $semester,
      $subject,
      $class_faculty,
      $author,
      $imageUpload['file_path'],
      $documentUpload['file_path']
    );

    if ($result['status']) {
      Session::flash('success', [
        'message' => $result['message']
      ]);
      $this->redirect('/'. $document_type);
    } else {
      Session::flash('post', ['request_id' => $request_id]);
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
      $this->redirect('/material/create');
    }
  }
  public function edit($material_id)
  {
    $material = $this->model->getMaterialById($material_id);
    if (!$material) {
      Session::flash('error', ['message' => 'Invalid material']);
      $this->redirect('/material/create');
      return;
    }

    View::render('editUploadForm', ['material' => $material]);
  }
  public function update($material_id)
  {
    //hadle html special characters for security purposes and store in variables
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $document_type = htmlspecialchars($_POST['document-type']);
    $format = htmlspecialchars($_POST['format']);
    $education_level = htmlspecialchars($_POST['educationLevel']);
    $semester = htmlspecialchars($_POST['semester']);
    $subject = htmlspecialchars($_POST['subject']);
    $class_faculty = htmlspecialchars($_POST['classFaculty']);
    $author = htmlspecialchars($_POST['author']);

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

    // get the old material details
    $material = $this->model->getMaterialById($material_id);

    //check if there are any errors
    if (!empty ($this->errors)) {
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
      $this->redirect('/material/edit/' . $material_id);
    }

    // reupload files in the server
    $imageUpload = File::reupload($material['thumbnail_path'], $imageFile, 'assets/uploads/thumbnails');
    $documentUpload = File::reupload($material['file_path'], $documentFile, 'assets/uploads/documents');
    if (!$imageUpload['status'] || !$documentUpload['status']) {
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
      $this->redirect('/material/edit/' . $material_id);
    }

    //update material in the database
    $result = $this->model->updateMaterial(
      $material_id,
      $title,
      $description,
      $document_type,
      $format,
      $education_level,
      $semester,
      $subject,
      $class_faculty,
      $author,
      $imageUpload['file_path'],
      $documentUpload['file_path']
    );

    if ($result['status']) {
      Session::flash('success', [
        'message' => $result['message']
      ]);
      $this->redirect('/'. $document_type);
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
        'class_faculty' => $class_faculty,
        'format' => $format,
        'author' => $author
      ]);
      $this->redirect('/material/edit/' . $material_id);
    }
  }
}