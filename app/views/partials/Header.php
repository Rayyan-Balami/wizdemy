<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?= $pageDescription ?? SITE_DESCRIPTION ?>" />
  <meta name="author" content="<?= SITE_AUTHOR ?>" />
  <meta name="keywords" content="<?= $pageKeywords ?? SITE_KEYWORDS ?>" />
  <meta name="theme-color" content="#ffffff" />
  <link rel="icon" href="/assets/icons/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/icons/apple-icon-180x180.png" />
  <link rel="manifest" href="/assets/manifest.json" />

  <!-- Open Graph / Facebook -->
  <meta property="og:image" content="<?= $ogImage ?? '/assets/images/og-thumbnail.png' ?>" />
  <meta property="og:title" content="<?= $pageTitle ?>" />
  <meta property="og:description" content="<?= $pageDescription ?? SITE_DESCRIPTION ?>" />
  <meta property="og:url" content="<?= SITE_DOMAIN . $_SERVER['REQUEST_URI'] ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="<?= SITE_NAME ?>" />

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="@BalamiRayyan" />
  <meta name="twitter:creator" content="@BalamiRayyan" />
  <meta name="twitter:title" content="<?= $pageTitle ?>" />
  <meta name="twitter:description" content="<?= $pageDescription ?? SITE_DESCRIPTION ?>" />
  <meta name="twitter:url" content="<?= SITE_DOMAIN . $_SERVER['REQUEST_URI'] ?>" />
  <meta name="twitter:image" content="<?= $ogImage ?? '/assets/images/og-thumbnail.png' ?>" />
  <title>
    <?= $pageTitle ?>
  </title>
  <?php
  if (isset($stylesheets)):
    foreach ($stylesheets as $styles):
      echo "<link rel='stylesheet' href='/assets/css/$styles.css' />";
    endforeach;
  endif;

  if (isset($scripts)):
    foreach ($scripts as $script):
      echo "<script src='/assets/js/$script.js' defer ></script>";
    endforeach;
  endif;
  ?>

  <!-- link service worker js file for pwa  -->
  <script defer>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('/assets/js/sw.js')
          .then(registration => {
            console.log('Service Worker registered:', registration);
          })
          .catch(error => {
            console.error('Service Worker registration failed:', error);
          });
      });
    }
  </script>

</head>

<body>