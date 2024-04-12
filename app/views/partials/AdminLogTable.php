<?php //dd($logs) ?>
<div class="table-menus">
  <form action="#" method="GET">
    <div class="search-field">
      <input type="text" name="email" id="search-input" placeholder="Search" class="search-input">
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
          Admin
        </th>
        <th>
        Target Type
        </th>
        <th>
         
         Action Performed
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
      <?php foreach ($logs as $log) : ?>
        <tr>
          <td>
            <p title="Admin Username | Click to View">
              <a href="/admin/view/admin/<?= $log['admin_id'] ?>">
              <?= $log['admin_username'] ?>
              </a>
            </p>
            <a href="mailto:<?= $log['admin_email'] ?>">
              <?= $log['admin_email'] ?>
            </a>
          </td>
          <td>
            <div class="target_type">
              <p>
                <?= $log['target_type'] ?>
              </p>
            </div>
          </td>
          <td>
            <div class="action_type">
              <p>
                <?= $log['action_type'] ?>
              </p>
            </div>
          </td>
          <td>
            <p title="Last Updated: <?= $log['updated_at'] ?>">
              Updated:&nbsp;<?= date('d M Y', strtotime($log['updated_at'])) ?>
            </p>
            <span  title="Joined At: <?= $log['created_at'] ?>">
              Created:&nbsp;<?= date('d M Y', strtotime($log['created_at'])) ?>
            </span>
          </td>
          <td class="actions-cell">
            <?php if($log['action_type'] != 'delete'): ?>
            <div>
              <!-- view button  to view the target -->
              <a href="/admin/view/<?= $log['target_type']?>/<?= $log['target_id'] ?>" class="view-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 8.25a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5M9.75 12a2.25 2.25 0 1 1 4.5 0a2.25 2.25 0 0 1-4.5 0"/><path d="M12 3.25c-4.514 0-7.555 2.704-9.32 4.997l-.031.041c-.4.519-.767.996-1.016 1.56c-.267.605-.383 1.264-.383 2.152c0 .888.116 1.547.383 2.152c.25.564.617 1.042 1.016 1.56l.032.041C4.445 18.046 7.486 20.75 12 20.75c4.514 0 7.555-2.704 9.32-4.997l.031-.041c.4-.518.767-.996 1.016-1.56c.267-.605.383-1.264.383-2.152c0-.888-.116-1.547-.383-2.152c-.25-.564-.617-1.041-1.016-1.56l-.032-.041C19.555 5.954 16.514 3.25 12 3.25M3.87 9.162C5.498 7.045 8.15 4.75 12 4.75c3.85 0 6.501 2.295 8.13 4.412c.44.57.696.91.865 1.292c.158.358.255.795.255 1.546s-.097 1.188-.255 1.546c-.169.382-.426.722-.864 1.292C18.5 16.955 15.85 19.25 12 19.25c-3.85 0-6.501-2.295-8.13-4.412c-.44-.57-.696-.91-.865-1.292c-.158-.358-.255-.795-.255-1.546s.097-1.188.255-1.546c.169-.382.426-.722.864-1.292"/></g></svg>
              </a>
            </div>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<?php
