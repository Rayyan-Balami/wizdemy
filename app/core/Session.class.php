<?php

class Session
{
    public static function start()
    {
        // session_start([
        //     'cookie_lifetime' => 3600,
        //     'cookie_httponly' => true,
        //     'cookie_secure' => true,
        //     'cookie_samesite' => 'Strict'
        // ]);
        session_start();
    }

    public static function destroy()
    {
        session_destroy();
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }


    public static function get($key)
  {
    if (isset($_SESSION['_flash'][$key])) {
      $value = $_SESSION['_flash'][$key];
      unset($_SESSION['_flash'][$key]);
      return $value;
    } else {
      return $_SESSION[$key] ?? null;
    }
  }

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public static function exists($key)
    {
      if(isset($_SESSION['_flash'][$key])) {
        return true;
      }
        return isset($_SESSION[$key]);
    }

    public static function flash($key, $value)
  {
    $_SESSION['_flash'][$key] = $value;
  }



}
