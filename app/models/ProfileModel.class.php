<?php

class ProfileModel extends Model
{
  public function __construct($table = 'user_profile_view')
  {
    parent::__construct($table);
    $this->fillable = ['follower_id', 'following_id'];
  }


  public function profileData($user_id)
  {
    return $this->select([
      'upv.*'
    ], 'upv')
      ->where('upv.user_id = :user_id')
      ->bind(['user_id' => $user_id])
      ->get();
  }

  public function showUploads($user_id, $document_type = 'note')
  {
    return (new StudyMaterialModel())->select([
      'mv.*'
    ], 'mv')
      ->where('mv.user_id = :user_id AND mv.document_type = :document_type')
      ->bind(['user_id' => $user_id, 'document_type' => $document_type])
      ->groupBy('mv.material_id')
      ->getAll();
  }


  public function isFollowing($current_user, $user_id)
  {
    return (new ProfileModel('follow_relation'))->select()
      ->where('following_id = :following_id AND follower_id = :follower_id')
      ->bind(['following_id' => $user_id, 'follower_id' => $current_user])
      ->get();
  }

  public function follow($current_user,$user_id)
  {
    //check if the user is already following
    $isFollowing = $this->isFollowing($current_user, $user_id);

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

public function unfollow($current_user, $user_id)
{
  //check if the user is already non-following
  $isFollowing = $this->isFollowing($current_user, $user_id);

  if (!$isFollowing) {
    return [
      'status' => false,
      'message' => 'You are not following this user'
    ];
  }

  $result = (new ProfileModel('follow_relation'))->delete()
    ->where('following_id = :following_id AND follower_id = :follower_id')
    ->bind(['following_id' => $user_id, 'follower_id' => $current_user])
    ->execute();

  if ($result) {
    return [
      'status' => true,
      'message' => 'You are no longer following this user'
    ];
  }else{
    return [
      'success' => false,
      'message' => 'Something went wrong'
    ];
  }
}
}
