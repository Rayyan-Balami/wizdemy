<?php

class View {
  public static function render($path, $data = []){
    extract($data);
    require_once base_path("app/views/".$path.'.php');
  }

  public static function renderPartial($path, $data = []){
    extract($data);
    require_once base_path("app/views/partials/".$path.'.php');
  }

}