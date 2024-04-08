const searchOverlay = document.querySelector('#searchOverlay');
const searchField = document.querySelector('#searchField');
const searchModal = document.querySelector('#searchModal');
const backBtnSearch = document.querySelector('#back-button-search');

function toggleSearchOverlay() {
  console.log('toggleSearchOverlay');

  if (!searchModal.contains(event.target)) {
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


function loadSearchHistory() {

  // Get the search history from local storage
  let searchHistory = localStorage.getItem('searchHistory');

  // If there is no search history, create an empty array
  if (!searchHistory) {
    searchHistory = [];
  } else {
    searchHistory = JSON.parse(searchHistory);
  }
  
}
