<?php

class AuthMiddleware{

public static function handle(){
  if(!isset($_SESSION['user'])){
    // Check if '/api' is not in the URL
    if (strpos($_SERVER['REQUEST_URI'], '/api') === false) {
      // Store the current URL in the session
      Session::flash('previous_url', $_SERVER['REQUEST_URI']);
    }
    
    // Flash message and redirect to the login page
    Session::Flash('info', [
      'message' => 'join '.SITE_NAME.", you're missing the fun!"
    ]);
    header('Location: /login');
    die();
  }
}
}
