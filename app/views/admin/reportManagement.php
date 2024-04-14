<?php

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Report Management',
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
    'statusDelete'
  ]
]);

View::renderPartial('../adminPartials/sideNav', [
  'currentPage' => 'reportManagement'
]);

View::renderPartial('../adminPartials/menuHeader');

?>

<section>

  <?php
  if (!empty($reports)) {
    View::renderPartial('../adminPartials/reportTable', [
      'reports' => $reports,
      'page' => $page,
      'totalData' => $totalData,
      'query' => $query
    ]);
  } else {
    View::renderPartial('ZeroResult');
  }
  ?>

</section>
</main>
<?php

View::renderPartial('ToastNotification');

View::renderPartial('ConfirmModal');

View::renderPartial('EndOfHTMLDocument');
