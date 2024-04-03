<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Admin Dashboard',
  'stylesheets' => [
    'statusAndZeroResult',
    'adminStyles',
  ],
  'scripts' => [
    'script',
    'toastTimer'
  ]
]);

View::renderPartial('AdminSideNav', [
  'currentPage' => 'projectManagement'
]);

View::renderPartial('AdminMenuHeader');

?>

<section>
<?php
if (!empty($projects)) {
  View::renderPartial('AdminProjectListTable', [
    'projects' => $projects
  ]);
} else {
  View::renderPartial('ZeroResult');
}

?>
</section>


<?php

View::renderPartial('ToastNotification');

View::renderPartial('ConfirmModal');

View::renderPartial('EndOfHTMLDocument');
