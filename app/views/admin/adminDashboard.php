<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Admin Dashboard',
  'stylesheets' => [
    'adminStyles',
  ],
  'scripts' => [
    'script',
    'threeDotMenu',
    'sideInfo',
    'searchOverlay',
    'toastTimer',
    'timeAgo'
  ]
]);

View::renderPartial('AdminSideNav', [
  'currentPage' => 'overview'
]);

View::renderPartial('AdminMenuHeader');

?>

<section>
<?php
  View::renderPartial('AdminTable');
?>
</section>

<?php

View::renderPartial('EndOfHTMLDocument');
