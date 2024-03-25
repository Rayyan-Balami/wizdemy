<?php
View::renderPartial('Header', [
    'pageTitle' => SITE_NAME . ' | Requests',
    'stylesheets' => [
        'settingForm'
    ],
    'scripts' => [
        'script',
        'searchOverlay',
        'notificationOverlay',
        'toastTimer',
        'authFormValidation',
    ]
]);

$flashOld = Session::get('old');

View::renderPartial('SideNav');

View::renderPartial('MenuHeader', [
    'currentPage' => 'requestForm'
  ]);

?>
<!-- New Request title -->
<div class="title-label">

    <div>
        <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path opacity="0.3"
                    d="M12.9839 22.4946L13.521 21.5879C13.9375 20.8846 14.1458 20.5329 14.4804 20.3384C14.815 20.144 15.2362 20.1367 16.0786 20.1222C17.3224 20.1008 18.1024 20.0247 18.7566 19.7539C19.9704 19.2515 20.9348 18.2878 21.4375 17.0748C21.6226 16.6283 21.7169 16.123 21.7648 15.4515C21.7903 15.0958 21.803 14.9179 21.708 14.7756C21.6131 14.6332 21.4329 14.5728 21.0723 14.452C19.5606 13.9454 16.0584 12.6565 14.1 11.0008C11.8925 9.13444 9.91782 5.3404 9.21118 3.88615C9.0707 3.59705 9.00047 3.4525 8.87715 3.37622C8.75383 3.29994 8.59743 3.30159 8.28463 3.3049C6.25036 3.32638 5.32915 3.43899 4.36537 4.02919C3.69883 4.43737 3.13843 4.9974 2.72997 5.66349C2 6.85388 2 8.47432 2 11.7152V12.7053C2 15.0118 2 16.1651 2.37707 17.0748C2.87984 18.2878 3.84419 19.2515 5.05797 19.7539C5.71215 20.0247 6.49219 20.1008 7.73591 20.1222C8.57837 20.1367 8.9996 20.144 9.33417 20.3384C9.66874 20.5329 9.87702 20.8846 10.2936 21.5879L10.8307 22.4946C11.3094 23.3028 12.5052 23.3028 12.9839 22.4946Z"
                    fill="currentColor"></path>
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M14.8719 0.239228C15.2073 0.55542 15.2039 1.06491 14.8643 1.3772L13.7622 2.39066C14.721 2.39968 15.6433 2.42144 16.4756 2.47388C17.1913 2.51898 17.8616 2.5879 18.4457 2.69609C19.0178 2.80206 19.569 2.95641 20.0069 3.20311C20.8206 3.66166 21.5058 4.29141 22.0058 5.04157C22.4867 5.76328 22.6986 6.57904 22.8003 7.56276C22.8998 8.52518 22.8998 9.72792 22.8998 11.253V11.2953C22.8998 11.7397 22.5129 12.1 22.0355 12.1C21.5582 12.1 21.1712 11.7397 21.1712 11.2953C21.1712 9.7186 21.1703 8.59328 21.0797 7.71697C20.9904 6.85308 20.8201 6.31502 20.5369 5.89005C20.1817 5.35695 19.6936 4.90776 19.1118 4.57993C18.9261 4.47529 18.6031 4.36615 18.1084 4.27451C17.6257 4.18509 17.0367 4.12228 16.3589 4.07957C15.5758 4.03023 14.7025 4.00921 13.7763 4.00026L14.8643 5.00068C15.2039 5.31298 15.2073 5.82246 14.8719 6.13865C14.5364 6.45485 13.9892 6.45801 13.6496 6.14572L11.0568 3.76146C10.8923 3.61027 10.7998 3.40409 10.7998 3.18894C10.7998 2.97379 10.8923 2.76761 11.0568 2.61642L13.6496 0.232165C13.9892 -0.0801259 14.5364 -0.0769636 14.8719 0.239228Z"
                    fill="currentColor"></path>
            </g>
        </svg>
    </div>

    <h2 class="title">
        New Request
    </h2>

    <p class="message">
        Helping each other is the best way to learn.<br>
        Build a community of helping hands.
    </p>

</div>

<!-- .form-section  -->
<div class="form-section">
    <h2 class="form-heading">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
            <path fill="currentColor" fill-rule="evenodd"
                d="M12.238 3.64a1.854 1.854 0 0 0-1.629-1.628l-.8.8a3.367 3.367 0 0 1 1.63 1.628zM4.74 7.88l3.87-3.868a1.854 1.854 0 0 1 1.628 1.629L6.369 9.51a1.5 1.5 0 0 1-.814.418l-1.48.247l.247-1.48a1.5 1.5 0 0 1 .418-.814ZM9.72.78l-2 2l-4.04 4.04a3 3 0 0 0-.838 1.628L2.48 10.62a1 1 0 0 0 1.151 1.15l2.17-.36a3 3 0 0 0 1.629-.839l4.04-4.04l2-2c.18-.18.28-.423.28-.677A3.353 3.353 0 0 0 10.397.5c-.254 0-.498.1-.678.28ZM2.75 13a.75.75 0 0 0 0 1.5h10.5a.75.75 0 0 0 0-1.5z"
                clip-rule="evenodd" />
        </svg>
        Request Details
    </h2>
    <p class="form-info">
        Details must be Correct, Complete and Concise [CCC], so that other students can understand your
        request.
    </p>
    <!-- form -->
    <form action="/request/store" method="post">

        <!-- title (required)-->
        <div class="title">
            <label for="title">Title</label>
            <input type="text" placeholder="Need Lab Report of BCA" required name="title" id="title"
                value="<?= $flashOld['title'] ?? ''; ?>">
        </div>

        <!-- description (required)-->
        <div class="description">
            <label for="description">Description</label>
            <textarea required id="description" name="description"
                rows="3"><?= $flashOld['description'] ?? '' ?></textarea>

            <p class="mt-2 text-sm text-gray-600">
                Describe what you are covering in your study materials.
            </p>
        </div>

        <!-- document-type (required)-->
        <div class="document-type">
            <label for="document-type">Request For </label>
            <select name="document-type" id="document-type" required>
                <option value="" disabled <?= isset($flashOld['document_type']) ? '' : 'selected' ?>>Select an option...
                </option>
                <?php
                $documentTypes = [
                    'Note' => 'note',
                    'Question' => 'question',
                    'Lab Report' => 'labreport',
                    'Github Project' => 'project'
                ];
                foreach ($documentTypes as $label => $value) {
                    $selected = isset($flashOld['document_type']) && $flashOld['document_type'] === $value ? 'selected' : '';
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
                    $selected = isset($flashOld['education_level']) && $flashOld['education_level'] === $value ? 'selected' : '';
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
                    $selected = isset($flashOld['semester']) && $flashOld['semester'] === $semester ? 'selected' : '';
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
            <input type="text" placeholder="C Programming" required name="subject" id="subject" value="<?= $flashOld['subject'] ?? ''; ?>" />
        </div>

        <!-- class/faculty (required)-->
        <div class="class">
            <label for="classFaculty">Class/ Faculty</label>
            <input type="classFaculty" placeholder="Short Forms ie, BCA , CSIT, Management, Science etc" required name="classFaculty"
                id="classFaculty" value="<?= $flashOld['class_faculty'] ?? ''; ?>" />
        </div>

        <!-- save button -->
        <button type="submit" name="submit">
            Request
        </button>
    </form>
</div>

<?php

View::renderPartial('SearchOverlay');

View::renderPartial('NotificationOverlay');

View::renderPartial('ToastNotification');

View::renderPartial('EndOfHTMLDocument');

?>