<?php

class AdminMiddleware {
  public static function handle() {
    if (!isset($_SESSION['admin'])) {
       // Store the current URL in the session
    Session::flash('previous_url', $_SERVER['REQUEST_URI']);
    
      Session::flash('info', [
        'message' => SITE_NAME . " admin, with great power comes great responsibility!"
      ]);
      header('Location: /admin/login');
      die();
    }
  }
}