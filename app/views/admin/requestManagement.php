<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Admin Dashboard',
  'stylesheets' => [
    'statusAndZeroResult',
    'adminStyles',
  ],
  'scripts' => [
    'script',
    'toastTimer',
    'confirmModal',
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
    'requests' => $requests
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
