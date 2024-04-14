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
    'jquery.min',
    'confirmModal',
    'statusDelete',
    'adminTable', 
  ]
]);

View::renderPartial('../adminPartials/sideNav', [
  'currentPage' => 'adminManagement'
]);

View::renderPartial('../adminPartials/menuHeader');

?>

<section>
<?php
if (!empty($admins)) {
  View::renderPartial('../adminPartials/adminTable', [ 
    "admins" => $admins,
    "page" => $page,
    "totalData" => $totalData,
    "query" => $query
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
