<?php //dd($materials); ?>
<div class="table-menus">
  <form action="#" method="GET">
    <div class="search-field">
      <input type="text" name="email" id="table-search-input" placeholder="Search ' MATERIALS '&nbsp;&nbsp;&#x2044;&nbsp;&nbsp;or&nbsp;&nbsp;🄲🅃🅁🄻 +  🄺" class="search-input">
    </div>
  </form>
  <div class="prev-next-wrapper">
    <button class="prev-btn">
      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
          <path
            d="M16.1795 3.26875C15.7889 2.87823 15.1558 2.87823 14.7652 3.26875L8.12078 9.91322C6.94952 11.0845 6.94916 12.9833 8.11996 14.155L14.6903 20.7304C15.0808 21.121 15.714 21.121 16.1045 20.7304C16.495 20.3399 16.495 19.7067 16.1045 19.3162L9.53246 12.7442C9.14194 12.3536 9.14194 11.7205 9.53246 11.33L16.1795 4.68297C16.57 4.29244 16.57 3.65928 16.1795 3.26875Z"
            fill="currentColor"></path>
        </g>
      </svg>
    </button>
    <button class="next-btn">
      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
          <path
            d="M7.82054 20.7313C8.21107 21.1218 8.84423 21.1218 9.23476 20.7313L15.8792 14.0868C17.0505 12.9155 17.0508 11.0167 15.88 9.84497L9.3097 3.26958C8.91918 2.87905 8.28601 2.87905 7.89549 3.26958C7.50497 3.6601 7.50497 4.29327 7.89549 4.68379L14.4675 11.2558C14.8581 11.6464 14.8581 12.2795 14.4675 12.67L7.82054 19.317C7.43002 19.7076 7.43002 20.3407 7.82054 20.7313Z"
            fill="currentColor"></path>
        </g>
      </svg>
    </button>
    <div class="table-info">
      1-20 of 100
    </div>
  </div>
</div>

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
          Details
        </th>
        <th>
          Meta Datas
        </th>
        <th>
          interactions
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
      <?php foreach ($materials as $material):
        ?>
        <tr>
          <td class="thumbnail-td">
            <a href="#" class="thumbnail"
              title="Title:&#10;&#10;<?= $material['title'] ?>&#10;&#10;Description:&#10;&#10;<?= $material['description'] ?>">
              <img src="/<?= $material['thumbnail_path'] ?>" alt="material thumbnail">
            </a>
          </td>
          <td>
            <p title="Uploaded By : <?= $material['username'] ?> | Click to View">
              <a href="/admin/view/user/<?= $material['user_id'] ?>">
                User:&nbsp;<?= $material['username'] ?>
              </a>
            </p>
            <span title="Author | Source | Credits : <?= $material['author'] ?>">
              A | S | C:&nbsp;<?= $material['author'] ?>
            </span><br>
            <?php if ($material['responded_to'] != ''): ?>
              <a href="/admin/view/request/<?= $material['request_id'] ?>">
                Responded To:&nbsp;<?= $material['responded_to'] ?>
              </a>
            <?php endif ?>
          </td>
          <td class="post-details">
            <p title="Title: <?= $material['title'] ?>" class="title">
              Title:&nbsp;<?= $material['title'] ?>
            </p>
            <span title="Description: <?= $material['description'] ?>" class="description">
              Description:&nbsp;<?= $material['description'] ?>
            </span>
          </td>
          <td class="meta-datas">
            <p title="Subject: <?= $material['subject'] ?>" class="subject">
              Subject:&nbsp;<?= $material['subject'] ?>
            </p>
            <div class="multi-span">
              <span title="Education Level: <?= $material['education_level'] ?>">
                Edu Lvl:&nbsp;<?= $material['education_level'] ?>
              </span>
              <span title="class/faclty: <?= $material['class_faculty'] ?>">
                Class/Faculty:&nbsp;<?= $material['class_faculty'] ?>
              </span>
              <?php if ($material['semester'] != ''): ?>
                <span title="Semester: <?= $material['semester'] ?>">
                  Sem:&nbsp;<?= $material['semester'] ?>
                </span>
              <?php endif ?>
            </div>
            <div class="multi-span">
              <span title="Dcoument Type: <?= $material['document_type'] ?>">
                Doc Type:&nbsp;<?= $material['document_type'] ?>
              </span>
              <span title="Format: <?= $material['format'] ?>">
                Format:&nbsp;<?= $material['format'] ?>
              </span>
            </div>
          </td>
          <td class="interactions">
            <span title="Views: <?= $material['views_count'] ?>">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                </path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                </path>
              </svg>:&nbsp;<?= $material['views_count'] ?>
            </span>
            <br> <span title="Likes: <?= $material['likes_count'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="256"
                height="256" viewBox="0 0 256 256">
                <path fill="currentColor"
                  d="M178 28c-20.09 0-37.92 7.93-50 21.56C115.92 35.93 98.09 28 78 28a66.08 66.08 0 0 0-66 66c0 72.34 105.81 130.14 110.31 132.57a12 12 0 0 0 11.38 0C138.19 224.14 244 166.34 244 94a66.08 66.08 0 0 0-66-66m-5.49 142.36a328.69 328.69 0 0 1-44.51 31.8a328.69 328.69 0 0 1-44.51-31.8C61.82 151.77 36 123.42 36 94a42 42 0 0 1 42-42c17.8 0 32.7 9.4 38.89 24.54a12 12 0 0 0 22.22 0C145.3 61.4 160.2 52 178 52a42 42 0 0 1 42 42c0 29.42-25.82 57.77-47.49 76.36">
                </path>
              </svg>:&nbsp;
              <?= $material['likes_count'] ?>
            </span>
            <br> <span title="Comments: <?= $material['comments_count'] ?>"><svg viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path d="M7 7H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  </path>
                  <path d="M7 11H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                  </path>
                  <path
                    d="M19 3H5C3.89543 3 3 3.89543 3 5V15C3 16.1046 3.89543 17 5 17H8L11.6464 20.6464C11.8417 20.8417 12.1583 20.8417 12.3536 20.6464L16 17H19C20.1046 17 21 16.1046 21 15V5C21 3.89543 20.1046 3 19 3Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
              </svg>:&nbsp;
              <?= $material['comments_count'] ?>
            </span>
          </td>
          <td>
            <p title="Last Updated: <?= $material['updated_at'] ?>">
              Updated:&nbsp;<?= date('d M Y', strtotime($material['updated_at'])) ?>
            </p>
            <span title="Joined At: <?= $material['created_at'] ?>">
              Created:&nbsp;<?= date('d M Y', strtotime($material['created_at'])) ?>
            </span>
          </td>
          <td class="actions-cell">
            <div>
              <!-- suspend button  -->
              <button class="suspend-btn" data-status="<?= $material['status'] == 'suspend' ? 'suspend' : '' ?>"
                onclick="updateStatus('material',<?= $material['material_id'] ?>,this)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" d="M16 12H8" />
                    <circle cx="12" cy="12" r="10" />
                  </g>
                </svg>
              </button>
              <!-- delete button  -->
              <button class="delete-btn" 
               onclick="deleteData('material',<?= $material['material_id'] ?>,this)">
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
