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
<<<<<<< HEAD
    'adminTable',
    'confirmModal',
=======
    'timeAgo',
    'adminTable', 
>>>>>>> 8c8a61b (Fix formatting and add new testPut method)
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
  // dd hello world
  dd

  ?> 
  </pre>
</section>

</main>

<?php

View::renderPartial('ConfirmModal');

View::renderPartial('EndOfHTMLDocument');
