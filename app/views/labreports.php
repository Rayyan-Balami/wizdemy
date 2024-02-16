<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Lab Reports',
  'stylesheets' => [
    'styles'
  ],
  'scripts' => [
    'script',
    'threeDotMenu',
    'sideInfo',
    'searchOverlay',
    'notificationOverlay',
    'toastTimer'
  ]
]);

View::renderPartial('SideNav', [
  'currentPage' => 'labreport'
]);

View::renderPartial('MenuHeader');

View::renderPartial('StudyMaterialCard');

View::renderPartial('Footer');

View::renderPartial('ThreeDotMenu');

View::renderPartial('SideInfo');

View::renderPartial('SearchOverlay');

View::renderPartial('NotificationOverlay');

View::renderPartial('ToastNotification');

View::renderPartial('EndOfHTMLDocument');
