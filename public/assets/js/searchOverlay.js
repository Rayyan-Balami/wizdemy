const searchOverlay = document.querySelector('#searchOverlay');
const searchField = document.querySelector('#searchField');
const searchModal = document.querySelector('#searchModal');
const backBtnSearch = document.querySelector('#back-button-search');

let searchHistory = localStorage.getItem('searchHistory');
searchHistory = JSON.parse(searchHistory);

let searchList = [];

function toggleSearchOverlay() {
  console.log('toggleSearchOverlay');

  if (!searchModal.contains(event.target)) {
    renderSearchHistory();
    searchOverlay.classList.toggle('open');
    document.body.classList.toggle('menu-open');
    searchField.focus();
  }
}

function closeSearchOverlay() {
  searchOverlay.classList.remove('open');
  document.body.classList.remove('menu-open');
  searchField.blur(); // Remove focus from the search field if needed
}



function renderSearchHistory() {
  let searchList = '';
  if (searchHistory) {
    searchHistory.forEach((search) => {
      searchList += searchLi('history', search);
    });
    document.querySelector('#search-list').innerHTML = searchList;
  }
}
function renderSearchList() {
  document.querySelector('#search-list').innerHTML = searchList.join('');
}


searchField.addEventListener('keyup', async function (e) {
  searchList = [];
  if (searchField.value.length === 0) {
    renderSearchHistory();
    return;
  }

  // search history that matches the search field value
  const top4History = searchHistory.filter((search) => search.includes(searchField.value)).slice(0, 4);
  const result = await fetch(`/api/search?q=${searchField.value ?? ''}`);
  const { data } = await result.json();
  if (data.status !== 'error') {
    const { suggestions } = data;
    searchList.push(
      ...top4History.map((history) => searchLi('history', history))
    );
    searchList.push(
      ...suggestions.map((suggestion) => searchLi('search', suggestion))
    );

  } else {
    const { message } = data;
    searchList.push(
      ...top4History.map((history) => searchLi('history', history))
    );
    if (top4History.length === 0) {
      searchList.push(
        `<li>
        <a href="#" style="pointer-events: none; texa-align: center;">
        <p>${message}</p>
        </a>
      </li>`
      );
    }
  }
  renderSearchList();
});


function searchLi(type, text) {

  let svgHTML = '';
  let removeBtn = '';
  if (type == 'history') {
    svgHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
  <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
    <path
      d="M5.604 5.45a6.44 6.44 0 0 0-1.883 5.278a.5.5 0 0 1-.994.105a7.44 7.44 0 0 1 2.175-6.096c2.937-2.897 7.675-2.85 10.582.098c2.907 2.947 2.888 7.685-.05 10.582a7.425 7.425 0 0 1-5.097 2.142a7.527 7.527 0 0 1-2.14-.271a.5.5 0 0 1 .266-.964a6.524 6.524 0 0 0 1.856.235a6.424 6.424 0 0 0 4.413-1.854c2.541-2.506 2.562-6.61.04-9.168c-2.522-2.558-6.627-2.594-9.168-.088" />
    <path d="M3.594 11.363a.5.5 0 0 1-.706.04l-1.72-1.53a.5.5 0 1 1 .664-.746l1.72 1.53a.5.5 0 0 1 .042.706" />
    <path
      d="M2.82 11.3a.5.5 0 0 0 .7.1l2-1.5a.5.5 0 1 0-.6-.8l-2 1.5a.5.5 0 0 0-.1.7M10 6.5a.5.5 0 0 1 .5.5v3.5a.5.5 0 0 1-1 0V7a.5.5 0 0 1 .5-.5" />
    <path d="M13.5 10.5a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 .5.5" />
  </g>
</svg>`;
    removeBtn = `<button onclick="removeSearchHistory('${text}')">Remove</button>`;
  } else if (type == 'search') {
    svgHTML = ` <svg viewBox="0 0 24 24" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
  <g id="SVGRepo_iconCarrier">
    <path
      d="M16.6725 16.6412L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    </path>
  </g>
</svg>`;
  }

  return `<li>
<a href="/search?q=${text}">
  ${svgHTML}
  <p>${text}</p>
  </a>
  ${removeBtn}
</li>`;

}


function removeSearchHistory(text) {
  searchHistory = searchHistory.filter((search) => search !== text);
  localStorage.setItem('searchHistory', JSON.stringify(searchHistory));
  renderSearchHistory();
}