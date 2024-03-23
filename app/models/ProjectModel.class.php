<?php

class ProjectModel extends Model
{
  public function __construct(){
    parent::__construct('github_projects');
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


  public function store($userId, $repoLink){
    return $this->insert([
      'user_id' => $userId,
      'repo_link' => $repoLink
    ])->execute();
  }
}