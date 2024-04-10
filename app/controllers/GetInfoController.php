<?php

class GetInfoController extends Controller
{

  public function __construct()
  {
    parent::__construct(new MaterialViewModel());
  }

  public function getInfo($targetType, $targetId)
  {


    if (!in_array($targetType, ['material', 'request', 'project'])) {
      $this->buildJsonResponse('Invalid target type', 400);
    }

    $infoDetails = null;

    if ($targetType == 'material') {
      $infoDetails = $this->model->getMaterialDetailById($targetId);
      // dd($infoDetails);
      //sending only necessary data ( username, request_id, description, created_at, updated_at,author_id)
      $infoDetails = [
        'username' => $infoDetails['username'],
        'request_id' => $infoDetails['request_id'],
        'description' => $infoDetails['description'],
        'created_at' => $infoDetails['created_at'],
        'updated_at' => $infoDetails['updated_at'],
        'author' => $infoDetails['author']
      ];
    } else if ($targetType == 'request') {
      $infoDetails = (new StudyMaterialRequestModel())->getRequestDetailById($targetId);
      //sending only necessary data ( username, description, created_at, updated_at)
      $infoDetails = [
        'username' => $infoDetails['username'],
        'description' => $infoDetails['description'],
        'created_at' => $infoDetails['created_at'],
        'updated_at' => $infoDetails['updated_at']
      ];
    } else if ($targetType == 'project') {
      $infoDetails = (new GithubProjectModel())->getProjectDetailById($targetId);
      //sending only necessary data ( username, repo_link,created_at, updated_at)
      $infoDetails = [
        'username' => $infoDetails['username'],
        'repo_link' => $infoDetails['repo_link'],
        'created_at' => $infoDetails['created_at'],
        'updated_at' => $infoDetails['updated_at']
      ];
    }

    if (!$infoDetails) {
      $this->buildJsonResponse('No info found', 404);
    }

    $this->buildJsonResponse([
      'status' => 'success',
      'data' => $infoDetails
  ]);

  }
}