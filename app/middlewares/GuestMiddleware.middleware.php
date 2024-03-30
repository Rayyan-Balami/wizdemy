<?php

class GuestMiddleware{
  public static function handle(){
    if(isset($_SESSION['user'])){
      header('Location: /');
      die();
    }
    if(isset($_SESSION['admin'])){
      header('Location: /admin/dashboard');
      die();
    }
  }
}