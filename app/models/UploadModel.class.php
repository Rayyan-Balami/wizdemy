<?php

class UploadModel extends Model
{
  public function __construct(string $table = 'study_materials')
  {
    parent::__construct($table);
    $this->fillable = ['user_id', 'request_id', 'title', 'description', 'document_type', 'format', 'education_level', 'semester', 'subject', 'class_faculty', 'author', 'file_path','thumbnail_path'];
  }

  public function getRequestDetails($request_id){
    //since this is retriving data from study_material_requests table as base updating the current table variable to study_material_requests because currently we are in study_materials table
    
  //   return (new RequestModel())->select([
  //     'study_material_requests.*',
  //     'users.username',
  //     'COUNT(study_materials.request_id) as no_of_materials'
  //   ])
  //     ->leftJoin('users', 'user_id')
  //     ->leftJoin('study_materials', 'request_id')
  //     ->where('study_material_requests.request_id', $request_id)
  //     ->groupBy('study_material_requests.request_id')
  //     ->get();
  return (new RequestModel())->select([
    'r.*',
    'u.username',
    'COUNT(DISTINCT m.material_id) as no_of_materials'
  ], 'r')
    ->leftJoin('users as u', 'u.user_id = r.user_id')
    ->leftJoin('study_materials as m', 'm.request_id = r.request_id')
    ->where('r.request_id = :request_id')
    ->bind(['request_id' => $request_id])
    ->groupBy('r.request_id')
    ->get();
  }

  public function store($user_id, $request_id, $title, $description, $document_type, $format, $education_level, $semester, $subject, $class_faculty, $author, $thumbnail_path, $file_path){
    $upload = $this->insert([
      'user_id' => $user_id,
      'request_id' => $request_id,
      'title' => $title,
      'description' => $description,
      'document_type' => $_POST['document_type'] ?? $document_type,
      'format' => $format,
      'education_level' => $education_level,
      'semester' => $semester,
      'subject' => $subject,
      'class_faculty' => $class_faculty,
      'author' => $author,
      'file_path' => $file_path,
      'thumbnail_path' => $thumbnail_path
    ])->execute();

    if ($upload) {
      return [
        'status' => true,
        'message' => 'Upload successful. Tell your friends about it!'
      ];
    } else {
      return [
        'status' => false,
        'message' => 'Upload failed. Please try again later'
      ];
    }
  }
}