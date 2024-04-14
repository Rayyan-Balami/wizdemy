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
    'adminTable', 
    'statusDelete',
  ]
]);

View::renderPartial('../adminPartials/sideNav', [
  'currentPage' => 'userManagement'
]);

View::renderPartial('../adminPartials/menuHeader');

?>

<section>
  <?php
  if (!empty($users)){

    View::renderPartial(
      '../adminPartials/userTable'
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

View::renderPartial('ToastNotification');

View::renderPartial('ConfirmModal');

View::renderPartial('EndOfHTMLDocument');
