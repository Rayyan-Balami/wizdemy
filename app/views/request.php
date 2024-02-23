<?php
View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Requests',
  'stylesheets' => [
    'request',
    'statusAndZeroResult'
  ],
  'scripts' => [
    'script',
    'threeDotMenu',
    'sideInfo',
    'searchOverlay',
    'notificationOverlay',
    'toastTimer',
    'timeAgo',
    'jquery.min',
    'request'
  ]
]);


View::renderPartial('SideNav', [
  'currentPage' => 'request'
]);

View::renderPartial('MenuHeader');

?>

<section >

  <?php
  View::renderPartial('CardCategory');

  if (!empty($requests)):

  View::renderPartial('RequestCard', [
    'requests' => $requests
  ]);

else:

  View::renderPartial('ZeroResult');

endif;

?>

</section>

<?php

View::renderPartial('ThreeDotMenu');

View::renderPartial('SideInfo');

View::renderPartial('SearchOverlay');

View::renderPartial('NotificationOverlay');

View::renderPartial('ToastNotification');

View::renderPartial('EndOfHTMLDocument');
