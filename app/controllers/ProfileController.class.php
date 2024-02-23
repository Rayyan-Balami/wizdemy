<?php

class ProfileController extends Controller
{
  public function __construct()
  {
    parent::__construct('ProfileModel');
  }

  public function index()
  {
    $myProfile = true;

    $user = $this->model->find(Session::get('user')
    ['user_id']);

    $isPrivate = $user['is_private'];
    $isCurrentUserFollower = $user['is_current_user_follower'];

    //load the user's posts
    $uploads = $this->model->showUploads(Session::get('user')
    ['user_id']);

    View::render('profile', [
      'myProfile' => $myProfile,
      'isPrivate' => $isPrivate,
      'isCurrentUserFollower' => $isCurrentUserFollower,
      'user' => $user,
      'uploads' => $uploads
    ]);
  }

  public function show()
  {
      if (!isset($_GET['user_id']) || empty($_GET['user_id']) || $_GET['user_id'] < 1) {
          $this->redirect('/profile');
          return;
      }
  
      if ($_GET['user_id'] == Session::get('user')['user_id']) {
          $this->redirect('/profile');
          return;
      }
  
      $user = $this->model->find($_GET['user_id']);
  
      // If user does not exist, render the profile view with null user
      if (!$user) {
          View::render('profile', [
              'user' => null
          ]);
          return; // Early return
      }
  
      $myProfile = false;
      $isPrivate = $user['is_private'];
      $isCurrentUserFollower = $user['is_current_user_follower'];

      // If the user is private and the current user is not a follower [dont show the posts]
      if ($isPrivate && !$isCurrentUserFollower) {
          View::render('profile', [
              'myProfile' => $myProfile,
              'isPrivate' => $isPrivate,
              'isCurrentUserFollower' => $isCurrentUserFollower,
              'user' => $user
          ]);
          return; // Early return
      }
  
      //load the user's posts
      $uploads = $this->model->showUploads($_GET['user_id']);
      // Render the profile view based on conditions
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
    $requests = $this->model->show();
    // if(!empty($requests)){
    $this->buildJsonResponse($requests);
  }
}