<!--card category note, question , labreport -->
<div class="card-category-wrapper">
    <div class="card-category">
        <!-- notes -->
        <button onclick="changeCategory('note',<?= Session::exists('user')?>)" class="category is-active-category bg-gray-300" id="note-category">
                        Notes
                    </button>
        <!-- question -->
        <button onclick="changeCategory('question',<?= Session::exists('user')?>)" class="category" id="question-category">
            Questions
        </button>
        <!-- labreport -->
        <button onclick="changeCategory('labreport',<?= Session::exists('user')?>)" class="category" id="labreport-category">
            Lab Reports
        </button>
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