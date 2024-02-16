<?php

class RequestModel extends Model
{
  public function __construct()
  {
    parent::__construct('study_material_requests');
    $this->fillable = ['title', 'description', 'user_id', 'education_level', 'semester', 'subject', 'class_faculty', 'document_type'];
  }

  public function show()
  {
    $allowedParams = [
      'type' => ['note', 'labreport', 'question']
    ];

    // Validate and filter the $_GET array to retain only allowed keys and values
  $validatedParams = array_intersect_key($_POST ?? [], $allowedParams);

    // If 'type' parameter is not set or invalid, default to 'notes'
    $type = $validatedParams['type'] ?? 'note';


    return $this->select([
      'study_material_requests.*',
      'users.username',
      'COUNT(study_materials.request_id) as no_of_materials'
    ])
      ->leftJoin('users', 'user_id')
      ->leftJoin('study_materials', 'request_id')
      ->where('study_material_requests.document_type', $type)
      ->groupBy('study_material_requests.request_id')
      ->orderBy('study_material_requests.created_at', 'DESC')
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