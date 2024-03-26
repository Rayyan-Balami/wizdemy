<?php

class ProjectModel extends Model
{
  public function __construct(string $table = 'github_projects')
  {
    parent::__construct($table);
    $this->fillable = ['user_id', 'repo_link'];
  }

  public function show(){
    //join user table and github_projects table to get username,user_id,project_id,repo_link
    return $this->select([
      'u.user_id',
      'u.username',
      'p.*'
    ], 'p')
    ->leftJoin('users as u', 'u.user_id = p.user_id')
    ->orderBy('p.created_at', 'DESC')
    ->getAll();
  }

  public function isDuplicate($userId, $repoLink){
    return $this->select(['*'])
    ->where('user_id = :user_id AND repo_link = :repo_link')
    ->bind(['user_id' => $userId, 'repo_link' => $repoLink])
    ->get();
  }

  public function store($userId, $repoLink){

    return $this->insert([
      'user_id' => $userId,
      'repo_link' => $repoLink,
    ])->execute();
  }
}