<?php

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | ' . ($currentPage == 'userManagement' ? 'User Management' : 'Restore User'),
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
  'currentPage' => ($currentPage == 'userManagement' ? 'userManagement' : $currentPage),
]);

View::renderPartial('../adminPartials/menuHeader');

?>

<section>
  <?php
  if (!empty($users) || !empty($query)) {

    View::renderPartial(
      '../adminPartials/userTable'
      ,
      [
        'users' => $users,
        'page' => $page,
        'totalData' => $totalData,
        'query' => $query,
        'currentPage' => $currentPage
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
