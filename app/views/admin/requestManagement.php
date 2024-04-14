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
    'confirmModal',
    'statusDelete'
  ]
]);

View::renderPartial('../adminPartials/sideNav', [
  'currentPage' => 'requestManagement'
]);

View::renderPartial('../adminPartials/menuHeader');

?>

<section>
<?php
if (!empty($requests)) {
  View::renderPartial('../adminPartials/requestTable', [
    'requests' => $requests,
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
