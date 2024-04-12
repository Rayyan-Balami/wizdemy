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

View::renderPartial('AdminSideNav', [
  'currentPage' => 'adminLog'
]);

View::renderPartial('AdminMenuHeader');

?>

<section>
  <?php
  if (!empty($logs)){

    View::renderPartial(
      'AdminLogTable'
      ,
      [
        'logs' => $logs
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
