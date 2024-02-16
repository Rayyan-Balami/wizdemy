<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?= $pageTitle ?>
  </title>
  <?php
  if (isset($stylesheets)):
    foreach ($stylesheets as $styles) :
      echo "<link rel='stylesheet' href='/assets/css/$styles.css' />";
    endforeach;
  endif;

  if (isset($scripts)) :
    foreach ($scripts as $script) :
      echo "<script src='/assets/js/$script.js' defer ></script>";
    endforeach;
  endif;
  ?>


</head>

<body>