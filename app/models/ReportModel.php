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
            'status',
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
        } else {
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
            'u.username',
            'u.email',
        ], 'r')
            ->leftJoin('users as u', 'u.user_id = r.user_id')
            ->orderBy('r.created_at', 'DESC')
            ->getAll();
    }

    public function updateStatus($reportId, $status)
    {
        $result = $this->update(['status' => $status])
            ->where('report_id = :report_id')
            ->appendBindings(['report_id' => $reportId])
            ->execute();

        if ($result) {
            return [
                'status' => true,
                'message' => 'Report status updated successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Failed to update report status'
            ];
        }
    }

    public function getCounts()
    {
        return [
            'total' => $this->count()->get()['total'],
            'pending' => $this->count()->where('status = "pending"')->get()['total'],
            'resolved' => $this->count()->where('status = "resolved"')->get()['total'],
        ];
    }
}
