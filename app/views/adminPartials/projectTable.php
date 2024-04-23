<?php View::renderPartial('../adminPartials/tableMenu', [
  'currentData' => count($projects),
  'page' => $page,
  'totalData' => $totalData,
  'query' => $query
]); ?>

<div class="table-section">
  <table>
    <thead>
      <tr>
        <th>
          Thumbnail
        </th>
        <th>
          User
        </th>
        <th>
          Repo Name
        </th>
        <th>
          Dates
        </th>
        <th>
          Action
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($projects as $project):
        $repo_info = str_replace("https://github.com/", "", $project['repo_link']);
        //explode the repo_info to get the owner and repo name
        $owner = explode("/", $repo_info)[0];
        $repo = explode("/", $repo_info)[1];
        ?>
        <tr>
          <td class="thumbnail-td">
            <a href="<?= $project['repo_link'] ?>" target="_blank" class="thumbnail"
            title="<?= $repo ?>">
              <img src="https://opengraph.githubassets.com/wizdemy/<?= $repo_info ?>" alt="github repo thumbnail">
            </a>
          </td>
          <td>
            <p title="Uploaded By : <?= $project['username'] ?> | Click to View">
              <a href="/admin/view/user/<?= $project['user_id'] ?>">
                User:&nbsp;<?= $project['username'] ?>
              </a>
            </p>
            <span title="Owner : <?= $owner ?>">
              Owner:&nbsp;<?= $owner ?>
            </span>
          </td>
          <td class="post-details">
            <p title="Title: <?= $repo?>" class="title">
              Repo:&nbsp;<?= $repo ?>
            </p>
          <td>
            <p title="Last Updated: <?= $project['updated_at'] ?>">
              Updated:&nbsp;<?= date('d M Y', strtotime($project['updated_at'])) ?>
            </p>
            <span title="Joined At: <?= $project['created_at'] ?>">
              Created:&nbsp;<?= date('d M Y', strtotime($project['created_at'])) ?>
            </span>
          </td>
          <td class="actions-cell">
            <div>
              <!-- suspend button  -->
              <button title="Suspend"
               class="suspend-btn  <?= $project['status'] == 'suspend' ? 'active' : '' ?>" data-status="<?= $project['status'] == 'suspend' ? 'active' : 'suspend' ?>"
                onclick="updateStatus('project',<?= $project['project_id'] ?>, this)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" d="M16 12H8" />
                    <circle cx="12" cy="12" r="10" />
                  </g>
                </svg>
              </button>
              <!-- delete button  -->
              <button title="Delete"
               class="delete-btn" onclick="deleteData('project',<?= $project['project_id'] ?>,this)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path fill="currentColor" fill-rule="evenodd"
                    d="M10.31 2.25h3.38c.217 0 .406 0 .584.028a2.25 2.25 0 0 1 1.64 1.183c.084.16.143.339.212.544l.111.335a1.25 1.25 0 0 0 1.263.91h3a.75.75 0 0 1 0 1.5h-17a.75.75 0 0 1 0-1.5h3.09a1.25 1.25 0 0 0 1.173-.91l.112-.335c.068-.205.127-.384.21-.544a2.25 2.25 0 0 1 1.641-1.183c.178-.028.367-.028.583-.028m-1.302 3a2.757 2.757 0 0 0 .175-.428l.1-.3c.091-.273.112-.328.133-.368a.75.75 0 0 1 .547-.395a3.2 3.2 0 0 1 .392-.009h3.29c.288 0 .348.002.392.01a.75.75 0 0 1 .547.394c.021.04.042.095.133.369l.1.3l.039.112c.039.11.085.214.136.315z"
                    clip-rule="evenodd" />
                  <path fill="currentColor"
                    d="M5.915 8.45a.75.75 0 1 0-1.497.1l.464 6.952c.085 1.282.154 2.318.316 3.132c.169.845.455 1.551 1.047 2.104c.591.554 1.315.793 2.17.904c.822.108 1.86.108 3.146.108h.879c1.285 0 2.324 0 3.146-.108c.854-.111 1.578-.35 2.17-.904c.591-.553.877-1.26 1.046-2.104c.162-.813.23-1.85.316-3.132l.464-6.952a.75.75 0 0 0-1.497-.1l-.46 6.9c-.09 1.347-.154 2.285-.294 2.99c-.137.685-.327 1.047-.6 1.303c-.274.256-.648.422-1.34.512c-.713.093-1.653.095-3.004.095h-.774c-1.35 0-2.29-.002-3.004-.095c-.692-.09-1.066-.256-1.34-.512c-.273-.256-.463-.618-.6-1.302c-.14-.706-.204-1.644-.294-2.992z" />
                  <path fill="currentColor"
                    d="M9.425 10.254a.75.75 0 0 1 .821.671l.5 5a.75.75 0 0 1-1.492.15l-.5-5a.75.75 0 0 1 .671-.821m5.15 0a.75.75 0 0 1 .671.82l-.5 5a.75.75 0 0 1-1.492-.149l.5-5a.75.75 0 0 1 .82-.671" />
                </svg>
              </button>
            </div>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<?php
