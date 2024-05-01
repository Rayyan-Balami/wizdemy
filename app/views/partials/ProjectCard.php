<!-- project card  -->
<div class="card-section">
  <?php foreach ($projects as $project):
    $repo_info = str_replace("https://github.com/", "", $project['repo_link']);
    //explode the repo_info to get the owner and repo name
    $owner = explode("/", $repo_info)[0];
    $repo = explode("/", $repo_info)[1];
    ?>
    <!--project card  -->
    <div class="card project-card">
      <!-- image -->
      <a href="<?= $project['repo_link'] ?>" target="_blank" class="thumbnail">
        <img src="https://opengraph.githubassets.com/<?= SITE_NAME ?>/<?= $repo_info ?>" alt="github repo thumbnail">

        <?php if ($project['status'] === 'suspend'): ?>
          <div>
            <div class="suspended-svg">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g fill="none" stroke="currentColor" stroke-width="1.7">
                  <path stroke-linecap="round" d="M16 12H8" />
                  <circle cx="12" cy="12" r="10" />
                </g>
              </svg> Suspended
            </div>
          </div>
        <?php endif; ?>
      </a>


      <!-- subject | here in project card subject is rplaced with the owner of repo , but still using the subject class so that styles are not broken -->
      <a href="<?= $project['repo_link'] ?>" target="_blank">
        <p class="subject">
          Github /
          <?= $owner ?>
        </p>
        </p>
        <!-- title  -->
        <h2 class="title">
          <?= $repo ?>
        </h2>
      </a>


      <!-- username  -->
      <a href="<?= isset($page) && $page === 'profile' ? '#' : '/profile/' . $project['user_id'] ?>" class="username">
        <!-- at icon @  -->
        <svg xmlns="http://www.w3.org/2000/svg" height="14" width="14" fill="currentColor" style="flex-shrink: 0"
          viewBox="0 0 512 512">
          <path
            d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256v32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32v80 32c0 17.7 14.3 32 32 32s32-14.3 32-32V256c0-106-86-192-192-192zm64 192a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z">
          </path>
        </svg>
        <!-- username  -->
        <h3>
          <?= $project['username'] ?>
        </h3>
      </a>
      <!-- time  -->
      <div class="time">
        <p><a href="<?= isset($page) && $page === 'profile' ? '#' : '/profile?id=' . $project['user_id'] ?>"
            class="time-ago" data-datetime="<?= $project['created_at'] ?>"></a></p>
        <!-- three dot icon -->
                <button class="three-dot-icon" onclick="openThreeDotMenu(this)" title="three dot menu" data-copy-link="<?= $project['repo_link'] ?>"
          data-info-link="/api/info/project/<?= $project['project_id'] ?>"
          data-report-link="/report/project/<?= $project['project_id'] ?>">

          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 5 24">
            <path fill="currentColor"
              d="M5.217 12a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0m0-9.392a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0m0 18.783a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0" />
          </svg>
        </button>
      </div>
    </div>
  <?php endforeach; ?>
</div>