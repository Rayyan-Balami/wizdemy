<main>
  <header>
    <h1 class="logo"><a href="/"><?= SITE_NAME ?></a></h1>

    <!-- search button , hamburger button  -->
    <div class="header-menu">
      
        <!-- username of admin -->
        <div class="h-links-wrapper">
          <span class="h-link">
            <?= Session::get('admin')['username'] ?>
          </span>
        </div>

      <!-- hamburger button for mobile -->
      <button id="hamburger" onclick="toggleSideNav()" class="hamburger-button">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3"
            d="M4 5h16M4 12h16m-7 7h7" />
        </svg>
      </button>
    </div>
  </header>
  