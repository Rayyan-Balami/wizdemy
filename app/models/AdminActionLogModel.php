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
    public function getLogs($query, $page=1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        return $this->select([
            'l.*',
            'a.username as admin_username',
            'a.email as admin_email',
            'a.status as admin_status',
        ],'l')
            ->leftJoin('admins as a', 'a.admin_id = l.admin_id')
            ->where('
                l.target_type LIKE :query OR
                l.action_type LIKE :query OR
                a.username LIKE :query OR
                a.email LIKE :query
            ')
            ->bind(['query' => "%$query%"])
            ->orderBy('l.created_at', 'DESC')
            ->limit($limit)
            ->offset($offset)
            ->getAll()
            ;
    }
    public function getLogsCount($query)
    {
        return $this->select([
            'COUNT(*) as count'
        ],'l')
            ->leftJoin('admins as a', 'a.admin_id = l.admin_id')
            ->where('
                l.target_type LIKE :query OR
                l.action_type LIKE :query OR
                a.username LIKE :query OR
                a.email LIKE :query
            ')
            ->bind(['query' => "%$query%"])
            ->get()['count'];
    }

    /**
     * Get logs by admin id
     * 
     * @param int $admin_id
     * 
     * @return mixed
     */

    public function getLogsByAdminId($admin_id,$query, $page=1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        return $this->select([
            'l.*',
            'a.username as admin_username',
            'a.email as admin_email',
            'a.status as admin_status',
        ],'l')
            ->leftJoin('admins as a', 'a.admin_id = l.admin_id')
            ->where('
                l.admin_id = :admin_id AND
                (l.target_type LIKE :query OR
                l.action_type LIKE :query OR
                a.username LIKE :query OR
                a.email LIKE :query)
            ')
            ->bind(['admin_id' => $admin_id, 'query' => "%$query%"])
            ->orderBy('l.created_at', 'DESC')
            ->limit($limit)
            ->offset($offset)
            ->getAll();
    }
    public function getLogsCountByAdminId($admin_id, $query)
    {
        return $this->select([
            'COUNT(*) as count'
        ],'l')
            ->leftJoin('admins as a', 'a.admin_id = l.admin_id')
            ->where('
                l.admin_id = :admin_id AND
                (l.target_type LIKE :query OR
                l.action_type LIKE :query OR
                a.username LIKE :query OR
                a.email LIKE :query)
            ')
            ->bind(['admin_id' => $admin_id, 'query' => "%$query%"])
            ->get()['count'];
    }
}