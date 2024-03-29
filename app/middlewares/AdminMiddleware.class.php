<?php

class AdminMiddleware {
  public static function handle() {
    if (!isset($_SESSION['admin'])) {
      Session::flash('info', [
        'message' => SITE_NAME . " admin, with great power comes great responsibility!"
      ]);
      header('Location: /admin/login');
      die();
    }
  }
}