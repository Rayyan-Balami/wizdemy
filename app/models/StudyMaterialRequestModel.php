<?php

class StudyMaterialRequestModel extends Model
{
    public function __construct(string $table = 'study_material_requests')
    {
        parent::__construct($table);
        $this->fillable = [
            'title',
            'description',
            'user_id',
            'education_level',
            'semester',
            'subject',
            'class_faculty',
            'document_type',
            'status'
        ];
    }

    public function show($category = 'note')
    {

        return $this->select([
            'r.*',
            'u.username',
            'COUNT(DISTINCT m.material_id) as no_of_materials'
        ], 'r')
            ->leftJoin('users as u', 'u.user_id = r.user_id')
            ->leftJoin('study_materials as m', 'm.request_id = r.request_id')
            ->where('r.document_type = :document_type AND r.status <> :status')
            ->bind(['document_type' => $category, 'status' => 'suspend'])
            ->groupBy('r.request_id')
            ->orderBy('r.created_at', 'DESC')
            ->getAll();
    }
    public function showAdmin()
    {
        return $this->select([
            'r.*',
            'u.full_name',
            'u.username',
            'COUNT(DISTINCT m.material_id) as no_of_materials'
        ], 'r')
            ->leftJoin('users as u', 'u.user_id = r.user_id')
            ->leftJoin('study_materials as m', 'm.request_id = r.request_id')
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

    //shows suspended materials too in owner's profile
    public function showRequestsByCurrentUser($document_type = 'note')
    {
        $current_user = Session::get('user')['user_id'] ?? null;
        return $this->select([
            'r.*',
            'u.username',
            'COUNT(DISTINCT m.material_id) as no_of_materials'
        ], 'r')
            ->leftJoin('users as u', 'u.user_id = r.user_id')
            ->leftJoin('study_materials as m', 'm.request_id = r.request_id')
            ->where('r.document_type = :document_type AND r.user_id = :current_user')
            ->bind(['document_type' => $document_type, 'current_user' => $current_user])
            ->groupBy('r.request_id')
            ->orderBy('r.created_at', 'DESC')
            ->getAll();
    }


    public function showRequestsByUserId($user_id, $document_type = 'note')
    {

        return $this->select([
            'r.*',
            'u.username',
            'COUNT(DISTINCT m.material_id) as no_of_materials'
        ], 'r')
            ->leftJoin('users as u', 'u.user_id = r.user_id')
            ->leftJoin('study_materials as m', 'm.request_id = r.request_id')
            ->where('r.document_type = :document_type AND r.user_id = :user_id AND r.status <> :status')
            ->bind(['document_type' => $document_type, 'user_id' => $user_id, 'status' => 'suspend'])
            ->groupBy('r.request_id')
            ->orderBy('r.created_at', 'DESC')
            ->getAll();
    }
    public function getRequestDetailById($request_id)
    {
        return $this->select([
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

    public function updateRequest($request_id, $title, $description, $document_type, $education_level, $semester, $subject, $class_faculty)
    {
        $update = $this->update([
            'title' => $title,
            'description' => $description,
            'document_type' => $document_type,
            'education_level' => $education_level,
            'semester' => $semester,
            'subject' => $subject,
            'class_faculty' => $class_faculty
        ])
            ->where('request_id = :request_id')
            ->appendBindings(['request_id' => $request_id])
            ->execute();

        if ($update) {
            return [
                'status' => true,
                'message' => 'Request updated successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Failed to update request'
            ];
        }
    }

    public function deleteRequest($request_id)
    {
        $delete = $this->delete()
            ->where('request_id = :request_id')
            ->bind(['request_id' => $request_id])
            ->execute();

        if ($delete) {
            return [
                'status' => true,
                'message' => 'Request deleted successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Failed to delete request'
            ];
        }
    }

    public function search($search, $document_type = 'note')
    {
        $current_user = Session::get('user')['user_id'] ?? null;
        return $this->select([
            'DISTINCT r.*',
            'u.username',
            'COUNT(DISTINCT m.material_id) as no_of_materials'
        ], 'r')
            ->leftJoin('users as u', 'u.user_id = r.user_id')
            ->leftJoin('study_materials as m', 'm.request_id = r.request_id')
            ->where('(
                r.title LIKE :search 
            OR r.subject LIKE :search 
            OR r.class_faculty LIKE :search
            OR r.semester LIKE :search
            OR r.education_level LIKE :search
            )
            AND r.document_type = :document_type AND r.status <> :status')
            ->bind([
                'search' => "%$search%",
                'document_type' => $document_type,
                'status' => 'suspend'
            ])
            ->groupBy('r.request_id')
            ->orderBy('r.created_at', 'DESC')
            ->getAll();
    }
    public function searchSuggestions($search)
    {
        return $this->select([
            'DISTINCT r.title as title',
        ], 'r')
            ->where('(
                r.title LIKE :search 
            OR r.subject LIKE :search 
            OR r.class_faculty LIKE :search
            OR r.semester LIKE :search
            OR r.education_level LIKE :search
            )
            AND r.status <> :status')
            ->bind([
                'search' => "%$search%",
                'status' => 'suspend'
            ])
            ->limit(5)
            ->getAll();
    }

    public function getCounts()
    {
        return [
            'total' => $this->count()->get()['total'],
            'active' => $this->count()->where('status = "active"')->get()['total'],
            'suspend' => $this->count()->where('status = "suspend"')->get()['total'],
            'note' => $this->count()->where('document_type = "note"')->get()['total'],
            'question' => $this->count()->where('document_type = "question"')->get()['total'],
            'labreport' => $this->count()->where('document_type = "labreport"')->get()['total'],
        ];
    }

    public function updateStatus($request_id, $status)
    {
        $update = $this->update([
            'status' => $status
        ])
            ->where('request_id = :request_id')
            ->appendBindings(['request_id' => $request_id])
            ->execute();

        if ($update) {
            return [
                'status' => true,
                'message' => 'Request status updated successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Failed to update request status'
            ];
        }
    }
}