<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Admin Dashboard',
  'stylesheets' => [
    'adminStyles',

    'statusAndZeroResult'
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
  'currentPage' => 'requestManagement'
]);

View::renderPartial('AdminMenuHeader');

?>

<section>
<?php
if (!empty($requests)) {
  View::renderPartial('AdminRequestListTable', [
    'requests' => $requests
  ]);
} else {
  View::renderPartial('ZeroResult');
}
?>
</section>

<?php

View::renderPartial('EndOfHTMLDocument');
