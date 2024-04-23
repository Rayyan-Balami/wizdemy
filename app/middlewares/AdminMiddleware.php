<?php

class AdminMiddleware
{
  public static function handle()
  {

    if (!isset($_SESSION['admin'])) {
      // Check if '/api' is not in the URL and '/admin' is in the URL
      if (strpos($_SERVER['REQUEST_URI'], '/api') === false) {
        // Store the current URL in the session
        Session::flash('previous_url', $_SERVER['REQUEST_URI']);
      }

      Session::flash('info', [
        'message' => SITE_NAME . " admin, with great power comes great responsibility!"
      ]);
      header('Location: /admin/login');
      die();
    }
  }
}