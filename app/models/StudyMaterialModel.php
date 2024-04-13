<?php

class StudyMaterialModel extends Model
{

    public function __construct(string $table = 'study_materials')
    {
        parent::__construct($table);
        $this->fillable = [
            'user_id',
            'request_id',
            'title',
            'description',
            'document_type',
            'format',
            'education_level',
            'semester',
            'subject',
            'class_faculty',
            'author',
            'file_path',
            'thumbnail_path'
        ];
    }


    public function store($user_id, $request_id, $title, $description, $document_type, $format, $education_level, $semester, $subject, $class_faculty, $author, $thumbnail_path, $file_path)
    {
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
    public function getMaterialById($material_id)
    {
        $material = $this->select([
            'DISTINCT mv.*'
        ], 'mv')
            ->where('mv.material_id = :material_id')
            ->bind(['material_id' => $material_id])
            ->get();

        if ($material) {
            return $material;
        } else {
            return false;
        }
    }
    public function updateMaterial($material_id, $title, $description, $document_type, $format, $education_level, $semester, $subject, $class_faculty, $author, $thumbnail_path, $file_path)
    {
        $update = $this->update([
            'title' => $title,
            'description' => $description,
            'document_type' => $document_type,
            'format' => $format,
            'education_level' => $education_level,
            'semester' => $semester,
            'subject' => $subject,
            'class_faculty' => $class_faculty,
            'author' => $author,
            'thumbnail_path' => $thumbnail_path,
            'file_path' => $file_path
        ])
            ->where('material_id = :material_id')
            ->appendBindings(['material_id' => $material_id])
            ->execute();


        if ($update) {
            return [
                'status' => true,
                'message' => 'Update successful'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Update failed. Please try again later'
            ];
        }
    }
    function deleteMaterial($material_id)
    {
        $delete = $this->delete()
            ->where('material_id = :material_id')
            ->bind(['material_id' => $material_id])
            ->execute();

        if ($delete) {
            return [
                'status' => true,
                'message' => 'Material deleted successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Material deletion failed. Please try again later'
            ];
        }
    }

    public function getCounts(){
        return [
            'total' => $this->count()->get()['total'],
            'note' => $this->count()->where('document_type = "note"')->get()['total'],
            'question' => $this->count()->where('document_type = "question"')->get()['total'],
            'labreport' => $this->count()->where('document_type = "labreport"')->get()['total'],
            'active' => $this->count()->where('status = "active"')->get()['total'],
            'suspend' => $this->count()->where('status = "suspend"')->get()['total'],
            'responded' => $this->count()->where('request_id IS NOT NULL')->get()['total'],
        ];
    }
}