<?php

class ProfileController extends Controller
{
  public function __construct()
  {
    parent::__construct(new UserModel());
  }

  public function index($user_id = null)
  {
    if (!$user_id) {
      $this->redirect("/profile/" . Session::get('user')['user_id']);
      return;
    }
    $StudyMaterialModel = new StudyMaterialModel();
    $FollowRelationModel = new FollowRelationModel();

    $current_user = Session::get('user')['user_id'] ?? null;
    $myProfile = $user_id == $current_user;

    $user = $this->model->profileData($user_id);
    if (!$user) {
      $this->renderProfileView($myProfile, null);
      return;
    }

    $isPrivate = $user['private'];

    $isCurrentUserFollower = !$myProfile ? $FollowRelationModel->isFollowing($current_user, $user_id) : false;

    //if its own pofile
    if ($myProfile) {
      // $uploads = $this->model->showUploads($user_id);
      $uploads = $StudyMaterialModel->showUploadsByCurrentUser();
      $this->renderProfileView($myProfile, $user, $uploads, $isPrivate, $isCurrentUserFollower);
      return;
    }

    //if the profile is private and the current user is not a follower
    if ($isPrivate && !$isCurrentUserFollower) {
      $this->renderProfileView($myProfile, $user, null, $isPrivate, $isCurrentUserFollower);
      return;
    }

    $uploads = $StudyMaterialModel->showUploadsByUserId($user_id);
    $this->renderProfileView($myProfile, $user, $uploads, $isPrivate, $isCurrentUserFollower);
  }

  private function renderProfileView($myProfile, $user, $uploads = null, $isPrivate = false, $isCurrentUserFollower = false)
  {
    View::render('profile', [
      'myProfile' => $myProfile,
      'isPrivate' => $isPrivate,
      'isCurrentUserFollower' => $isCurrentUserFollower,
      'user' => $user,
      'uploads' => $uploads
    ]);
  }


  public function myMaterials()
  {
    $current_user = Session::get('user')['user_id'] ?? null;
    $user_id = $_POST['user_id'] ?? $current_user;
    $category = $_POST['category'];

    $StudyMaterialModel = new StudyMaterialModel();

    if ($user_id == $current_user) {
      $uploads = $StudyMaterialModel->showUploadsByCurrentUser($category);
    } else {
      $uploads = $StudyMaterialModel->showUploadsByUserId($user_id, $category);
    }

    $this->buildJsonResponse($uploads);
  }

  public function myRequests()
  {
    $current_user = Session::get('user')['user_id'] ?? null;
    $user_id = $_POST['user_id'] ?? $current_user;
    $category = $_POST['category'];

    $requestModel = new StudyMaterialRequestModel();

    if ($user_id == $current_user) {
      $requests = $requestModel->showRequestsByCurrentUser($category);
    } else {
      $requests = $requestModel->showRequestsByUserId($user_id, $category);
    }

    $this->buildJsonResponse($requests);
  }

  

  public function myProjects()
  {
    $current_user = Session::get('user')['user_id'] ?? null;
    $user_id = $_POST['user_id'] ?? $current_user;

    $projectModel = new GithubProjectModel();
    
    if($user_id == $current_user){
      $projects = $projectModel->showProjectsByCurrentUser();
    }else{
      $projects = $projectModel->showProjectsByUserId($user_id);
    }

    $this->buildJsonResponse($projects);
  }
}