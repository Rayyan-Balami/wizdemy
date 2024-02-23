<?php

class StudyMaterailModel extends Model
{

  public function __construct()
  {
    parent::__construct('study_materials');

    $this->fillable = ['title', 'description', 'file_path', 'user_id', 'respond_to', 'document_type', 'format', 'education_level', 'semester', 'subject', 'author', 'thumbnail_path', 'class_faculty'];
  }


  public function show($document_type = 'note')
  {
}
}