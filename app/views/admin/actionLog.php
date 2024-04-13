<?php

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Admin Action Logs',
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
  'currentPage' => 'adminLog'
]);

View::renderPartial('../adminPartials/menuHeader');

?>

<section>

  <?php
  if (!empty($logs)){
    View::renderPartial('../adminPartials/actionLogTable',['logs' => $logs]);
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
