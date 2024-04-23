<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | ' . ($currentPage == 'adminManagement' ? 'Admin Management' : 'Restore Admin'),
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
  'currentPage' => ($currentPage == 'adminManagement' ? 'adminManagement' : $currentPage),
]);

View::renderPartial('../adminPartials/menuHeader');

?>

<section>
<?php
 if (!empty($admins) || !empty($query)) {
  View::renderPartial('../adminPartials/adminTable', [ 
    "admins" => $admins,
    "page" => $page,
    "totalData" => $totalData,
    "query" => $query,
    'currentPage' => $currentPage
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
