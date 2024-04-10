<!-- search overlay  -->
<div id="searchOverlay" class="">
  <div id="searchModal">
    <form id="search-bar-form" action="/search" method="GET">
      <button type="button" id="back-button-search">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path fill="currentColor"
            d="m7.825 13l4.9 4.9q.3.3.288.7t-.313.7q-.3.275-.7.288t-.7-.288l-6.6-6.6q-.15-.15-.213-.325T4.426 12q0-.2.063-.375T4.7 11.3l6.6-6.6q.275-.275.688-.275t.712.275q.3.3.3.713t-.3.712L7.825 11H19q.425 0 .713.288T20 12q0 .425-.288.713T19 13z" />
        </svg>
      </button>
      <input type="text" id="searchField" placeholder="Search&nbsp;&nbsp;🄲🅃🅁🄻 +  🄺" name="q" required autocomplete="off">
      <button id="search-button" type="submit">
        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <path
              d="M16.6725 16.6412L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            </path>
          </g>
        </svg>
      </button>
    </form>
    <ul id="search-list">
    </ul>
  </div>
</div>