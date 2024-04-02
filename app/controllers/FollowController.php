<?php

class FollowController extends Controller
{
    public function __construct()
    {
        parent::__construct(new FollowRelationModel());
    }


    public function follow($user_id)
    {
  
      $current_user = Session::get('user')['user_id'] ?? null;
  
      $follow = $this->model->follow($current_user, $user_id);
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
      $this->redirect('/profile/' . $user_id);
    }
  
    public function unfollow($user_id)
    {
      $current_user = Session::get('user')['user_id'] ?? null;
  
      $unfollow = $this->model->unfollow($current_user, $user_id);
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
      $this->redirect('/profile/' . $user_id);
    }
}