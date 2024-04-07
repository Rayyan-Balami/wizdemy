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
    if (!empty($this->errors)) {
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
      $this->redirect('/' . $document_type);
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
  public function edit($material_id = null)
  {
    $material_id = $material_id ?? Session::get('post')['material_id'] ?? null;

    if (!$material_id) {
      Session::flash('error', ['message' => 'Material ID is required']);
      $this->redirect('/material/create');
      return;
  }

  $materialDetails = $this->model->getMaterialById($material_id);
  if (!$materialDetails || $materialDetails['user_id'] != Session::get('user')['user_id']) {
      Session::flash('error', ['message' => 'Material not found']);
      $this->redirect('/material/create');
      return;
  }


    //if materail is a response to a request, get the request details
    $requestDetails = null;
    if ($materialDetails['request_id']) {
      $requestDetails = (new StudyMaterialRequestModel())->getRequestDetailById($materialDetails['request_id']);
    }

    View::render('editUploadForm', ['requestDetails' => $requestDetails,
    'materialDetails'=> $materialDetails]);
  }
  public function update($material_id)
  {
    if ($material_id) {
      $materialDetails = $this->model->getMaterialById($material_id);
      if (!$materialDetails || $materialDetails['user_id'] != Session::get('user')['user_id']) {
        Session::flash('error', ['message' => 'Material not found']);
        $this->redirect('/material/create');
        return;
      }
    }

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

    // if file are not uploaded, keep the old file
    if (!$_FILES['imageFile']['name'] && !$_FILES['documentFile']['name']) {
      $imageFile = $materialDetails['thumbnail_path'];
      $documentFile = $materialDetails['file_path'];
    } else {
      $imageFile = $_FILES['imageFile'];
      $documentFile = $_FILES['documentFile'];
    }
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
    if ($_FILES['imageFile']['name']) {
      $validImageFile = Validate::file(
        $imageFile,
        'image',
        ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'],
        2 * 1024 * 1024 //2MB
      );
      if (!$validImageFile['status']) {
        $this->errors['imageFile'] = $validImageFile['message'];
      }
    }
    //validate document file
    if ($_FILES['documentFile']['name']) {
      $validDocumentFile = Validate::file(
        $documentFile,
        'document',
        ['application/pdf'],
        5 * 1024 * 1024 //5MB
      );
      if (!$validDocumentFile['status']) {
        $this->errors['documentFile'] = $validDocumentFile['message'];
      }
    }
    //check if there are any errors
    if (!empty($this->errors)) {
      Session::flash('post', ['material_id' => $material_id]);
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
      $this->redirect('/material/edit');
    }

    //upload files in the server
    if ($_FILES['imageFile']['name']) {
      $imageUpload = File::upload($imageFile, 'assets/uploads/thumbnails');
      if (!$imageUpload['status']) {
      Session::flash('post', ['material_id' => $material_id]);
        Session::flash('error', [
          'message' => 'Failed to upload image file'
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
        $this->redirect('/material/edit');
      }
    }
    if ($_FILES['documentFile']['name']) {
      $documentUpload = File::upload($documentFile, 'assets/uploads/documents');
      if (!$documentUpload['status']) {
      Session::flash('post', ['material_id' => $material_id]);
        Session::flash('error', [
          'message' => 'Failed to upload document file'
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
        $this->redirect('/material/edit');
      }
    }

    //store material in the database
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
      $_FILES['imageFile']['name'] ? $imageUpload['file_path'] : $materialDetails['thumbnail_path'],
      $_FILES['documentFile']['name'] ? $documentUpload['file_path'] : $materialDetails['file_path']
    );
  
    if ($result['status']) {
      Session::flash('success', [
        'message' => $result['message']
      ]);
      $this->redirect('/material/view/' . $material_id);
    } else {
      Session::flash('post', ['material_id' => $material_id]);
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
      $this->redirect('/material/edit');
    }
  }

  public function delete($material_id)
  {
    if (!$material_id) {
      $this->buildJsonResponse([
        'status' => false,
        'message' => 'Invalid material'
      ], 400);
    }
    // check if the material belongs to the user
    $material = $this->model->getMaterialById($material_id);
    if (!$material || $material['user_id'] != Session::get('user')['user_id']) {
      $this->buildJsonResponse([
        'status' => false,
        'message' => 'Invalid material'
      ], 400);
    }

    $result = $this->model->deleteMaterial($material_id);

    if ($result['status']) {
      $this->buildJsonResponse([
        'status' => true,
        'message' => $result['message']
      ]);
    } else {
      $this->buildJsonResponse([
        'status' => false,
        'message' => $result['message']
      ], 400);
    }
  }
}
