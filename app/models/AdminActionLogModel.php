<?php

class AdminActionLogModel extends Model
{
    public function __construct(string $table = 'admin_action_log')
    {
        parent::__construct($table);
        // action_id 	target_id 	target_type 	admin_id 	action_type 	created_at 	updated_at 	
        $this->fillable = ['admin_id', 'target_id', 'target_type', 'action_type'];
    }
    /**
     * Log admin action
     * 
     * @param int $admin_id
     * @param int $target_id
     * @param string $target_type
     * @param string $action_type
     * 
     * @return mixed
     */
    public function log($admin_id, $target_id, $target_type, $action_type)
    {
        return $this->insert([
            'admin_id' => $admin_id,
            'target_id' => $target_id,
            'target_type' => $target_type,
            'action_type' => $action_type
        ])->execute();
    }
    /**
     * Get all logs
     * 
     * @return mixed
     */
    public function getLogs()
    {
        return $this->select([
            'l.*',
            'a.username as admin_username',
            'a.email as admin_email',
            'a.status as admin_status',
            'u.username as target_username',
            'u.email as target_email',
            'u.status as target_status',
        ], 'l')
            ->leftJoin('admins as a', 'a.admin_id = l.admin_id')
            ->leftJoin('users as u', 'u.user_id = l.target_id')
            ->orderBy('l.created_at', 'DESC')
            ->getAll();
    }
}