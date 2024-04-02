<?php

class ProfileController extends Controller
{
  public function __construct()
  {
    parent::__construct(new UserProfileViewModel());
  }

  public function index($user_id = null)
  {
    if (!$user_id) {
      $this->redirect("/profile/" . Session::get('user')['user_id']);
      return;
    }
    $MaterialViewModel = new MaterialViewModel();
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
      $uploads = $MaterialViewModel->showUploadsByUserId($user_id);
      $this->renderProfileView($myProfile, $user, $uploads, $isPrivate, $isCurrentUserFollower);
      return;
    }

    //if the profile is private and the current user is not a follower
    if ($isPrivate && !$isCurrentUserFollower) {
      $this->renderProfileView($myProfile, $user, null, $isPrivate, $isCurrentUserFollower);
      return;
    }

    $uploads = $MaterialViewModel->showUploadsByUserId($user_id);
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


  public function category()
  {
    $current_user = Session::get('user')['user_id'] ?? null;
    $user_id = $_POST['user_id'] == null ? $current_user : $_POST['user_id'];
    $uploads = (new MaterialViewModel())->showUploadsByUserId($user_id, $_POST['category']);

    $this->buildJsonResponse($uploads);
  }

  public function myRequests()
  {
    $current_user = Session::get('user')['user_id'] ?? null;
    $user_id = $_POST['user_id'] == null ? $current_user : $_POST['user_id'];
    // $myRequests = $this->model->myRequests($user_id, $_POST['category']);
    $myRequests = (new StudyMaterialRequestModel())->myRequests($user_id, $_POST['category']);

    $this->buildJsonResponse($myRequests);
  }

  

  public function myProjects()
  {
    $current_user = Session::get('user')['user_id'] ?? null;
    $user_id = $_POST['user_id'] == null ? $current_user : $_POST['user_id'];
    // $projects = $this->model->myProjects($user_id);
    $projects = (new GithubProjectModel())->myProjects($user_id);
    $this->buildJsonResponse($projects);
  }
}