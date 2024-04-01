<?php

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Admin Dashboard',
  'stylesheets' => [
    'statusAndZeroResult',
    'adminStyles',
  ],
  'scripts' => [
    'script',
    'jquery.min',
    'threeDotMenu',
    'sideInfo',
    'searchOverlay',
    'toastTimer',
    'timeAgo',
    'adminTable',
    'updateStatus',
  ]
]);

View::renderPartial('AdminSideNav', [
  'currentPage' => 'userManagement'
]);

View::renderPartial('AdminMenuHeader');

?>

<section>
  <?php
  if (!empty($users)){

    View::renderPartial(
      'AdminUserListTable'
      ,
      [
        'users' => $users
      ]
    );
  } else {
    View::renderPartial('ZeroResult');
  }
  ?>
  </pre>
</section>

<?php

View::renderPartial('EndOfHTMLDocument');
