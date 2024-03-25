<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Notes',
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
    'timeAgo'
  ]
]);

View::renderPartial('SideNav', [
  'currentPage' => 'note'
]);

View::renderPartial('MenuHeader');

?>

<section>
<?php
 if (!empty($notes)):
  View::renderPartial('StudyMaterialCard', [
    'materials' => $notes,
  ]);
else:
  View::renderPartial('ZeroResult');
endif;
?>
</section>

<?php
View::renderPartial('ThreeDotMenu');

View::renderPartial('SideInfo');

View::renderPartial('SearchOverlay');

View::renderPartial('ToastNotification');

View::renderPartial('EndOfHTMLDocument');
