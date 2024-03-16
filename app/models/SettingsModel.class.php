<?php

class SettingsModel extends Model
{
  public function __construct(){
    parent::__construct('users');
    $this->fillable = ['full_name', 'username', 'password', 'private', 'bio', 'user_type', 'education_level', 'enrolled_course', 'school_name', 'phone_number', 'allow_email', 'allow_phone'];
  }

  public function userDetails($user_id){
    return $this->select([
      'full_name', 'username', 'email', 'bio', 'user_type', 'education_level', 'enrolled_course', 'school_name', 'phone_number'
    ])
    ->where('user_id = :user_id')
    ->bind(['user_id' => $user_id])
    ->get();
  }

  public function updateUserDetails($user_id, $data){
    $result = $this->update($data)
    ->where('user_id = :user_id')
    ->appendBindings(['user_id' => $user_id])
    ->execute();

    if($result){
      if(array_key_exists('username', $data)){
      $_SESSION['user']['username'] = $data['username'];
      }
      return [
        'status' => true,
        'message' => Session::get('user')['username'] .' Profile updated successfully'
      ];
    }else{
      return [
        'status' => false,
        'message' => Session::get('user')['username'].' Profile update failed'
      ];
    }
  }

  public function userPreferences($user_id){
    return $this->select(['private', 'allow_email', 'allow_phone', 'phone_number'])
    ->where('user_id = :user_id')
    ->bind(['user_id' => $user_id])
    ->get();
  }

  public function updatePassword($user_id, $currentPassword, $newPassword){
    $password = $this->select(['password'])
    ->where('user_id = :user_id')
    ->bind(['user_id' => $user_id])
    ->get();

    if(!password_verify($currentPassword, $password['password'])){
      return [
        'status' => false,
        'message' => Session::get('user')['username'].' OOOPS! Current password is incorrect'
      ];
    }

    $result = $this->update(['password' => password_hash($newPassword, PASSWORD_BCRYPT)])
    ->where('user_id = :user_id')
    ->appendBindings(['user_id' => $user_id])
    ->execute();

    if($result){
      return [
        'status' => true,
        'message' => Session::get('user')['username'] .' Password updated successfully'
      ];
    }else{
      return [
        'status' => false,
        'message' => Session::get('user')['username'].' Password update failed'
      ];
    }

  }




  public function updatePreferences($user_id, $data){
    //if aloow phone is set 1, then check if phone number is set in db
    if($data['allow_phone'] == 1){
      $phone = $this->select(['phone_number'])
      ->where('user_id = :user_id')
      ->bind(['user_id' => $user_id])
      ->get();
      if($phone['phone_number'] == null){
        return [
          'status' => false,
          'message' => Session::get('user')['username'].' OOOPS! Phone number is not set'
        ];
      }
    }

    $result = $this->update($data)
    ->where('user_id = :user_id')
    ->appendBindings(['user_id' => $user_id])
    ->execute();

    if($result){
      return [
        'status' => true,
        'message' => Session::get('user')['username'] .' Preferences updated successfully'
      ];
    }else{
      return [
        'status' => false,
        'message' => Session::get('user')['username'].' Preferences update failed'
      ];
    }
  }
}
