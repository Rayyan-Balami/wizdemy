<?php

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ($myProfile ? ' | MyProfile' : ' | Profile'),
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

View::renderPartial('SideNav', [
  'currentPage' => ($myProfile ? 'profile' : '')
]);

View::renderPartial('MenuHeader');
?>

<?php
//if user does not exist
if (!$user):
  View::renderPartial('ZeroResult', [
    'page' => 'ghostProfile'
  ]);
else:
  ?>

  <div class="card-profile-wrapper">


    <?php

    if (!$myProfile && ($isPrivate && !$isCurrentUserFollower)): ?>
      <!-- show private header if private account -->
      <div class="title-label">
        <div>
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
              <path opacity="0.4"
                d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z"
                fill="currentColor"></path>
              <path
                d="M12 18C13.1046 18 14 17.1046 14 16C14 14.8954 13.1046 14 12 14C10.8954 14 10 14.8954 10 16C10 17.1046 10.8954 18 12 18Z"
                fill="currentColor"></path>
              <path
                d="M6.75 8C6.75 5.10051 9.10051 2.75 12 2.75C14.8995 2.75 17.25 5.10051 17.25 8V10.0036C17.8174 10.0089 18.3135 10.022 18.75 10.0546V8C18.75 4.27208 15.7279 1.25 12 1.25C8.27208 1.25 5.25 4.27208 5.25 8V10.0546C5.68651 10.022 6.18264 10.0089 6.75 10.0036V8Z"
                fill="currentColor"></path>
            </g>
          </svg>
        </div>
        <h2 class="title">
          Private Account
        </h2>

        <p class="message">
          Follow the user to view their uploads
        </p>
      </div>
      <!-- private header end  -->
    <?php else: ?>

      <section>
        <?php
        View::renderPartial('CardCategory', ['page' => 'profile']);
        if (!empty($uploads)):
          View::renderPartial('StudyMaterialCard', ['materials' => $uploads, 'page' => 'profile', 'myProfile' => $myProfile]);
        else:
          View::renderPartial('ZeroResult', ['page' => 'profile', 'myProfile' => $myProfile]);
        endif;
        ?>
      </section>

    <?php endif; ?>

    <aside class="side-profile">
      <!-- Profile Card -->

      <?php
      View::renderPartial('ProfileCard', [
        'user' => $user,
        'isPrivate' => $isPrivate,
      ]);
      ?>

      <!-- wrapper for posts, followers, following, & fllow and request buttons -->
      <div class="userstats-bio-wrapper">
        <!--uploads, followers, following -->
        <div class="userstats">
          <div id="uploads">
            <p>
              <?= $user['materials_count'] + $user['requests_count'] + $user['project_count'] ?>
            </p>
            <div>Posts</div>
          </div>

          <div id="followers">
            <p>
              <?= $user['followers_count'] ?>
            </p>
            <div>Followers</div>
          </div>

          <div id="following">
            <p>
              <?= $user['following_count'] ?>
            </p>
            <div>Following</div>
          </div>
        </div>

        <!-- bio -->
        <p class="bio">
          <?= $user['bio'] ?>
        </p>

        <!-- buttons  -->
        <div class="user-buttons">
          <?php if (!$myProfile && !$isCurrentUserFollower): ?>
            <!-- follow button -->
            <form action="/follow/<?= $user['user_id'] ?>" method="post" id="follow-form">
              <button class="follow-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path fill="currentColor" fill-rule="evenodd"
                    d="M7.345 4.017a42.253 42.253 0 0 1 9.31 0c1.713.192 3.095 1.541 3.296 3.26a40.66 40.66 0 0 1 0 9.446c-.201 1.719-1.583 3.068-3.296 3.26a42.245 42.245 0 0 1-9.31 0c-1.713-.192-3.095-1.541-3.296-3.26a40.652 40.652 0 0 1 0-9.445a3.734 3.734 0 0 1 3.295-3.26M12 7.007a.75.75 0 0 1 .75.75v3.493h3.493a.75.75 0 1 1 0 1.5H12.75v3.493a.75.75 0 0 1-1.5 0V12.75H7.757a.75.75 0 0 1 0-1.5h3.493V7.757a.75.75 0 0 1 .75-.75"
                    clip-rule="evenodd" />
                </svg>Follow
              </button>
            </form>
          <?php elseif (!$myProfile && $isCurrentUserFollower): ?>
            <!-- unfollow/ following button -->
            <form action="/unfollow/<?= $user['user_id'] ?>" method="post" id="unfollow-form">
              <input type="hidden" name="_method" value="DELETE">
              <button class="follow-button">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M13 14.062V22H4a8 8 0 0 1 9-7.938M12 13c-3.315 0-6-2.685-6-6s2.685-6 6-6s6 2.685 6 6s-2.685 6-6 6m5.793 6.914l3.535-3.535l1.415 1.414l-4.95 4.95l-3.536-3.536l1.415-1.414z"/></svg>Following
              </button>
            </form>
          <?php else: ?>
            <a href="/material/create" class="upload-button">
              <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path opacity="0.4"
                    d="M11.9993 2C16.7133 2 19.0704 2 20.5348 3.46447C21.2923 4.22195 21.658 5.21824 21.8345 6.65598V10H2.16406V6.65598C2.3406 5.21824 2.70628 4.22195 3.46377 3.46447C4.92823 2 7.28525 2 11.9993 2Z"
                    fill="currentColor"></path>
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M2 14C2 11.1997 2 9.79961 2.54497 8.73005C3.02433 7.78924 3.78924 7.02433 4.73005 6.54497C5.79961 6 7.19974 6 10 6H14C16.8003 6 18.2004 6 19.27 6.54497C20.2108 7.02433 20.9757 7.78924 21.455 8.73005C22 9.79961 22 11.1997 22 14C22 16.8003 22 18.2004 21.455 19.27C20.9757 20.2108 20.2108 20.9757 19.27 21.455C18.2004 22 16.8003 22 14 22H10C7.19974 22 5.79961 22 4.73005 21.455C3.78924 20.9757 3.02433 20.2108 2.54497 19.27C2 18.2004 2 16.8003 2 14ZM12.5303 10.4697C12.3897 10.329 12.1989 10.25 12 10.25C11.8011 10.25 11.6103 10.329 11.4697 10.4697L8.96967 12.9697C8.67678 13.2626 8.67678 13.7374 8.96967 14.0303C9.26256 14.3232 9.73744 14.3232 10.0303 14.0303L11.25 12.8107V17C11.25 17.4142 11.5858 17.75 12 17.75C12.4142 17.75 12.75 17.4142 12.75 17V12.8107L13.9697 14.0303C14.2626 14.3232 14.7374 14.3232 15.0303 14.0303C15.3232 13.7374 15.3232 13.2626 15.0303 12.9697L12.5303 10.4697Z"
                    fill="currentColor"></path>
                </g>
              </svg>Upload
            </a>
          <?php endif; ?>

          <?php if ($myProfile || $isCurrentUserFollower): ?>
            <?php if ($user['allow_email']): ?>
              <a href="mailto:<?= $user['email'] ?>?subject=Love%20The%20Way%20You%20Wizdemy&body=Your%20Awsome%20Follower"
                target="_blank" class="social-link-button gmail">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 193">
                  <path fill="#4285f4"
                    d="M58.182 192.05V93.14L27.507 65.077L0 49.504v125.091c0 9.658 7.825 17.455 17.455 17.455z" />
                  <path fill="#34a853"
                    d="M197.818 192.05h40.727c9.659 0 17.455-7.826 17.455-17.455V49.505l-31.156 17.837l-27.026 25.798z" />
                  <path fill="#ea4335"
                    d="m58.182 93.14l-4.174-38.647l4.174-36.989L128 69.868l69.818-52.364l4.669 34.992l-4.669 40.644L128 145.504z" />
                  <path fill="#fbbc04" d="M197.818 17.504V93.14L256 49.504V26.231c0-21.585-24.64-33.89-41.89-20.945z" />
                  <path fill="#c5221f"
                    d="m0 49.504l26.759 20.07L58.182 93.14V17.504L41.89 5.286C24.61-7.66 0 4.646 0 26.23z" />
                </svg>
              </a>
            <?php endif; ?>
            <?php if ($user['allow_phone'] && !empty($user['phone_number'])): ?>
              <a href="https://wa.me/<?= $user['phone_number'] ?>/?text=YourMessageHere" target="_blank"
                class="social-link-button whatsapp">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                  viewBox="0 0 418.135 418.135" xml:space="preserve" fill="#000000">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <g>
                      <path style="fill:#34a853;"
                        d="M198.929,0.242C88.5,5.5,1.356,97.466,1.691,208.02c0.102,33.672,8.231,65.454,22.571,93.536 L2.245,408.429c-1.191,5.781,4.023,10.843,9.766,9.483l104.723-24.811c26.905,13.402,57.125,21.143,89.108,21.631 c112.869,1.724,206.982-87.897,210.5-200.724C420.113,93.065,320.295-5.538,198.929,0.242z M323.886,322.197 c-30.669,30.669-71.446,47.559-114.818,47.559c-25.396,0-49.71-5.698-72.269-16.935l-14.584-7.265l-64.206,15.212l13.515-65.607 l-7.185-14.07c-11.711-22.935-17.649-47.736-17.649-73.713c0-43.373,16.89-84.149,47.559-114.819 c30.395-30.395,71.837-47.56,114.822-47.56C252.443,45,293.218,61.89,323.887,92.558c30.669,30.669,47.559,71.445,47.56,114.817 C371.446,250.361,354.281,291.803,323.886,322.197z">
                      </path>
                      <path style="fill:#34a853;"
                        d="M309.712,252.351l-40.169-11.534c-5.281-1.516-10.968-0.018-14.816,3.903l-9.823,10.008 c-4.142,4.22-10.427,5.576-15.909,3.358c-19.002-7.69-58.974-43.23-69.182-61.007c-2.945-5.128-2.458-11.539,1.158-16.218 l8.576-11.095c3.36-4.347,4.069-10.185,1.847-15.21l-16.9-38.223c-4.048-9.155-15.747-11.82-23.39-5.356 c-11.211,9.482-24.513,23.891-26.13,39.854c-2.851,28.144,9.219,63.622,54.862,106.222c52.73,49.215,94.956,55.717,122.449,49.057 c15.594-3.777,28.056-18.919,35.921-31.317C323.568,266.34,319.334,255.114,309.712,252.351z">
                      </path>
                    </g>
                  </g>
                </svg>
              </a>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ($isCurrentUserFollower): ?>
            <form id="report-form" action="/report/user/<?= $user['user_id'] ?>" method="post">
              <button type="submit">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <path fill-rule="evenodd" clip-rule="evenodd" opacity="0.5"
                      d="M6.5 1.75C6.5 1.33579 6.16421 1 5.75 1C5.33579 1 5 1.33579 5 1.75V21.75C5 22.1642 5.33579 22.5 5.75 22.5C6.16421 22.5 6.5 22.1642 6.5 21.75V13.6V3.6V1.75Z"
                      fill="currentColor"></path>
                    <path
                      d="M13.5582 3.87333L13.1449 3.70801C11.5821 3.08288 9.8712 2.9258 8.22067 3.25591L6.5 3.60004V13.6L8.22067 13.2559C9.8712 12.9258 11.5821 13.0829 13.1449 13.708C14.8385 14.3854 16.7024 14.5119 18.472 14.0695L18.5721 14.0445C19.1582 13.898 19.4361 13.2269 19.1253 12.7089L17.5647 10.1078C17.2232 9.53867 17.0524 9.25409 17.0119 8.94455C16.9951 8.81543 16.9951 8.68466 17.0119 8.55553C17.0524 8.24599 17.2232 7.96141 17.5647 7.39225L18.8432 5.26136C19.1778 4.70364 18.6711 4.01976 18.0401 4.17751C16.5513 4.54971 14.9831 4.44328 13.5582 3.87333Z"
                      fill="currentColor"></path>
                  </g>
                </svg>
              </button>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </aside>

  </div>

  </main>
  <?php

endif;

View::renderPartial('ThreeDotMenu', [
  'myProfile' => $myProfile,
  'user_id' => $user['user_id'],
]);

View::renderPartial('SideInfo');

View::renderPartial('SearchOverlay');

View::renderPartial('ToastNotification');

View::renderPartial('ConfirmModal');

View::renderPartial('EndOfHTMLDocument');
