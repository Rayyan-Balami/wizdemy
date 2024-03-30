<?php

class ProfileController extends Controller
{
  public function __construct()
  {
    parent::__construct('ProfileModel');
  }

  public function index()
  {
      $user_id = isset($_GET['id']) ? $_GET['id'] : (Session::get('user')['user_id'] ?? null);

      if (!$user_id) {
          $this->redirect('/profile');
          return;
      }
  
      $current_user = Session::get('user')['user_id'] ?? null;
      $myProfile = $user_id == $current_user;
      
      $user = $this->model->profileData($user_id);
      if (!$user) {
        $this->renderProfileView($myProfile, null);
        return;
      }

      $isPrivate = $user['private'];

      $isCurrentUserFollower = !$myProfile ? $this->model->isFollowing($current_user, $user_id) : false;

      //if its own pofile
      if ($myProfile) {
          $uploads = $this->model->showUploads($user_id);
          $this->renderProfileView($myProfile, $user, $uploads, $isPrivate, $isCurrentUserFollower);
          return;
      }
  
      //if the profile is private and the current user is not a follower
      if ($isPrivate && !$isCurrentUserFollower) {
          $this->renderProfileView($myProfile, $user, null, $isPrivate, $isCurrentUserFollower);
          return;
      }
  
      $uploads = $this->model->showUploads($user_id);
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
      $uploads = $this->model->showUploads($user_id, $_POST['category']);
      
      $this->buildJsonResponse($uploads);
  }  

  public function myRequests()
  {
      $current_user = Session::get('user')['user_id'] ?? null;
      $user_id = $_POST['user_id'] == null ? $current_user : $_POST['user_id'];
      $myRequests = $this->model->myRequests($user_id, $_POST['category']);

      $this->buildJsonResponse($myRequests);
  }

  public function follow()
  {

    $current_user = Session::get('user')['user_id'] ?? null;

    $follow = $this->model->follow($current_user, $_POST['user_id']);
    if($follow['status']){
      Session::flash('success', [
        'message' => $follow['message']
      ]);
    }else{
      Session::flash('error', [
        'message' => $follow['message']
      ]);
    }
    //redirect to the user's profile
    $this->redirect('/profile?id=' . $_POST['user_id']);
  }

  public function unfollow()
  {
    $current_user = Session::get('user')['user_id'] ?? null;

    $unfollow = $this->model->unfollow($current_user, $_POST['user_id']);
    if($unfollow['status']){
      Session::flash('success', [
        'message' => $unfollow['message']
      ]);
    }else{
      Session::flash('error', [
        'message' => $unfollow['message']
      ]);
    }
    //redirect to the user's profile
    $this->redirect('/profile?id=' . $_POST['user_id']);
  }

  public function myProjects()
  {
      $current_user = Session::get('user')['user_id'] ?? null;
      $user_id = $_POST['user_id'] == null ? $current_user : $_POST['user_id'];
      $projects = $this->model->myProjects($user_id);
  
      $this->buildJsonResponse($projects);
  }  
}