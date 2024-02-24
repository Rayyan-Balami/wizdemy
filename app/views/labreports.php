<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Lab Reports',
  'stylesheets' => [
    'styles',
    'statusAndZeroResult'
  ],
  'scripts' => [
    'script',
    'threeDotMenu',
    'sideInfo',
    'searchOverlay',
    'notificationOverlay',
    'toastTimer',
    'timeAgo',
  ]
]);

View::renderPartial('SideNav', [
  'currentPage' => 'labreport'
]);

View::renderPartial('MenuHeader');

?>

<section>
<?php
 if (!empty($labreports)):
  View::renderPartial('StudyMaterialCard', [
    'materials' => $labreports
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

View::renderPartial('NotificationOverlay');

View::renderPartial('ToastNotification');

View::renderPartial('EndOfHTMLDocument');
