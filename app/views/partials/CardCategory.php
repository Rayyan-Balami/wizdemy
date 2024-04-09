<!--card category note, question , labreport -->
<div class="card-category-wrapper">
    <div class="card-category">
        <!-- notes category  -->
        <input type="radio" value="note" id="noteCategory" name="category" hidden checked
            onchange="changeCategory('<?= $page ?>')">
        <label for="noteCategory" class="category-label">Notes</label>

        <!-- question category  -->
        <input type="radio" value="question" id="questionCategory" name="category" hidden
            onchange="changeCategory('<?= $page ?>')">
        <label for="questionCategory" class="category-label">Questions</label>

        <!-- labreport category  -->
        <input type="radio" value="labreport" id="labreportCategory" name="category" hidden
            onchange="changeCategory('<?= $page ?>')">
        <label for="labreportCategory" class="category-label">Lab Reports</label>

        <!-- my-reqestcheck checkbox  -->
        <?php if ($page === 'profile' || $page === 'search') : ?>
            <input type="checkbox" id="requestCheck" name="requestCheck" hidden>
            <label for="requestCheck" class="requestCheck-label">Requests</label>
        

        <!-- my-project radio  -->
        <input type="radio" value="project" id="projectsCategory" name="category" hidden
            onchange="<?= isset($page) ? ($page === 'profile' ? 'myProjects(\''.$page.'\')' :
            'searchProjects(\''.$page.'\')') : '' ?>">
        <label for="projectsCategory" class="category-label">Projects</label>

        <?php endif; ?>

        <!-- users category  -->
        <?php if ($page === 'search') : ?>
            <input type="radio" value="user" id="userCategory" name="category" hidden
                onchange="searchUsers('<?= $page ?>')">
            <label for="userCategory" class="category-label">Users</label>
        <?php endif; ?>
    </div>
</div>