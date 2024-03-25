<?php

View::renderPartial('Header', [
    'pageTitle' => SITE_NAME . ' | My Information',
    'stylesheets' => [
        'settingForm'
    ],
    'scripts' => [
        'script',
        'searchOverlay',
        'toastTimer',
        'authFormValidation',
    ]
]);

View::renderPartial('SideNav', [
    'currentPage' => 'myInformation'
]);

View::renderPartial('MenuHeader');

$flashOld = Session::get('old');

?>
<!-- personal information title -->
<div class="title-label">

    <div>
        <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path opacity="0.3"
                    d="M18 3H6C3.79 3 2 4.78 2 6.97V17.03C2 19.22 3.79 21 6 21H18C20.21 21 22 19.22 22 17.03V6.97C22 4.78 20.21 3 18 3Z"
                    fill="currentColor"></path>
                <path
                    d="M19 8.75H14C13.59 8.75 13.25 8.41 13.25 8C13.25 7.59 13.59 7.25 14 7.25H19C19.41 7.25 19.75 7.59 19.75 8C19.75 8.41 19.41 8.75 19 8.75Z"
                    fill="currentColor"></path>
                <path
                    d="M19 12.75H15C14.59 12.75 14.25 12.41 14.25 12C14.25 11.59 14.59 11.25 15 11.25H19C19.41 11.25 19.75 11.59 19.75 12C19.75 12.41 19.41 12.75 19 12.75Z"
                    fill="currentColor"></path>
                <path
                    d="M19 16.75H17C16.59 16.75 16.25 16.41 16.25 16C16.25 15.59 16.59 15.25 17 15.25H19C19.41 15.25 19.75 15.59 19.75 16C19.75 16.41 19.41 16.75 19 16.75Z"
                    fill="currentColor"></path>
                <path
                    d="M8.49945 11.7899C9.77523 11.7899 10.8095 10.7557 10.8095 9.47992C10.8095 8.20414 9.77523 7.16992 8.49945 7.16992C7.22368 7.16992 6.18945 8.20414 6.18945 9.47992C6.18945 10.7557 7.22368 11.7899 8.49945 11.7899Z"
                    fill="currentColor"></path>
                <path
                    d="M9.29954 13.1098C8.76954 13.0598 8.21954 13.0598 7.68954 13.1098C6.00954 13.2698 4.65954 14.5998 4.49954 16.2798C4.48954 16.4198 4.52954 16.5598 4.62954 16.6598C4.72954 16.7598 4.85954 16.8298 4.99954 16.8298H11.9995C12.1395 16.8298 12.2795 16.7698 12.3695 16.6698C12.4595 16.5698 12.5095 16.4298 12.4995 16.2898C12.3295 14.5998 10.9895 13.2698 9.29954 13.1098Z"
                    fill="currentColor"></path>
            </g>
        </svg>
    </div>

    <h2 class="title">
        My Information
    </h2>

    <p class="message">
        Give it a personal touch.
    </p>
</div>

<!-- profile content -->
<div class="form-section">
    <!-- profile content -->
    <div>
        <h2 class="form-heading">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                <g fill="currentColor">
                    <path d="M8 9.05a2.5 2.5 0 1 0 0-5a2.5 2.5 0 0 0 0 5" />
                    <path
                        d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm10.798 11c-.453-1.27-1.76-3-4.798-3c-3.037 0-4.345 1.73-4.798 3H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1z" />
                </g>
            </svg>Profile
        </h2>
        <p class="form-info">
            This information will be displayed publicly so be careful what
            you share.
        </p>
        <!-- form for user name and about -->
        <form action="/myInformation/profile" method="post">
            <!-- PUT method -->
            <input type="hidden" name="_method" value="PUT">

            <!-- username -->
            <div class="username">
                <label for="username">User Name</label>
                <input type="text" placeholder="rynb_hir000" required name="username" id="username"
                    value="<?= isset ($flashOld['username']) ? $flashOld['username'] : $user['username'] ?>" />
            </div>

            <!-- bio -->
            <div class="bio">
                <label for="bio">Bio</label>
                <textarea required id="bio" name="bio"
                    rows="3"><?= isset ($flashOld['bio']) ? $flashOld['bio'] : $user['bio'] ?></textarea>

                <p class="mt-2 text-sm text-gray-600">
                    Write a few sentences about yourself.
                </p>
            </div>

            <!-- save button -->
            <button type="submit" name="submitBtn">
                Save
            </button>
        </form>
    </div>

    <!-- personal information content -->
    <div>
        <h2 class="form-heading">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12.5 2.5h-11a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1" />
                    <path d="M4.5 8.5a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m4-3H11m-2.5 3H11" />
                </g>
            </svg>Personal Information
        </h2>
        <p class="form-info">
            We reserve the right to feature select details on the public profile card.
        </p>
        <!-- form for full name, gender, student/teacher, school name, email -->
        <form action="/myInformation/personal" method="post">

            <!-- PUT method -->
            <input type="hidden" name="_method" value="PUT">

            <!-- full name (required)-->
            <div class="name">
                <label for="fullName">Full Name</label>
                <input type="text" placeholder="Hakuna Matata" required name="fullName" id="fullName"
                    value="<?= isset ($flashOld['full_name']) ? $flashOld['full_name'] : $user['full_name'] ?>" />
            </div>

            <!-- email (required)-->
            <div class="email">
                <label for="email">Email Address</label>
                <input type="email" required name="email" id="email" disabled placeholder="<?= $user['email'] ?>" />
            </div>

            <!-- phone number -->
            <div class="phoneNumber">
                <label for="phoneNumber">Phone Number</label>
                <input type="tel" placeholder="984XXXXX07" name="phoneNumber" id="phoneNumber"
                    value="<?= isset ($flashOld['phone_number']) ? $flashOld['phone_number'] : $user['phone_number'] ?>" />
            </div>

            <!-- user-type , student or teacher (required)-->
            <div class="user-type">
                <label for="user-type">I am a ?</label>
                <select name="user-type" id="user-type" required>
                    <option value="" disabled <?= $user['user_type'] === null ? 'selected' : '' ?>>Select an option...
                    </option>
                    <?php
                    $userTypes = [
                        'Student' => 'student',
                        'Teacher' => 'teacher',
                        'Institution' => 'institution'
                    ];
                    foreach ($userTypes as $label => $value) {
                        $selected = (isset ($flashOld['user_type']) && $flashOld['user_type'] === $value) ? 'selected' : (($user['user_type'] === $value) ? 'selected' : '');
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
                    <option value="" disabled <?= $user['education_level'] === null ? 'selected' : '' ?>>Select an
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
                        $selected = (isset ($flashOld['education_level']) && $flashOld['education_level'] === $value) ? 'selected' : (($user['education_level'] === $value) ? 'selected' : '');
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

            <!-- enrolled course (required)-->
            <div class="enrolledCourse">
                <label for="enrolledCourse">Enrolled
                    Course</label>
                <input type="text" placeholder="BCA, CSIT, MCA in short form" name="enrolledCourse" id="enrolledCourse"
                    required
                    value="<?= isset ($flashOld['enrolled_course']) ? $flashOld['enrolled_course'] : $user['enrolled_course'] ?>" />
            </div>

            <!-- school-->
            <div class="school">
                <label for="school">School/ College
                    Name</label>
                <input type="text" placeholder="Enter school/ College name" name="school" id="school"
                    value="<?= isset ($flashOld['school_name']) ? $flashOld['school_name'] : $user['school_name'] ?>" />
            </div>

            <!-- save button -->
            <button type="submit" name="submitBtn" class="px-5 py-3 text-center text-white bg-gray-800 rounded-lg">
                Save
            </button>
        </form>
    </div>
</div>
</main>

<?php

View::renderPartial('SearchOverlay');

View::renderPartial('ToastNotification');

View::renderPartial('EndOfHTMLDocument');

?>