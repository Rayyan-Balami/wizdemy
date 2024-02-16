<?php

class GuestMiddleware{
  public static function handle(){
    if(isset($_SESSION['user'])){
      header('Location: /');
      die();
    }
  }
}