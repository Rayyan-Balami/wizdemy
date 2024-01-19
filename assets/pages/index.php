<?php
req_once("assets/components/Header.php", ['page_title' => SITE_NAME, 'stylesheets' => ['styles'], 'scripts' => ['script', 'toast', 'threeDotMenu', 'sideInfo', 'searchOverlay','parseTimeAgo']]);
req_once("assets/components/SideNav.php", ['current_page' => 'index']);

$studyMaterials = getStudyMaterials();
?>

<main class="container">
    <?php req_once('assets/components/MenuHeader.php') ?>

    <section>
        <!-- card-section  -->
        <div class="card-section">
            <?php if ($studyMaterials['status']): ?>
                <?php foreach ($studyMaterials['data'] as $studyMaterial): ?>
                    <!-- card  -->
                    <?php req('assets/components/Card.php', ['studyMaterial' => $studyMaterial]) ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-data" >
                    <h1>No Data Found</h1>
                </div>
            <?php endif; ?>


        </div>

        <!-- footer -->
        <footer>
            <!-- show more button  -->
            <div class="show-more-section">
                <button class="show-more-button">Show More</button>
            </div>

            <!-- footer content  -->
            <div class="footer-content">
                <p>© Copyright 2021. All Rights Reserved.</p>

                <div>
                    <a href="t&c.html">Tearms & Conditions</a>・
                    <a href="#">Privacy</a>・
                    <a href="#">Cookies</a>
                </div>

                <div>
                    Developers : <a href="#">Rayyan Balami</a> &amp;
                    <a href="#">Satish Chaudhary</a>
                </div>
            </div>
        </footer>
    </section>
</main>

<?php
req_once("assets/components/SearchOverlay.php");
req_once("assets/components/SideInfo.php");
req_once("assets/components/ThreeDotMenu.php");
req_once("assets/components/SideNav.php");
req_once("assets/components/Footer.php");
?>