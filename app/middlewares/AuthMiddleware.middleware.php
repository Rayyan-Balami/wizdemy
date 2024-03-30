<?php


class AuthMiddleware{
  public static function handle(){
    if(!isset($_SESSION['user'])){
      Session::Flash('info', [
        'message' => 'join '.SITE_NAME.", you're missing the fun!"
      ]);
      header('Location: /login');
      die();
    }
  }
}