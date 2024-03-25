<?php

/**
 * View class
 * 
 * This class contains methods for rendering views and partial views.
 * 
 * methods: render, renderPartial
 */
class View {

  /**
   * Render a view
   * 
   * @param string $path The path to the view file
   * @param array $data The data to pass to the view
   * 
   * @return void
   */
  public static function render(string $path, array $data = [])
  {
    extract($data);
    require_once base_path("app/views/".$path.'.php');
  }

  /**
   * Render a partial view
   * 
   * @param string $path The path to the partial view file
   * @param array $data The data to pass to the partial view
   * 
   * @return void
   */

  public static function renderPartial(string $path, array $data = [])
  {
    extract($data);
    require_once base_path("app/views/partials/".$path.'.php');
  }

}