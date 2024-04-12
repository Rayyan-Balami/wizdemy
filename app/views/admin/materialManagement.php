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

View::renderPartial('AdminSideNav', [
  'currentPage' => 'materialManagement'
]);

View::renderPartial('AdminMenuHeader');

?>

<section>
<?php
if (!empty($materials)) {
  View::renderPartial('AdminMaterialListTable', [
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
