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
    'toastTimer',
    'timeAgo',
    'jquery.min',
    'authStatus',
    'category',
    'confirmModal',
    'infiniteScroll',
  ]
]);


View::renderPartial('SideNav', [
  'currentPage' => 'request'
]);

View::renderPartial('MenuHeader');

?>

<section>

  <?php
  View::renderPartial('CardCategory',['page' => 'request']);

  if (!empty($requests)) :
    View::renderPartial('RequestCard', ['requests' => $requests]);
  else :
    View::renderPartial('ZeroResult');
  endif;
  ?>

</section>
</main>

<?php

View::renderPartial('ThreeDotMenu');

View::renderPartial('SideInfo');

View::renderPartial('SearchOverlay');

View::renderPartial('ToastNotification');

View::renderPartial('ConfirmModal');

View::renderPartial('EndOfHTMLDocument');
