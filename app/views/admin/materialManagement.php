<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Material Management',
  'stylesheets' => [
    'statusAndZeroResult',
    'adminStyles',
  ],
  'scripts' => [
    'script',
    'toastTimer',
    'confirmModal',
    'adminTable',
  ]
]);

View::renderPartial('../adminPartials/sideNav', [
  'currentPage' => 'materialManagement'
]);

View::renderPartial('../adminPartials/menuHeader');

?>

<section>
<?php
if (!empty($materials)) {
  View::renderPartial('../adminPartials/materialTable', [
    'materials' => $materials
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
