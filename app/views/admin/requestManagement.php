<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Request Management',
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
  'currentPage' => 'requestManagement'
]);

View::renderPartial('../adminPartials/menuHeader');

?>

<section>
<?php
 if (!empty($requests) || !empty($query)) {
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
