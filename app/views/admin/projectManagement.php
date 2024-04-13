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
    'adminTable',
  ]
]);

View::renderPartial('../adminPartials/sideNav', [
  'currentPage' => 'projectManagement'
]);

View::renderPartial('../adminPartials/menuHeader');

?>

<section>
<?php
if (!empty($projects)) {
  View::renderPartial('../adminPartials/projectTable', [
    'projects' => $projects
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
