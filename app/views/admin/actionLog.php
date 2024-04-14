<?php

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | ' . ($currentPage == 'adminLog' ? 'Log' : 'My Log'),
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
  ]
]);

View::renderPartial('../adminPartials/sideNav', [
  'currentPage' => $currentPage
]);

View::renderPartial('../adminPartials/menuHeader');

?>

<section>

  <?php
  if (!empty($logs)){
    View::renderPartial('../adminPartials/actionLogTable',[
      'logs' => $logs,
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
