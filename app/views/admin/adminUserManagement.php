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
