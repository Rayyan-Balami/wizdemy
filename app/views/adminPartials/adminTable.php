<?php View::renderPartial('../adminPartials/tableMenu', [
  'currentData' => count($admins),
  'page' => $page,
  'totalData' => $totalData,
  'query' => $query,
  'table_type' => ($currentPage == 'adminManagement' ? 'admins' : 'deleted admins')
]); ?>


<div class="table-section">
  <table>
    <thead>
      <tr>
        <th>
          Name
        </th>
        <th>
          Actions Performed
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
      <?php foreach ($admins as $admin): ?>
        <tr>
          <td>
            <p title="username">
              <?= $admin['username'] ?>
            </p>
            <a href="mailto:<?= $admin['email'] ?>">
              <?= $admin['email'] ?>
            </a>
          </td>
          <td>
            <p title="Actions Performed: <?= $admin['logs_count'] ?>">
              <?= $admin['logs_count'] ?> actions
            </p>
          <td>
            <?php if ($currentPage == 'adminManagement'): ?>
            <p title="Last Updated: <?= $admin['updated_at'] ?>">
              Updated:&nbsp;<?= date('d M Y', strtotime($admin['updated_at'])) ?>
            </p>
            <?php elseif ($currentPage == 'restoreAdmin'): ?>
            <p title="Deleted At: <?= $admin['deleted_at'] ?>">
              Deleted:&nbsp;<?= date('d M Y', strtotime($admin['deleted_at'])) ?>
            </p>
            <?php endif ?>
            <span title="Joined At: <?= $admin['created_at'] ?>">
              Created:&nbsp;<?= date('d M Y', strtotime($admin['created_at'])) ?>
            </span>
          </td>
          <td class="actions-cell">
            <div>
              <?php if ($currentPage == 'adminManagement'): ?>
                <!-- suspend button  -->
                <button title="Suspend" class="suspend-btn  <?= $admin['status'] == 'suspend' ? 'active' : '' ?>"
                  data-status="<?= $admin['status'] == 'suspend' ? 'active' : 'suspend' ?>"
                  onclick="updateStatus('admin',<?= $admin['admin_id'] ?>, this)">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M12 1c6.075 0 11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12S5.925 1 12 1M2.5 12a9.5 9.5 0 0 0 9.5 9.5a9.5 9.5 0 0 0 9.5-9.5A9.5 9.5 0 0 0 12 2.5A9.5 9.5 0 0 0 2.5 12m15.75.75H5.75a.75.75 0 0 1 0-1.5h12.5a.75.75 0 0 1 0 1.5" />
                  </svg>
                </button>
                <!-- edit button  -->
                <a title="Edit" href="/admin/edit/admin/<?= $admin['admin_id'] ?>" class="edit-btn">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                      <path
                        d="M9.533 11.15A1.823 1.823 0 0 0 9 12.438V15h2.578c.483 0 .947-.192 1.289-.534l7.6-7.604a1.822 1.822 0 0 0 0-2.577l-.751-.751a1.822 1.822 0 0 0-2.578 0z" />
                      <path
                        d="M21 12c0 4.243 0 6.364-1.318 7.682C18.364 21 16.242 21 12 21c-4.243 0-6.364 0-7.682-1.318C3 18.364 3 16.242 3 12c0-4.243 0-6.364 1.318-7.682C5.636 3 7.758 3 12 3" />
                    </g>
                  </svg>
                </a>
                <!-- delete button  -->
                <button title="Delete" class="delete-btn" onclick="deleteData('admin',<?= $admin['admin_id'] ?>, this)">
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
              <?php elseif ($currentPage == 'restoreAdmin'): ?>
                <!-- restore button  -->
                <button title="Restore" class="restore-btn" onclick="restoreData('admin',<?= $admin['admin_id'] ?>, this)">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"><path fill="currentColor" d="M4.5 2a.5.5 0 0 1 0 1A1.5 1.5 0 0 0 3 4.5a.5.5 0 0 1-1 0A2.5 2.5 0 0 1 4.5 2m5 .5A.5.5 0 0 0 9 2H7a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5m1.5 0a.5.5 0 0 0 .5.5A1.5 1.5 0 0 1 13 4.5a.5.5 0 0 0 1 0A2.5 2.5 0 0 0 11.5 2a.5.5 0 0 0-.5.5M4.5 13a.5.5 0 0 1 0 1A2.5 2.5 0 0 1 2 11.5a.5.5 0 0 1 1 0A1.5 1.5 0 0 0 4.5 13m-2-3.5A.5.5 0 0 0 3 9V7a.5.5 0 0 0-1 0v2a.5.5 0 0 0 .5.5m8 5.5a4.5 4.5 0 1 0 0-9a4.5 4.5 0 0 0 0 9M8.896 7.896a.5.5 0 1 1 .708.708l-.897.896h1.543A2.75 2.75 0 0 1 13 12.25v.25a.5.5 0 0 1-1 0v-.25a1.75 1.75 0 0 0-1.75-1.75H8.707l.897.896a.5.5 0 0 1-.708.708L7.144 10.35a.5.5 0 0 1 .002-.705z"/></svg>
                </button>
              <?php endif ?>
            </div>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>