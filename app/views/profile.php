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
    'category'
  ]
]);

View::renderPartial('SideNav', [
  'currentPage' => ($myProfile ? 'profile' : '')
]);

View::renderPartial('MenuHeader');
?>

<?php
  //if user does not exist
  if (!$user) :
    View::renderPartial('ZeroResult', [
      'page' => 'ghostProfile'
    ]);
  else :
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
        View::renderPartial('StudyMaterialCard', ['materials' => $uploads, 'page' => 'profile']);
      else:
        View::renderPartial('ZeroResult', ['page' => 'profile', 'myProfile' => $myProfile]);
      endif;
      ?>
    </section>

  <?php endif; ?>

  <aside class="side-profile">
    <!-- Profile Card -->

    <div class="profile-card">
      <div class="username-logo">
        <div class="username">
          <p>Username</p>
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 512 512">
              <path
                d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256v32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32v80 32c0 17.7 14.3 32 32 32s32-14.3 32-32V256c0-106-86-192-192-192zm64 192a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z" />
            </svg>
            <div>
              <?= $user['username'] ?>
            </div>
          </div>
        </div>
        <div class="logo">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M5.708 13.35c.625-1.92 1.75-4.379 3.757-6.386c3.934-3.934 9.652-4.515 9.797-4.53a1.005 1.005 0 0 1 .944.454c.208.313 1.38 2.283-.191 4.663a2.63 2.63 0 0 1-.276.344a.996.996 0 0 1-.03.37c-.19.689-.434 1.412-.75 2.135c-.551 1.263-1.328 2.54-2.423 3.636c-2.05 2.05-4.742 2.991-6.844 3.43a19.357 19.357 0 0 1-2.883.378C6.778 18.09 6.5 20.57 6.5 21a1 1 0 1 1-2 0c0-.571.116-1.67.221-2.56c.205-1.732.446-3.427.987-5.09m12.637-6.9c.527-.8.52-1.48.415-1.92c-1.527.275-5.219 1.186-7.881 3.849c-1.704 1.703-2.7 3.84-3.269 5.59a17.75 17.75 0 0 0-.494 1.85a17.417 17.417 0 0 0 2.167-.31c1.92-.402 4.179-1.228 5.838-2.888c.85-.85 1.484-1.857 1.954-2.905c-.976.52-2.018.986-2.759 1.233a1 1 0 1 1-.632-1.898c.674-.225 1.758-.713 2.754-1.265c.494-.274.946-.553 1.301-.808c.384-.276.56-.46.606-.529Z"/></g></svg>
        </div>
      </div>
      <div class="name-private">
        <div class="full-name">
          <p>Name</p>
          <div>
            <?= $user['full_name'] ?>
          </div>
        </div>
        <?php if ($isPrivate): ?>
        <div class="private-icon">
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
        <?php endif; ?>
      </div>
      <div class="infos">
        <div class="class-course">
          <p>EDU LEVEL</p>
          <div>
            <?= $user['education_level'] == '' ? '- - - - - - -' : $user['education_level']; ?>
          </div>
        </div>
        <div class="user-type">
          <p>U/T</p>
          <div>
            <?= $user['user_type'] == '' ? '-' : $user['user_type'][0] ; ?>
          </div>
        </div>

        <div class="year">
          <p>J-YR</p>
          <div>
            <?php
            $dateTime = new DateTime($user['created_at']);
            $year = $dateTime->format('Y');
            echo $year;
            ?>
          </div>
        </div>
      </div>
    </div>

    <!-- wrapper for posts, followers, following, & fllow and request buttons -->
    <div class="userstats-bio-wrapper">
      <!--uploads, followers, following -->
      <div class="userstats">
        <div id="uploads">
          <p>
            <?= $user['materials_count'] ?>
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
          <form action="/follow" method="post">
            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
            <button class="follow-button">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="currentColor" fill-rule="evenodd"
                  d="M7.345 4.017a42.253 42.253 0 0 1 9.31 0c1.713.192 3.095 1.541 3.296 3.26a40.66 40.66 0 0 1 0 9.446c-.201 1.719-1.583 3.068-3.296 3.26a42.245 42.245 0 0 1-9.31 0c-1.713-.192-3.095-1.541-3.296-3.26a40.652 40.652 0 0 1 0-9.445a3.734 3.734 0 0 1 3.295-3.26M12 7.007a.75.75 0 0 1 .75.75v3.493h3.493a.75.75 0 1 1 0 1.5H12.75v3.493a.75.75 0 0 1-1.5 0V12.75H7.757a.75.75 0 0 1 0-1.5h3.493V7.757a.75.75 0 0 1 .75-.75"
                  clip-rule="evenodd" />
              </svg>Follow
            </button>
          </form>
        <?php elseif (!$myProfile && $isCurrentUserFollower): ?>
          <form action="/unfollow" method="post">
          <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
            <button class="follow-button">
            <svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
              aria-hidden="true" role="img" class="iconify iconify--twemoji" preserveAspectRatio="xMidYMid meet"
              fill="#000000">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path fill="#F4900C"
                  d="M33.629 16.565l-.092 1.608l-.041.814c-.02.265-.092.529-.142.794l-.285 1.598c-.153.519-.326 1.028-.499 1.547c-.743 2.025-1.791 4.029-3.246 5.698a23.476 23.476 0 0 1-5.006 4.396c-1.903 1.221-3.867 2.167-6.126 2.859l-.385.121l-.427-.142c-1.526-.499-2.798-1.099-4.101-1.832c-1.272-.722-2.503-1.536-3.612-2.524l-.835-.732l-.784-.794c-.529-.519-.987-1.109-1.455-1.689a20.511 20.511 0 0 1-2.3-3.826c-.611-1.353-1.109-2.768-1.404-4.213c-.071-.366-.183-.722-.224-1.089l-.132-1.089c-.071-.733-.193-1.435-.153-2.279c.061-1.618.56-3.175 1.313-4.508a14.016 14.016 0 0 1 2.849-3.48l3.46-3.053l-1.669 4.174c-.57 1.435-.845 3.134-.193 4.202c.315.529.885.814 1.587.824c.733 0 1.475-.203 1.872-.692c.407-.478.438-1.231.183-1.954c-.326-.753-.631-1.77-.59-2.696c0-.946.275-1.893.753-2.717c.488-.824 1.19-1.496 1.984-1.994l1.028-.641l-.285 1.19c-.295 1.221-.081 2.503.733 3.287c.804.784 2.076 1.058 3.103.794c1.028-.275 1.72-1.109 1.76-2.025c.081-.946-.417-2.015-1.058-3.002L16.932 0l3.887 1.628c1.089.448 2.167.956 3.185 1.669c1.007.712 2.004 1.608 2.686 2.788c.712 1.16 1.007 2.584.977 3.836c0 .315-.02.621-.041.926c-.041.305-.051.55-.122.936c-.122.682-.305 1.19-.458 1.709c-.315.997-.519 2.025-.295 2.564c.132.509 1.292.906 2.147.794c.916-.092 1.77-.733 2.371-1.577c.6-.855.916-1.923 1.079-2.981l.132-.834l.295.763c.549 1.383.864 2.859.854 4.344z">
                </path>
                <path fill="#FFCC4D"
                  d="M33.146 16.503c-.001-1.463.068-2.222-.507-3.52c-.393 3.824-3.228 5.144-5.792 4.23c-2.402-.857-.783-4.198-.664-5.793c.202-2.703-.01-5.796-5.919-8.369c2.455 3.903.284 6.327-1.993 6.475c-2.526.164-4.84-1.804-3.986-4.997c-2.765 1.693-2.846 4.543-1.993 6.386c.89 1.921-.036 3.518-2.206 3.695c-2.426.199-3.773-2.158-2.531-5.913c-2.151 2.104-3.676 4.837-3.449 7.805C5.142 30.035 17.841 33.93 17.841 33.93s15.319-3.757 15.305-17.427z">
                </path>
                <path fill="#DD2E44"
                  d="M30.935 19.489a7.234 7.234 0 0 0-7.233-7.234a7.22 7.22 0 0 0-5.878 3.027a7.22 7.22 0 0 0-5.877-3.027a7.234 7.234 0 0 0-7.234 7.234c0 .566.072 1.114.195 1.643c1.004 6.24 7.943 12.824 12.915 14.632c4.972-1.808 11.911-8.391 12.914-14.631a7.074 7.074 0 0 0 .198-1.644z">
                </path>
                <path fill="#FFCC4D"
                  d="M24.312 31.553s1.426-2.769 1.319-5.645c-.038-1.024-.327-2.019-.736-2.958c-.958-2.196-2.806-7.706 1.147-10.661c0 0-.755 1.269-.085 3.581c.265.915.761 1.741 1.35 2.49c1.36 1.732 4.219 6.501-.484 10.948l-2.511 2.245zm-7.659 3.728s-1.581-1.515-2.421-3.652c-.299-.761-.406-1.58-.406-2.398c-.001-1.911-.409-6.529-4.242-7.427c0 0 .957.687 1.205 2.591c.098.753-.001 1.516-.192 2.251c-.441 1.701-.972 5.909 3.886 7.659l2.17.976z">
                </path>
              </g>
            </svg>Following
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
          <?php if($user['allow_email']) : ?>
          <a href="mailto:<?= $user['email'] ?>?subject=Love%20The%20Way%20You%20Wizdemy&body=Your%20Awsome%20Follower" target="_blank" class="social-link-button gmail">
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
          <?php if($user['allow_phone'] && !empty($user['phone_number'])) : ?>
          <a href="https://wa.me/<?= $user['phone_number']?>/?text=YourMessageHere" target="_blank" class="social-link-button whatsapp">
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
      </div>
    </div>
  </aside>
</div>

<?php

endif;

View::renderPartial('ThreeDotMenu');

View::renderPartial('SideInfo');

View::renderPartial('SearchOverlay');

View::renderPartial('ToastNotification');

View::renderPartial('EndOfHTMLDocument');
