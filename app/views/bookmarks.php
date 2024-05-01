<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Bookmarks',
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
  'currentPage' => 'bookmark'
]);

View::renderPartial('MenuHeader');

?>

<section>
<?php
 if (!empty($bookmarks)):
  View::renderPartial('StudyMaterialCard', [
    'materials' => $bookmarks,
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
