<?php View::renderPartial('Header', [ 'pageTitle'=> SITE_NAME . ' | ' . ($requestDetails ? 'Respond' : 'Upload'),
  'stylesheets' => [
  'settingForm'
  ],
  'scripts' => [
  'script',
  'searchOverlay',
  'toastTimer',
  'timeAgo',
  'upload',
  'authFormValidation',
  'confirmModal',
  ]
  ]);

  $flashOld = Session::get('old');

  View::renderPartial('SideNav');

  View::renderPartial('MenuHeader', [
  'currentPage' => 'uploadForm'
  ]);
  ?>

  <!-- upload study materials title -->
  <div class="title-label">

    <div>
      <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
          <path opacity="0.3"
            d="M21 15.9983V9.99826C21 7.16983 21 5.75562 20.1213 4.87694C19.3529 4.10856 18.175 4.01211 16 4H8C5.82497 4.01211 4.64706 4.10856 3.87868 4.87694C3 5.75562 3 7.16983 3 9.99826V15.9983C3 18.8267 3 20.2409 3.87868 21.1196C4.75736 21.9983 6.17157 21.9983 9 21.9983H15C17.8284 21.9983 19.2426 21.9983 20.1213 21.1196C21 20.2409 21 18.8267 21 15.9983Z"
            fill="currentColor"></path>
          <path
            d="M8 3.5C8 2.67157 8.67157 2 9.5 2H14.5C15.3284 2 16 2.67157 16 3.5V4.5C16 5.32843 15.3284 6 14.5 6H9.5C8.67157 6 8 5.32843 8 4.5V3.5Z"
            fill="currentColor"></path>
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M6.25 10.5C6.25 10.0858 6.58579 9.75 7 9.75H17C17.4142 9.75 17.75 10.0858 17.75 10.5C17.75 10.9142 17.4142 11.25 17 11.25H7C6.58579 11.25 6.25 10.9142 6.25 10.5ZM7.25 14C7.25 13.5858 7.58579 13.25 8 13.25H16C16.4142 13.25 16.75 13.5858 16.75 14C16.75 14.4142 16.4142 14.75 16 14.75H8C7.58579 14.75 7.25 14.4142 7.25 14ZM8.25 17.5C8.25 17.0858 8.58579 16.75 9 16.75H15C15.4142 16.75 15.75 17.0858 15.75 17.5C15.75 17.9142 15.4142 18.25 15 18.25H9C8.58579 18.25 8.25 17.9142 8.25 17.5Z"
            fill="currentColor"></path>
        </g>
      </svg>
      <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
          <path opacity="0.3"
            d="M20.5 10.19H17.61C15.24 10.19 13.31 8.26 13.31 5.89V3C13.31 2.45 12.86 2 12.31 2H8.07C4.99 2 2.5 4 2.5 7.57V16.43C2.5 20 4.99 22 8.07 22H15.93C19.01 22 21.5 20 21.5 16.43V11.19C21.5 10.64 21.05 10.19 20.5 10.19Z"
            fill="currentColor"></path>
          <path
            d="M15.7997 2.20999C15.3897 1.79999 14.6797 2.07999 14.6797 2.64999V6.13999C14.6797 7.59999 15.9197 8.80999 17.4297 8.80999C18.3797 8.81999 19.6997 8.81999 20.8297 8.81999C21.3997 8.81999 21.6997 8.14999 21.2997 7.74999C19.8597 6.29999 17.2797 3.68999 15.7997 2.20999Z"
            fill="currentColor"></path>
          <path
            d="M13.5 13.75H7.5C7.09 13.75 6.75 13.41 6.75 13C6.75 12.59 7.09 12.25 7.5 12.25H13.5C13.91 12.25 14.25 12.59 14.25 13C14.25 13.41 13.91 13.75 13.5 13.75Z"
            fill="currentColor"></path>
          <path
            d="M11.5 17.75H7.5C7.09 17.75 6.75 17.41 6.75 17C6.75 16.59 7.09 16.25 7.5 16.25H11.5C11.91 16.25 12.25 16.59 12.25 17C12.25 17.41 11.91 17.75 11.5 17.75Z"
            fill="currentColor"></path>
        </g>
      </svg>
      <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
          <path opacity="0.3" d="M21.97 6.41V12.91H2V6.41C2 3.98 3.98 2 6.41 2H17.56C19.99 2 21.97 3.98 21.97 6.41Z"
            fill="currentColor"></path>
          <path
            d="M2 12.9199V13.1199C2 15.5599 3.98 17.5299 6.41 17.5299H10.25C10.8 17.5299 11.25 17.9799 11.25 18.5299V19.4999C11.25 20.0499 10.8 20.4999 10.25 20.4999H7.83C7.42 20.4999 7.08 20.8399 7.08 21.2499C7.08 21.6599 7.41 21.9999 7.83 21.9999H16.18C16.59 21.9999 16.93 21.6599 16.93 21.2499C16.93 20.8399 16.59 20.4999 16.18 20.4999H13.76C13.21 20.4999 12.76 20.0499 12.76 19.4999V18.5299C12.76 17.9799 13.21 17.5299 13.76 17.5299H17.57C20.01 17.5299 21.98 15.5499 21.98 13.1199V12.9199H2Z"
            fill="currentColor"></path>
        </g>
      </svg>
    </div>

    <h2 class="title">
      <?= $requestDetails ? 'Respond' : 'Upload' ?> Study Materials
    </h2>

    <p class="message">
      Ace your exams with the help of our community<br>Share your study materials
    </p>
  </div>

  <!-- form-section  -->
  <div class="form-section xl:font-sans">
    <h2 class="form-heading">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
        <path fill="currentColor" fill-rule="evenodd"
          d="M12.238 3.64a1.854 1.854 0 0 0-1.629-1.628l-.8.8a3.367 3.367 0 0 1 1.63 1.628zM4.74 7.88l3.87-3.868a1.854 1.854 0 0 1 1.628 1.629L6.369 9.51a1.5 1.5 0 0 1-.814.418l-1.48.247l.247-1.48a1.5 1.5 0 0 1 .418-.814ZM9.72.78l-2 2l-4.04 4.04a3 3 0 0 0-.838 1.628L2.48 10.62a1 1 0 0 0 1.151 1.15l2.17-.36a3 3 0 0 0 1.629-.839l4.04-4.04l2-2c.18-.18.28-.423.28-.677A3.353 3.353 0 0 0 10.397.5c-.254 0-.498.1-.678.28ZM2.75 13a.75.75 0 0 0 0 1.5h10.5a.75.75 0 0 0 0-1.5z"
          clip-rule="evenodd" />
      </svg>
      <?= $requestDetails ? 'Request Details' : 'Study Materials' ?>
    </h2>
    <p class="form-info">
      <?= $requestDetails ? 'Respond to the following request.' : 'Upload your study materials to help others.' ?>
      [ CCC ] Correct, Complete, Concise Materials are always appreciated.
    </p>
    <!-- form -->
    <form
      action="/material<?= isset($requestDetails['request_id']) ? '/respond/store/' . $requestDetails['request_id'] : '/store' ?>"
      id="uploadForm" method="post" enctype="multipart/form-data">

      <?php if (!empty($requestDetails)): ?>
        <div class="post-details">
          <p class="post-subject">
            <?= $requestDetails['subject'] ?>
          </p>
          <h3 class="post-title">
            <?= $requestDetails['title'] ?>
          </h3>
          <p class="post-description">
            <?= $requestDetails['description'] ?>
          </p>
          <div class="post-meta-datas">
            <a href="/profile/<?= $requestDetails['user_id'] ?>" class="username">
              <svg xmlns="http://www.w3.org/2000/svg" height="14" width="14" fill="currentColor" style="flex-shrink: 0"
                viewBox="0 0 512 512">
                <path
                  d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256v32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32v80 32c0 17.7 14.3 32 32 32s32-14.3 32-32V256c0-106-86-192-192-192zm64 192a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z">
                </path>
              </svg>
              <h3>
                <?= $requestDetails['username'] ?>
              </h3>
              <span>·</span>
              <p class="time-ago" data-datetime="<?= $requestDetails['created_at'] ?>">
              </p>
            </a>

            <p>Responds :
              <?= $requestDetails['no_of_materials'] ?>
            </p>
            <p>Document Need :
              <?php if ($requestDetails['document_type'] === 'labreport'): ?>
                Lab Report
              <?php else:
                echo $requestDetails['document_type'];
              endif; ?>
            </p>
            <span>#
              <?= $requestDetails['class_faculty'] ?>
            </span>
            <span>#
              <?= $requestDetails['education_level'] ?>
            </span>
            <?php if (!empty($requestDetails['semester'])): ?>
              <span>#
                <?= $requestDetails['semester'] ?> Sem
              </span>
            <?php endif; ?>
            <?php if ($requestDetails['status'] === 'suspend'): ?>
              <span class="suspended-svg">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g fill="none" stroke="currentColor" stroke-width="3">
                  <path stroke-linecap="round" d="M16 12H8" />
                  <circle cx="12" cy="12" r="10" />
                </g>
              </svg> Suspended</span>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>

      <!-- title (required)-->
      <div class="title">
        <label for="title">Title</label>
        <input type="text" placeholder="functions in C programming language." required name="title" id="title"
          value="<?= $flashOld['title'] ?? '' ?>">
      </div>
      <!-- description (required)-->
      <div class="description">
        <label for="description">Description</label>
        <textarea required id="description" name="description" rows="3"><?= $flashOld['description'] ?? '' ?></textarea>

        <p class="mt-2 text-sm text-gray-600">
          Describe what you are covering in your study materials.
        </p>
      </div>

      <!-- document-type (required)-->
      <div class="document-type">
        <label for="document-type">Dcoument Type</label>
        <select name="document-type" id="document-type" required>
          <option value="" disabled <?= isset($flashOld['document_type']) ? '' : 'selected' ?>>Select an option...
          </option>
          <?php
          $documentTypes = [
            'Note' => 'note',
            'Question' => 'question',
            'Lab Report' => 'labreport'
          ];
          foreach ($documentTypes as $label => $value) {
            $selected = (isset($flashOld['document_type']) && $flashOld['document_type'] === $value) || (isset($requestDetails['document_type']) && $requestDetails['document_type'] === $value) ? 'selected' : '';
            // Disable the option if $requestDetails has a document_type
            $disableOption = isset($requestDetails['document_type']) && $requestDetails['document_type'] !== $value ? 'disabled' : '';
            echo "<option value=\"$value\" $selected $disableOption>$label</option>";
          }
          ?>
        </select>

        <svg class="caret-up-down" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M12.7071 4.29289C12.3166 3.90237 11.6834 3.90237 11.2929 4.29289L7.29289 8.29289C6.90237 8.68342 6.90237 9.31658 7.29289 9.70711C7.68342 10.0976 8.31658 10.0976 8.70711 9.70711L12 6.41421L15.2929 9.70711C15.6834 10.0976 16.3166 10.0976 16.7071 9.70711C17.0976 9.31658 17.0976 8.68342 16.7071 8.29289L12.7071 4.29289ZM7.29289 15.7071L11.2929 19.7071C11.6834 20.0976 12.3166 20.0976 12.7071 19.7071L16.7071 15.7071C17.0976 15.3166 17.0976 14.6834 16.7071 14.2929C16.3166 13.9024 15.6834 13.9024 15.2929 14.2929L12 17.5858L8.70711 14.2929C8.31658 13.9024 7.68342 13.9024 7.29289 14.2929C6.90237 14.6834 6.90237 15.3166 7.29289 15.7071Z"
              fill="#000000"></path>
          </g>
        </svg>
      </div>



      <!-- Format ? (required)-->
      <div class="format">
        <label for="format">Format ?</label>
        <select name="format" id="format" required>
          <option value="" disabled <?= isset($flashOld['format']) ? '' : 'selected' ?>>Select an option...
          </option>
          <?php
          $format = [
            'Typed' => 'typed',
            'Handwritten' => 'handwritten',
            'Photo' => 'photo'
          ];
          foreach ($format as $label => $value) {
            $selected = (isset($flashOld['format']) && $flashOld['format'] === $value) || (isset($requestDetails['format']) && $requestDetails['format'] === $value) ? 'selected' : '';
            echo "<option value=\"$value\" $selected>$label</option>";
          }
          ?>
        </select>
        <svg class="caret-up-down" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M12.7071 4.29289C12.3166 3.90237 11.6834 3.90237 11.2929 4.29289L7.29289 8.29289C6.90237 8.68342 6.90237 9.31658 7.29289 9.70711C7.68342 10.0976 8.31658 10.0976 8.70711 9.70711L12 6.41421L15.2929 9.70711C15.6834 10.0976 16.3166 10.0976 16.7071 9.70711C17.0976 9.31658 17.0976 8.68342 16.7071 8.29289L12.7071 4.29289ZM7.29289 15.7071L11.2929 19.7071C11.6834 20.0976 12.3166 20.0976 12.7071 19.7071L16.7071 15.7071C17.0976 15.3166 17.0976 14.6834 16.7071 14.2929C16.3166 13.9024 15.6834 13.9024 15.2929 14.2929L12 17.5858L8.70711 14.2929C8.31658 13.9024 7.68342 13.9024 7.29289 14.2929C6.90237 14.6834 6.90237 15.3166 7.29289 15.7071Z"
              fill="#000000"></path>
          </g>
        </svg>
      </div>

      <!-- Education Level (required)-->
      <div class="educationLevel">
        <label for="educationLevel">Education
          Level</label>
        <select name="educationLevel" id="educationLevel" required>
          <option value="" disabled <?= isset($flashOld['education_level']) ? '' : 'selected' ?>>Select an
            option...</option>
          <?php
          $educationLevels = [
            'School' => 'school',
            '+2' => '+2',
            'Diploma' => 'diploma',
            'Bachelor' => 'bachelor',
            'Master' => 'master',
            'PhD' => 'phd'
          ];
          foreach ($educationLevels as $label => $value) {
            $selected = (isset($flashOld['education_level']) && $flashOld['education_level'] === $value) || (isset($requestDetails['education_level']) && $requestDetails
            ['education_level'] === $value) ? 'selected' : '';
            echo "<option value=\"$value\" $selected>$label</option>";
          }
          ?>
        </select>

        <svg class="caret-up-down" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M12.7071 4.29289C12.3166 3.90237 11.6834 3.90237 11.2929 4.29289L7.29289 8.29289C6.90237 8.68342 6.90237 9.31658 7.29289 9.70711C7.68342 10.0976 8.31658 10.0976 8.70711 9.70711L12 6.41421L15.2929 9.70711C15.6834 10.0976 16.3166 10.0976 16.7071 9.70711C17.0976 9.31658 17.0976 8.68342 16.7071 8.29289L12.7071 4.29289ZM7.29289 15.7071L11.2929 19.7071C11.6834 20.0976 12.3166 20.0976 12.7071 19.7071L16.7071 15.7071C17.0976 15.3166 17.0976 14.6834 16.7071 14.2929C16.3166 13.9024 15.6834 13.9024 15.2929 14.2929L12 17.5858L8.70711 14.2929C8.31658 13.9024 7.68342 13.9024 7.29289 14.2929C6.90237 14.6834 6.90237 15.3166 7.29289 15.7071Z"
              fill="#000000"></path>
          </g>
        </svg>
      </div>

      <!-- semester (optional) -->
      <div class="semester">
        <label for="semester">Semester (if
          applicable)</label>
        <select name="semester" id="semester">
          <option value="" <?= isset($flashOld['semester']) ? '' : 'selected' ?>>Select an option...
          </option>
          <?php
          $semesters = ['first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth'];
          foreach ($semesters as $semester) {
            $selected = (isset($flashOld['semester']) && $flashOld['semester'] === $semester) || (isset($requestDetails['semester']) && $requestDetails['semester'] === $semester) ? 'selected' : '';
            echo "<option value=\"$semester\" $selected>$semester</option>";
          }
          ?>
        </select>
        <svg class="caret-up-down" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M12.7071 4.29289C12.3166 3.90237 11.6834 3.90237 11.2929 4.29289L7.29289 8.29289C6.90237 8.68342 6.90237 9.31658 7.29289 9.70711C7.68342 10.0976 8.31658 10.0976 8.70711 9.70711L12 6.41421L15.2929 9.70711C15.6834 10.0976 16.3166 10.0976 16.7071 9.70711C17.0976 9.31658 17.0976 8.68342 16.7071 8.29289L12.7071 4.29289ZM7.29289 15.7071L11.2929 19.7071C11.6834 20.0976 12.3166 20.0976 12.7071 19.7071L16.7071 15.7071C17.0976 15.3166 17.0976 14.6834 16.7071 14.2929C16.3166 13.9024 15.6834 13.9024 15.2929 14.2929L12 17.5858L8.70711 14.2929C8.31658 13.9024 7.68342 13.9024 7.29289 14.2929C6.90237 14.6834 6.90237 15.3166 7.29289 15.7071Z"
              fill="#000000"></path>
          </g>
        </svg>
      </div>

      <!-- subject (required)-->
      <div class="subject">
        <label for="subject">Subject</label>
        <input type="text" placeholder="C Programming" required name="subject" id="subject"
          value="<?= isset($flashOld['subject']) ? $flashOld['subject'] : (isset($requestDetails['subject']) ? $requestDetails['subject'] : ''); ?>" />
      </div>

      <!-- class/faculty (required)-->
      <div class="class">
        <label for="classFaculty">Class/ Faculty</label>
        <input type="text" placeholder="Short ie 10 class, Management, Science, BCA, CSIT etc" required
          name="classFaculty" id="classFaculty"
          value="<?= isset($flashOld['class_faculty']) ? $flashOld['class_faculty'] : (isset($requestDetails['class_faculty']) ? $requestDetails['class_faculty'] : ''); ?>" />

      </div>

      <!-- author / source / credits (required)-->
      <div class="author">
        <label for="author">Author / Source / Credits [ Be Truthful ]</label>
        <input type="text" placeholder="Rayyan Balami" required name="author" id="author"
          value="<?= $flashOld['author'] ?? ''; ?>" />
      </div>

      <!-- upload file (required)-->
      <div class="file-upload-section">
        <input type="file" name="tempFile" id="tempFile" accept="image/*, application/pdf" />
        <label for="tempFile">
          <div>
            <span> Drop Thumnail & Study Material Here </span>
            <span>
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path
                    d="M15.1289 5.43005L19.3489 6.19C19.7634 6.26246 20.1596 6.41602 20.5147 6.64178C20.8698 6.86755 21.1769 7.16113 21.4184 7.50574C21.6599 7.85035 21.8311 8.23918 21.9221 8.65002C22.0131 9.06087 22.0223 9.48566 21.9489 9.90002L20.2789 19.35C20.2076 19.7642 20.0552 20.1601 19.8305 20.5151C19.6057 20.8702 19.313 21.1773 18.9692 21.4189C18.6254 21.6605 18.2372 21.8318 17.827 21.923C17.4168 22.0141 16.9927 22.0233 16.5789 21.95L8.69891 20.5601C8.28397 20.4871 7.88751 20.333 7.53229 20.1064C7.17706 19.8799 6.87006 19.5855 6.62891 19.2401"
                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path
                    d="M11.2802 2.05006C11.6933 1.97532 12.1173 1.98313 12.5274 2.07307C12.9376 2.16302 13.3258 2.33331 13.6698 2.57411C14.0138 2.8149 14.3067 3.12144 14.5316 3.47603C14.7565 3.83061 14.909 4.22621 14.9802 4.64003L16.6501 14.1C16.7249 14.5132 16.7171 14.9372 16.6271 15.3473C16.5372 15.7575 16.3669 16.1457 16.1261 16.4897C15.8853 16.8337 15.5788 17.1266 15.2242 17.3515C14.8696 17.5764 14.474 17.7289 14.0602 17.8001L6.18015 19.19C5.34473 19.3384 4.4846 19.1489 3.78888 18.6632C3.09316 18.1775 2.61883 17.4354 2.47015 16.6L2.16016 14.82"
                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path
                    d="M2.17037 14.82C1.68722 11.9188 2.37523 8.94454 4.08331 6.55023C5.79139 4.15592 8.37988 2.53738 11.2804 2.05005V2.05005"
                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path
                    d="M2.09068 14.36C1.58068 10.19 6.09067 12.78 8.18067 9.76001C10.2707 6.74001 7.18069 2.76005 11.2907 2.05005"
                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
              </svg></span>
            <span>Or</span>
            <span class="browse-file"> Browse File </span>
            <span class="file-upload-message"></span>
          </div>
        </label>
      </div>


      <!-- thumbnail -->
      <div class="file-preview" id="image-file-preview">
        <img src="" alt="">
        <input type="file" name="imageFile" id="imageFile" accept="image/jpeg, image/jpg, image/png, image/gif"
          required />
        <label class="file-header"><span class="file-name"></span><span>Thumbnail</span></label>
        <div class="file-info">
          <p class="file-size"></p>
          <button type="button" class="file-remove-btn" onclick="removeFile('image')">remove</button>
        </div>
      </div>

      <!-- file -->
      <div class="file-preview" id="document-file-preview">
        <input type="file" name="documentFile" id="documentFile" accept="application/pdf" hidden required />
        <label class="file-header"><span class="file-name"></span><span>File</span></label>
        <span class="file-icon">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 309.267 309.267" xml:space="preserve"
            fill="#000000">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
              <g>
                <path style="fill:#E2574C;"
                  d="M38.658,0h164.23l87.049,86.711v203.227c0,10.679-8.659,19.329-19.329,19.329H38.658 c-10.67,0-19.329-8.65-19.329-19.329V19.329C19.329,8.65,27.989,0,38.658,0z">
                </path>
                <path style="fill:#B53629;"
                  d="M289.658,86.981h-67.372c-10.67,0-19.329-8.659-19.329-19.329V0.193L289.658,86.981z"></path>
                <path style="fill:#FFFFFF;"
                  d="M217.434,146.544c3.238,0,4.823-2.822,4.823-5.557c0-2.832-1.653-5.567-4.823-5.567h-18.44 c-3.605,0-5.615,2.986-5.615,6.282v45.317c0,4.04,2.3,6.282,5.412,6.282c3.093,0,5.403-2.242,5.403-6.282v-12.438h11.153 c3.46,0,5.19-2.832,5.19-5.644c0-2.754-1.73-5.49-5.19-5.49h-11.153v-16.903C204.194,146.544,217.434,146.544,217.434,146.544z M155.107,135.42h-13.492c-3.663,0-6.263,2.513-6.263,6.243v45.395c0,4.629,3.74,6.079,6.417,6.079h14.159 c16.758,0,27.824-11.027,27.824-28.047C183.743,147.095,173.325,135.42,155.107,135.42z M155.755,181.946h-8.225v-35.334h7.413 c11.221,0,16.101,7.529,16.101,17.918C171.044,174.253,166.25,181.946,155.755,181.946z M106.33,135.42H92.964 c-3.779,0-5.886,2.493-5.886,6.282v45.317c0,4.04,2.416,6.282,5.663,6.282s5.663-2.242,5.663-6.282v-13.231h8.379 c10.341,0,18.875-7.326,18.875-19.107C125.659,143.152,117.425,135.42,106.33,135.42z M106.108,163.158h-7.703v-17.097h7.703 c4.755,0,7.78,3.711,7.78,8.553C113.878,159.447,110.863,163.158,106.108,163.158z">
                </path>
              </g>
            </g>
          </svg>
        </span>
        <div class="file-info">
          <p class="file-size"></p>
          <button type="button" class="file-remove-btn" onclick="removeFile('document')">remove</button>
        </div>
      </div>

      <!-- save button -->
      <button type="submit" name="submitBtn" id="submitBtn">
        <?php if (!empty($requestDetails)): ?>
          Respond
        <?php else: ?>
          Upload
        <?php endif; ?>
      </button>
    </form>
  </div>
  </main>
  <?php

  View::renderPartial('SearchOverlay');

  View::renderPartial('ToastNotification');

  View::renderPartial('ConfirmModal');

  View::renderPartial('EndOfHTMLDocument');

  ?>