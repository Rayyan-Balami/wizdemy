<?php

View::renderPartial('Header', [
    'pageTitle' => SITE_NAME . ' | Account Security',
    'stylesheets' => [
        'settingForm'
    ],
    'scripts' => [
        'script',
        'searchOverlay',
        'notificationOverlay',
        'toastTimer'
    ]
]);

View::renderPartial('SideNav', [
    'currentPage' => 'accountSecurity',
]);

View::renderPartial('MenuHeader');

$flashOld = Session::get('old');

?>

<section>
    <!-- personal information title -->
    <div class="title-label">

        <div>
            <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                </g>
                <g id="SVGRepo_iconCarrier">
                    <path opacity="0.3"
                        d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z"
                        fill="currentColor"></path>
                    <path
                        d="M12.7504 10C12.7504 9.58579 12.4146 9.25 12.0004 9.25C11.5861 9.25 11.2504 9.58579 11.2504 10V10.7012L10.6429 10.3505C10.2842 10.1434 9.82553 10.2663 9.61842 10.625C9.41131 10.9837 9.53422 11.4424 9.89294 11.6495L10.4999 11.9999L9.8927 12.3505C9.53398 12.5576 9.41108 13.0163 9.61818 13.375C9.82529 13.7337 10.284 13.8566 10.6427 13.6495L11.2504 13.2987V14C11.2504 14.4142 11.5861 14.75 12.0004 14.75C12.4146 14.75 12.7504 14.4142 12.7504 14V13.2993L13.357 13.6495C13.7158 13.8566 14.1745 13.7337 14.3816 13.375C14.5887 13.0163 14.4658 12.5576 14.107 12.3505L13.4999 11.9999L14.1068 11.6495C14.4655 11.4424 14.5884 10.9837 14.3813 10.625C14.1742 10.2663 13.7155 10.1434 13.3568 10.3505L12.7504 10.7006V10Z"
                        fill="currentColor"></path>
                    <path
                        d="M6.73278 9.25C7.147 9.25 7.48278 9.58579 7.48278 10V10.7006L8.08923 10.3505C8.44795 10.1434 8.90664 10.2663 9.11375 10.625C9.32085 10.9837 9.19795 11.4424 8.83923 11.6495L8.23229 11.9999L8.83946 12.3505C9.19818 12.5576 9.32109 13.0163 9.11398 13.375C8.90687 13.7337 8.44818 13.8566 8.08946 13.6495L7.48278 13.2993V14C7.48278 14.4142 7.147 14.75 6.73278 14.75C6.31857 14.75 5.98278 14.4142 5.98278 14V13.2987L5.37513 13.6495C5.01641 13.8566 4.55771 13.7337 4.35061 13.375C4.1435 13.0163 4.26641 12.5576 4.62513 12.3505L5.23229 11.9999L4.62536 11.6495C4.26664 11.4424 4.14373 10.9837 4.35084 10.625C4.55795 10.2663 5.01664 10.1434 5.37536 10.3505L5.98278 10.7012V10C5.98278 9.58579 6.31857 9.25 6.73278 9.25Z"
                        fill="currentColor"></path>
                    <path
                        d="M18.0182 10C18.0182 9.58579 17.6824 9.25 17.2682 9.25C16.854 9.25 16.5182 9.58579 16.5182 10V10.7012L15.9108 10.3505C15.552 10.1434 15.0934 10.2663 14.8863 10.625C14.6791 10.9837 14.802 11.4424 15.1608 11.6495L15.7677 11.9999L15.1605 12.3505C14.8018 12.5576 14.6789 13.0163 14.886 13.375C15.0931 13.7337 15.5518 13.8566 15.9105 13.6495L16.5182 13.2987V14C16.5182 14.4142 16.854 14.75 17.2682 14.75C17.6824 14.75 18.0182 14.4142 18.0182 14V13.2993L18.6249 13.6495C18.9836 13.8566 19.4423 13.7337 19.6494 13.375C19.8565 13.0163 19.7336 12.5576 19.3749 12.3505L18.7677 11.9999L19.3746 11.6495C19.7334 11.4424 19.8563 10.9837 19.6492 10.625C19.442 10.2663 18.9834 10.1434 18.6246 10.3505L18.0182 10.7006V10Z"
                        fill="currentColor"></path>
                </g>
            </svg>
        </div>

        <h2 class="title">
            Password & Security
        </h2>

        <a href="t&c.html" class="message">
            Read our terms and conditions
        </a>
    </div>

    <!-- form section -->
    <div class="form-section">
        <!-- change password content -->
        <div>
            <h2 class="form-heading">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M12.3212 10.6852L4 19L6 21M7 16L9 18M20 7.5C20 9.98528 17.9853 12 15.5 12C13.0147 12 11 9.98528 11 7.5C11 5.01472 13.0147 3 15.5 3C17.9853 3 20 5.01472 20 7.5Z"
                            stroke="#000000" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </g>
                </svg>Change Password
            </h2>
            <p class="form-info">
                Ensure your account is using a long, random password to stay secure.
            </p>
            <!-- form for user name and about -->
            <form action="/accountSecurity/password" method="post">

                <!-- PUT method  -->
                <input type="hidden" name="_method" value="PUT">

                <!-- current password -->
                <div class="currentPassword">
                    <label for="currentPassword">Current
                        Password</label>
                    <input type="password" placeholder="••••••••" required name="currentPassword"
                        id="currentPassword" />
                </div>
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
                    <input type="password" placeholder="••••••••" required name="confirmPassword"
                        id="confirmPassword" />
                </div>

                <!-- save button -->
                <button type="submit" name="submit">
                    Save
                </button>
            </form>
        </div>

        <!--   checkboxes preferences content -->
        <div>
            <h2 class="form-heading">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                        <path
                            d="M6 9.256L24.009 4L42 9.256v10.778A26.316 26.316 0 0 1 24.003 45A26.32 26.32 0 0 1 6 20.029z" />
                        <path stroke-linecap="round" d="m15 23l7 7l12-12" />
                    </g>
                </svg>Security
            </h2>
            <p class="form-info">
                Manage your security settings and devices here.
            </p>
            <!-- form for checkboxes preferences -->
            <form action="/accountSecurity/preferences" method="post">

                <!-- PUT method  -->
                <input type="hidden" name="_method" value="PUT">

                <!-- private account -->
                <div class="privateAccount">
                    <?php
                    $checked = $user['private'] == 1 ? 'checked' : '';
                    ?>
                    <input type="checkbox" id="privateAccount" name="private" <?= $checked; ?> />
                    <label for="privateAccount">Private Account
                        <p>
                            Only you and followers can see your profile and materials.
                        </p>
                    </label>
                </div>

                <!-- allow email -->
                <div class="allow-email">
                    <?php
                    $checked = $user['allow_email'] == 1 ? 'checked' : '';
                    ?>
                    <input type="checkbox" id="allow_email" name="allow_email" <?= $checked; ?> />
                    <label for="allow_email">Allow Mail
                        <p>
                            Only your followers can send you an email.
                        </p>
                    </label>
                </div>

                <!-- allow phone -->
                <div class="allow-phone">
                    <?php
                    $checked = $user['allow_phone'] == 1 && $user['phone_number'] != null ? 'checked' : '';
                    ?>
                    <input type="checkbox" id="allow_phone" name="allow_phone" <?= $checked; ?> />
                    <label for="allow_phone">Allow WhatsApp
                        <p>
                            Only your followers can chat with you on WhatsApp.
                        </p>
                    </label>
                </div>

                <!-- save button -->
                <button type="submit" name="submit">
                    Save
                </button>
            </form>
        </div>

    </div>
</section>
</main>

<?php

View::renderPartial('SearchOverlay');

View::renderPartial('NotificationOverlay');

View::renderPartial('ToastNotification');

View::renderPartial('EndOfHTMLDocument');

?>