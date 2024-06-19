<?php

function dd( $value ) {
  echo '<pre>';
  var_dump($value);
  echo '</pre>';
  die();
}

function urlIs( $url ) {
  return $_SERVER['REQUEST_URI'] === $url;
}

function urlContains( $url ) {
  return strpos($_SERVER['REQUEST_URI'], $url) !== false;
}

function abort( $status = '404') {
  http_response_code($status);
  require_once base_path('app/views/status.php');
  die();
}

function base_path( $path ) {
  return BASE_PATH . $path;
}


function old( $key , $default = '') {
  return Session::get('old')[$key] ?? $default;
}
