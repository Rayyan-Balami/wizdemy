<?php 

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Projects',
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
  'currentPage' => 'project'
]);

View::renderPartial('MenuHeader');

?>

<section>
<?php
 if (!empty($projects)):
  View::renderPartial('ProjectCard', [
    'projects' => $projects
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
