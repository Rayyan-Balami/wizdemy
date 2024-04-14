<?php


class AuthMiddleware{

  public static function handle(){
    if(!isset($_SESSION['user'])){
      Session::Flash('info', [
        'message' => 'join '.SITE_NAME.", you're missing the fun!"
      ]);
      self::previousUrl();
      die();
    }
  }


  public static function previousUrl(string $url = '/')
  {
      if (isset ($_SERVER['HTTP_REFERER'])) {
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          die();
      } else {
          header('Location: ' . $url);
      }
  }


}