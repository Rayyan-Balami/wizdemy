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
  'currentPage' => 'userManagement'
]);

View::renderPartial('AdminMenuHeader');

?>

<section>
  <?php
  View::renderPartial(
    'AdminUserListTable'
    ,
    [
      'users' => $users
    ]
  );
  ?>
  </pre>
</section>

<?php

View::renderPartial('EndOfHTMLDocument');
