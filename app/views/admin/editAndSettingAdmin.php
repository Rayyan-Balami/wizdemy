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
    'currentPage' => $type == 'edit' ? 'Edit Admin' : 'Account Security',
]);

View::renderPartial('../adminPartials/menuHeader');

$flashOld = Session::get('old');

?>
<!-- personal information title -->
<div class="title-label">

    <div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path fill="currentColor" d="M15 2H5L4 8h12zM0 10s2 1 10 1s10-1 10-1l-4-2H4zm8 4h4v1H8z" />
            <circle cx="6" cy="15" r="3" fill="currentColor" />
            <circle cx="14" cy="15" r="3" fill="currentColor" />
        </svg>
    </div>

    <h2 class="title">
        <?= $type == 'accountSecurity' ? 'Account Security' : 'Edit Admin' ?>
    </h2>

    <p class="message">
        <?= $type == 'accountSecurity' ? 'Manage your account security below.': 'Boss, Edit admin details below.' ?>
    </p>
    <span id="profile"></span>
</div>

<!-- profile content -->
<div class="form-section">

    <!-- profile content -->
    <div>
        <h2 class="form-heading">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill="currentColor" d="M15 2H5L4 8h12zM0 10s2 1 10 1s10-1 10-1l-4-2H4zm8 4h4v1H8z" />
                <circle cx="6" cy="15" r="3" fill="currentColor" />
                <circle cx="14" cy="15" r="3" fill="currentColor" />
            </svg>Admin Details
        </h2>
        <p class="form-info">
            <?= $type == 'edit' ? 'Edit admin details below.' : 'Admins Details are shown below.' ?>
        </p>
        <!-- form for user name and about -->
        <form action="<?= Session::get('admin')['admin_id'] == 1 ? '/admin/update/admin/info/'.$adminDetails['admin_id'] : ''?>" method="POST" id="adminForm" class="form">
                <!-- PUT method -->
                <input type="hidden" name="_method" value="PUT">

            <!-- username -->
            <div class="username">
                <label for="username">User Name</label>
                <input type="text" placeholder="rynb_hir000" required name="username" id="username" <?= Session::get('admin')['admin_id'] != 1 ? 'disabled' : '' ?>
                    value="<?= isset($adminDetails) ? $adminDetails['username'] : (isset($flashOld['username']) ? $flashOld['username'] : '') ?>" />
            </div>

            <!-- admin email -->
            <div class="admin-email">
                <label for="email">Email Address</label>
                <input type="email" placeholder="normal-admin@gmail.com" required name="email" id="email" <?= Session::get('admin')['admin_id'] != 1 ? 'disabled' : '' ?>
                    value="<?= isset($adminDetails) ? $adminDetails['email'] : (isset($flashOld['email']) ? $flashOld['email'] : '') ?>" />
            </div>

            <?php if(Session::get('admin')['admin_id'] == 1): ?>
            <!-- save button -->
            <button type="submit" name="submitBtn">
                Save
            </button>
            <?php else: ?>
            <p class="form-info">
                Contact Boss Admin to edit your details.
            </p>
            <?php endif; ?>

        </form>
        <span id="password"></span>
    </div>
        <!-- change password content -->
        <div>
            <h2 class="form-heading">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M12.3212 10.6852L4 19L6 21M7 16L9 18M20 7.5C20 9.98528 17.9853 12 15.5 12C13.0147 12 11 9.98528 11 7.5C11 5.01472 13.0147 3 15.5 3C17.9853 3 20 5.01472 20 7.5Z"
                            stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </g>
                </svg>Change Password
            </h2>
            <p class="form-info">
                Change admin password below.
            </p>
            <!-- form for user name and about -->
            <form action="/admin/update/admin/password/<?= $adminDetails['admin_id'] ?>" method="post">

                <!-- PUT method  -->
                <input type="hidden" name="_method" value="PUT">

                <!-- new password -->
                <div class="newPassword sm:row-start-2">
                    <label for="newPassword">New
                        Password</label>
                    <input type="password" placeholder="••••••••" required name="newPassword" id="newPassword" />
                </div>

                <!-- confirm password -->
                <div class="confirmPassword sm:row-start-3">
                    <label for="confirmPassword">Confirm
                        Password</label>
                    <input type="password" placeholder="••••••••" required name="confirmPassword" id="confirmPassword" />
                </div>

                <!-- save button -->
                <button type="submit" name="submitBtn">
                    Save
                </button>
            </form>
        </div>
</div>
</main>

<?php
View::renderPartial('ToastNotification');

View::renderPartial('ConfirmModal');

View::renderPartial('EndOfHTMLDocument');

?>