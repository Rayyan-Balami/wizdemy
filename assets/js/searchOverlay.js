const searchOverlay = document.querySelector('#searchOverlay');
const searchField = document.querySelector('#searchField');
const searchModal = document.querySelector('#searchModal');
const backBtn = document.querySelector('#back-button');

function toggleSearchOverlay() {

  if (!searchModal.contains(event.target)) {
    searchOverlay.classList.toggle('open');
    document.body.classList.toggle('menu-open');
    searchField.focus();
  }
}

function closeSearchOverlay(){
  searchOverlay.classList.remove('open');
  document.body.classList.remove('menu-open');
  searchField.blur(); // Remove focus from the search field if needed
}

// Add an event listener for the popstate event
window.addEventListener('popstate', function (event) {
  closeSearchOverlay();
});