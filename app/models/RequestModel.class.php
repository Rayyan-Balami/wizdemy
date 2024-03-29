<?php

class RequestModel extends Model
{
  public function __construct(string $table = 'study_material_requests')
  {
    parent::__construct($table);
    $this->fillable = ['title', 'description', 'user_id', 'education_level', 'semester', 'subject', 'class_faculty', 'document_type'];
  }

  public function show()
  {

    // If 'category' parameter is not set or invalid, default to 'notes'
    $category = $_POST['category'] ?? 'note';


    return $this->select([
      'r.*',
      'u.username',
      'COUNT(DISTINCT m.material_id) as no_of_materials'
    ], 'r')
      ->leftJoin('users as u', 'u.user_id = r.user_id')
      ->leftJoin('study_materials as m', 'm.request_id = r.request_id')
      ->where('r.document_type = :document_type')
      ->bind(['document_type' => $category])
      ->groupBy('r.request_id')
      ->orderBy('r.created_at', 'DESC')
      ->getAll();
  }

  public function create($user_id, $title, $description, $document_type, $education_level, $semester, $subject, $class_faculty)
  {
    $request = $this->insert([
      'user_id' => $user_id,
      'title' => $title,
      'description' => $description,
      'document_type' => $document_type,
      'education_level' => $education_level,
      'semester' => $semester,
      'subject' => $subject,
      'class_faculty' => $class_faculty
    ])->execute();

    if ($request) {
      return [
        'status' => true,
        'message' => 'Request created successfully'
      ];
    } else {
      return [
        'status' => false,
        'message' => 'Failed to create request'
      ];
    }
  }
}