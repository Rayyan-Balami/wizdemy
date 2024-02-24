<?php
class HomeController extends Controller{

  public function __construct(){
    parent::__construct('StudyMaterailModel');
  }

  //index (notes page)
  public function index(){
    $notes = $this->model->show();
    View::render('notes', ['notes' => $notes]);
  }

  //question page
  public function question(){
    $questions = $this->model->show('question');
    View::render('questions', ['questions' => $questions]);
  }

  //lab report page
  public function labreport(){
    $labreports = $this->model->show('labreport');
    View::render('labreports', ['labreports' => $labreports]);
  }

}