<?php

class ReportModel extends Model
{

    public function __construct(string $table = 'reports')
    {
        parent::__construct($table);
        $this->fillable = [
            'user_id',
            'target_id',
            'target_type',
            'title',
            'description',
        ];
    }

    //store(Session::get('user')['user_id'], $targetType, $targetId, $title, $description);

    public function store($userId, $targetType, $targetId, $title, $description)
    {
        $result = $this->insert([
            'user_id' => $userId,
            'target_id' => $targetId,
            'target_type' => $targetType,
            'title' => $title,
            'description' => $description,
        ])->execute();

        if ($result) {
            return [
                'status' => true,
                'message' => 'Report submitted successfully'
            ];
        }else{
            return [
                'status' => false,
                'message' => 'Failed to submit report'
            ];
        }
    }

    //show to admin
    public function showAdmin()
    {
        return $this->select([
            'r.*',
            'u.full_name'
        ], 'r')
            ->leftJoin('users as u', 'u.user_id = r.user_id')
            ->orderBy('r.created_at', 'DESC')
            ->getAll();
    }

}