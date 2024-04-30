<?php

/**
 * Session class
 * 
 * This class contains methods for starting, destroying, setting, getting, removing, and checking if a session exists.
 * 
 * methods: start, destroy, set, get, remove, exists
 */
class Session
{
  /**
   * Start a new session
   * 
   * @return void
   */
  public static function start()
  {
    session_start([
        'cookie_lifetime' => 3600,
        'cookie_httponly' => true,
        'cookie_secure' => true,
        'cookie_samesite' => 'Strict'
    ]);
    // session_start();
  }

  /**
   * Destroy the current session
   * 
   * @return void
   */
  public static function destroy()
  {
    session_destroy();
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
  }

  /**
   * Set a session variable
   * 
   * @param string $key The key to set
   * @param mixed $value The value to set
   * 
   * @return void
   */
  public static function set(string $key, $value)
  {
    $_SESSION[$key] = $value;
  }


  /**
   * Get a session variable
   * 
   * @param string $key The key to get
   * 
   * @return mixed The value of the session variable
   */
  public static function get(string $key)
  {
    if (isset ($_SESSION['_flash'][$key])) {
      $value = $_SESSION['_flash'][$key];
      unset($_SESSION['_flash'][$key]);
      return $value;
    } else {
      return $_SESSION[$key] ?? null;
    }
  }

  /**
   * Remove a session variable
   * 
   * @param string $key The key to remove
   * 
   * @return void
   */

  public static function remove(string $key)
  {
    if (isset ($_SESSION['_flash'][$key])) {
      unset($_SESSION['_flash'][$key]);
    } else {
      unset($_SESSION[$key]);
    }
  }

  /**
   * Check if a session variable exists
   * 
   * @param string $key The key to check
   * 
   * @return bool True if the session variable exists, false otherwise
   */
  public static function exists(string $key)
  {
    if (isset ($_SESSION['_flash'][$key])) {
      return true;
    }
    return isset ($_SESSION[$key]);
  }

  /**
   * Flash a session variable
   * 
   * @param string $key The key to flash
   * @param mixed $value The value to flash
   * 
   * @return void
   */
  public static function flash(string $key, $value)
  {
    $_SESSION['_flash'][$key] = $value;
  }



}
