<?php

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Search Results',
  'stylesheets' => [
    'profile',
    'statusAndZeroResult'
  ],
  'scripts' => [
    'script',
    'threeDotMenu',
    'sideInfo',
    'searchOverlay',
    'toastTimer',
    'timeAgo',
    'jquery.min',
    'authStatus',
    'category',
    'confirmModal',
  ]
]);

View::renderPartial('SideNav');

View::renderPartial('MenuHeader');
?>

      <section>
        <?php
        View::renderPartial('CardCategory', ['page' => 'search']);
        if (!empty($materials)):
          View::renderPartial('StudyMaterialCard', ['materials' => $materials]);
        else:
          View::renderPartial('ZeroResult', ['page' => 'search']);
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
