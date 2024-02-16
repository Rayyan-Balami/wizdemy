<?php
class HomeController extends Controller{

  public function __construct(){
    parent::__construct('StudyMaterailModel');
  }

  //index (notes page)
  public function index(){
    View::render('notes');
  }

  //question page
  public function question(){
    View::render('questions');
  }

  //lab report page
  public function labreport(){
    View::render('labreports');
  }

  //create (add notes/ question/ lab report)
  public function create(){
    $this->redirect('upload.php');
  }
}