<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Questions',
  'stylesheets' => [
    'styles',
    'statusAndZeroResult'
  ],
  'scripts' => [
    'script',
    'threeDotMenu',
    'sideInfo',
    'searchOverlay',
    'toastTimer',
    'timeAgo',
    'confirmModal',
  ]
]);

View::renderPartial('SideNav', [
  'currentPage' => 'question'
]);

View::renderPartial('MenuHeader');

?>

<section>
<?php
 if (!empty($questions)):
  View::renderPartial('StudyMaterialCard', [
    'materials' => $questions
  ]);
else:
  View::renderPartial('ZeroResult');
endif;
?>
</section>
</main>
<?php
View::renderPartial('ThreeDotMenu');

View::renderPartial('SideInfo');

View::renderPartial('SearchOverlay');

View::renderPartial('ToastNotification');

View::renderPartial('ConfirmModal');

View::renderPartial('EndOfHTMLDocument');
