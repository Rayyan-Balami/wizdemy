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
        <?php if ($page === 'profile'): ?>
            <input type="checkbox" id="requestCheck" name="requestCheck" hidden>
            <label for="requestCheck" class="requestCheck-label">Requests</label>
        <?php endif; ?>
    </div>
    <!-- search icon -->
    <button class="search-button">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path
                    d="M16.6725 16.6412L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </g>
        </svg>
        Search
    </button>
</div>