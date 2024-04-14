<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Material Management',
  'stylesheets' => [
    'statusAndZeroResult',
    'adminStyles',
  ],
  'scripts' => [
    'script',
    'jquery.min',
    'toastTimer',
    'confirmModal',
    'adminTable',
    'statusDelete'
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
    'materials' => $materials,
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
