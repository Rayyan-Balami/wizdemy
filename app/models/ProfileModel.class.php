<?php

class ProfileModel extends Model
{
  public function __construct($table = 'user_profile_view')
  {
    parent::__construct($table);
    $this->fillable = ['follower_id', 'following_id'];
  }


  public function find($user_id)
  {
    $current_user = null;
    if (Session::exists('user')) {
      $current_user = Session::get('user')['user_id'];
    }

    return $this->select([
      'upv.*',
      'CASE
        WHEN fr.following_id IS NOT NULL THEN 1
        ELSE 0
        END AS is_current_user_follower'
    ], 'upv')
      ->leftJoin('follow_relation as fr', 'upv.user_id = fr.following_id AND fr.follower_id = :follower_id')
      ->where('upv.user_id = :user_id')
      ->bind(['user_id' => $user_id, 'follower_id' => $current_user])
      ->get();
  }

  public function showUploads($user_id, $document_type = 'note')
  {

    return (new StudyMaterailModel())->select([
      'mv.*'
    ], 'mv')
      ->where('mv.user_id = :user_id AND mv.document_type = :document_type')
      ->bind(['user_id' => $user_id, 'document_type' => $document_type])
      ->groupBy('mv.material_id')
      ->getAll();
  }


  public function isFollowing($user_id)
  {
    $current_user = null;
    if (Session::exists('user')) {
      $current_user = Session::get('user')['user_id'];
    }
    return (new ProfileModel('follow_relation'))->select()
      ->where('following_id = :following_id AND follower_id = :follower_id')
      ->bind(['following_id' => $user_id, 'follower_id' => $current_user])
      ->get();
  }

  public function follow($user_id)
  {
    $current_user = null;
    if (Session::exists('user')) {
      $current_user = Session::get('user')['user_id'];
    }

    //check if the user is already following
    $isFollowing = (new ProfileModel('follow_relation'))->select()
      ->where('following_id = :following_id AND follower_id = :follower_id')
      ->bind(['following_id' => $user_id, 'follower_id' => $current_user])
      ->get();

    if ($isFollowing) {
      return [
        'status' => false,
        'message' => 'You are already following this user'
      ];
    }

    $result = (new ProfileModel('follow_relation'))->insert([
      'following_id' => $user_id,
      'follower_id' => $current_user
    ])->execute();

    if ($result) {
      return [
        'status' => true,
        'message' => 'You are now following this user'
      ];
    }else{
      return [
        'success' => false,
        'message' => 'Something went wrong'
      ];
    }
}

public function unfollow($user_id)
{

  $current_user = null;
  if (Session::exists('user')) {
    $current_user = Session::get('user')['user_id'];
  }

  //check if the user is already unfollowing
  $isFollowing = (new self('follow_relation'))->select()
    ->where('following_id = :following_id AND follower_id = :follower_id')
    ->bind(['following_id' => $user_id, 'follower_id' => $current_user])
    ->get();

  if (!$isFollowing) {
    return [
      'status' => false,
      'message' => 'You are not following this user'
    ];
  }


  $result = (new self('follow_relation'))->delete()
    ->where('following_id = :following_id AND follower_id = :follower_id')
    ->bind(['following_id' => $user_id, 'follower_id' => $current_user])
    ->execute();

  if ($result) {
    return [
      'status' => true,
      'message' => 'You have unfollowed this user'
    ];
  }else{
    return [
      'success' => false,
      'message' => 'Something went wrong'
    ];
  }
}
}