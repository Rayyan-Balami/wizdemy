<?php

class GithubProjectModel extends Model
{

    public function __construct(string $table = 'github_projects')
    {
        parent::__construct($table);
        $this->fillable = ['user_id', 'repo_link'];
    }

    public function show()
    {
        //join user table and github_projects table to get username,user_id,project_id,repo_link
        return $this->select([
            'u.user_id',
            'u.username',
            'u.full_name',
            'p.*'
        ], 'p')
        ->leftJoin('users as u', 'u.user_id = p.user_id')
        ->where('p.status <> :status')
        ->bind(['status' => 'suspend'])
            ->orderBy('p.created_at', 'DESC')
            ->limit(10)
            ->getAll();
    }

    public function isDuplicate($userId, $repoLink)
    {
        return $this->select(['*'])
            ->where('user_id = :user_id AND repo_link = :repo_link')
            ->bind(['user_id' => $userId, 'repo_link' => $repoLink])
            ->get();
    }

    public function store($userId, $repoLink)
    {

        return $this->insert([
            'user_id' => $userId,
            'repo_link' => $repoLink,
        ])->execute();
    }
    public function myProjects($user_id)
    {
        return $this->select([
            'p.*',
            'u.username'
        ], 'p')
            ->leftJoin('users as u', 'u.user_id = p.user_id')
            ->where('p.user_id = :user_id')
            ->bind(['user_id' => $user_id])
            ->getAll();
    }
    public function getProjectsForAdmin()
    {
        return $this->show();
    }
    public function deleteProject($project_id)
    {
        $result = $this->delete()
            ->where('project_id = :project_id')
            ->bind(['project_id' => $project_id])
            ->execute();
        if($result){
            return [
                'status' => true,
                'message' => 'Project deleted successfully'
            ];
        }else{
            return [
                'status' => false,
                'message' => 'Project deletion failed'
            ];
        }
    }
}