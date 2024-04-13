<?php

View::renderPartial('Header', [
    'pageTitle' => SITE_NAME . ' | Admin Dashboard',
    'stylesheets' => [
        'adminSettingForm',
    ],
    'scripts' => [
        'script',
        'toastTimer',
        'authFormValidation',
        'confirmModal',
    ]
]);

View::renderPartial('../adminPartials/sideNav', [
    'currentPage' => 'addAdminForm',
]);

View::renderPartial('../adminPartials/menuHeader');

$flashOld = Session::get('old');

?>
<!-- personal information title -->
<div class="title-label">

    <div>
   <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20"><path fill="currentColor" d="M15 2H5L4 8h12zM0 10s2 1 10 1s10-1 10-1l-4-2H4zm8 4h4v1H8z"/><circle cx="6" cy="15" r="3" fill="currentColor"/><circle cx="14" cy="15" r="3" fill="currentColor"/></svg>
    </div>

    <h2 class="title">
        Add Admin
    </h2>

    <p class="message">
        Boss, you can Add admin here.
    </p>
    <span id="profile"></span>
</div>

<!-- profile content -->
<div class="form-section">

    <!-- profile content -->
    <div>
        <h2 class="form-heading">
       <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20"><path fill="currentColor" d="M15 2H5L4 8h12zM0 10s2 1 10 1s10-1 10-1l-4-2H4zm8 4h4v1H8z"/><circle cx="6" cy="15" r="3" fill="currentColor"/><circle cx="14" cy="15" r="3" fill="currentColor"/></svg>Admin Details
        </h2>
        <p class="form-info">
            Add new admin by filling the form below.
        </p>
        <!-- form for user name and about -->
        <form action="/admin/add/admin" method="POST"
            id="adminForm" class="form">

            <!-- username -->
            <div class="username">
                <label for="username">User Name</label>
                <input type="text" placeholder="rynb_hir000" required name="username" id="username"
                    value="<?= isset($adminDetails) ? $adminDetails['username'] : (isset($flashOld['username']) ? $flashOld['username'] : '') ?>" />
            </div>

            <!-- admin email -->
            <div class="admin-email">
                <label for="email">Email Address</label>
                <input type="email" placeholder="normal-admin@gmail.com" required name="email" id="email"
                    value="<?= isset($adminDetails) ? $adminDetails['email'] : (isset($flashOld['email']) ? $flashOld['email'] : '') ?>" />
            </div>

            <!-- new password -->
            <div class="newPassword">
                <label for="newPassword">Password
                <input type="password" placeholder="••••••••" required name="newPassword" id="newPassword" />
            </div>

            <!-- confirm password -->
            <div class="confirmPassword">
                <label for="confirmPassword">Confirm
                    Password</label>
                <input type="password" placeholder="••••••••" required name="confirmPassword" id="confirmPassword" />
            </div>

            <!-- save button -->
            <button type="submit" name="submitBtn">
                Save
            </button>
        </form>
        <span id="password"></span>
    </div>
</div>
</main>

<?php
View::renderPartial('ToastNotification');

View::renderPartial('ConfirmModal');

View::renderPartial('EndOfHTMLDocument');

?>