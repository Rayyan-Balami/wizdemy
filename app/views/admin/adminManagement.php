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
    'jquery.min',
    'confirmModal',
    'adminAdmin',
  ]
]);

View::renderPartial('AdminSideNav', [
  'currentPage' => 'adminManagement'
]);

View::renderPartial('AdminMenuHeader');

?>

<section>
<?php
if (!empty($admins)) {
  View::renderPartial('AdminListTable', [
    "admins" => $admins,
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
