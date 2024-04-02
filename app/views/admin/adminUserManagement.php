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
    'toastTimer',
    'adminTable',
    'confirmModal',
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

</main>

<?php

View::renderPartial('ConfirmModal');

View::renderPartial('EndOfHTMLDocument');
