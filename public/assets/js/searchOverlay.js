const searchOverlay = document.getElementById("searchOverlay");
const searchField = document.getElementById("searchField");
const searchModal = document.querySelector("#searchModal");
const backBtnSearch = document.getElementById("back-button-search");
const searchForm = document.getElementById("search-bar-form");

let searchHistory = localStorage.getItem("searchHistory");
searchHistory = JSON.parse(searchHistory) || [];

let searchList = [];

function openSearchModal() {
  searchOverlay.classList.add("open");
  document.body.classList.toggle("menu-open");
  searchField.focus();
  renderSearchHistory();
}

//also open/close search model when clicked ctrl + k
document.addEventListener("keydown", function (e) {
  if (
    (e.ctrlKey && e.key === "k") ||
    (e.key === "/" && !searchOverlay.classList.contains("open"))
  ) {
    e.preventDefault(); // prevent the default behavior of the key press
    if (searchOverlay.classList.contains("open")) {
      searchOverlay.classList.remove("open");
      document.body.classList.toggle("menu-open");
    } else {
      openSearchModal();
    }
  }
});

searchOverlay.addEventListener("click", function (event) {
  if (event.target.id === "searchOverlay") {
    // Close the modal only if the overlay is clicked, not its children
    searchOverlay.classList.remove("open");
    document.body.classList.toggle("menu-open");
  }
});

// Prevent closing when clicking the remove button
backBtnSearch.addEventListener("click", function (event) {
  console.log("clicked");
  event.stopPropagation(); // Prevent the click event from bubbling up
  searchOverlay.classList.remove("open");
  document.body.classList.toggle("menu-open");
});

// Prevent closing when clicking the search input
searchField.addEventListener("click", function (event) {
  event.stopPropagation(); // Prevent the click event from bubbling up
});

function renderSearchHistory() {
  let historyItems = "";
  if (searchHistory.length > 0) {
    historyItems = searchHistory
      .map((history) => searchLi("history", history))
      .join("");
  } else {
    historyItems = `<li style="pointer-events: none; padding: 0.75rem 0.5rem/* 16px */;  text-align: center;  text-transform: uppercase;
    font-weight: 700;
    opacity: 0.7;"><p>Start Searching 🔍</p></li>`;
  }
  document.querySelector("#search-list").innerHTML = historyItems;
}

function renderSearchList() {
  document.querySelector("#search-list").innerHTML = searchList.join("");
  // Select all search suggestion links
  var searchLinks = document.querySelectorAll(".search-suggestion-link");
  console.log(searchLinks);
  // Add click event listener to each link
  searchLinks.forEach(function (link) {
    link.addEventListener("click", function (event) {
      // Prevent the default action
      event.preventDefault();

      // Get the search query from the link's href attribute
      var searchQuery = this.getAttribute("href").split("=")[1];

      // Store the search query in the history
      addSearchHistory(searchQuery);

      // Redirect to the search page
      window.location.href = this.getAttribute("href");
    });
  });
}

searchField.addEventListener("keyup", async function (e) {
  const inputValue = searchField.value.trim();
  searchList = [];

  if (inputValue.length === 0) {
    renderSearchHistory();
    return;
  }
  const top4History =
    searchHistory
      ?.filter((search) => search.includes(inputValue))
      .slice(0, 4) || [];
  const result = await fetch(`/api/search?q=${inputValue}`);
  // console.log(result.data);
  const { data } = await result.json();
  console.log(data);

  if (top4History.length > 0) {
    searchList.push(
      ...top4History.map((history) => searchLi("history", history))
    );
  }
  if (data.status !== "error") {
    const { suggestions } = data;
    // remove duplicates from suggestions that are already in the search history
    // searchList.push(...suggestions.map(suggestion => searchLi('search', suggestion)));
    searchList.push(
      ...suggestions?.map((suggestion) => {
        if (!searchHistory.includes(suggestion)) {
          return searchLi("search", suggestion);
        }
      })
    );
  } else {
    const { message } = data;
    if (top4History.length === 0) {
      searchList.push(
        ...top4History.map((history) => searchLi("history", history))
      );
    }
    if (message)
      searchList.push(`<li style="pointer-events: none; padding: 0.75rem 0.5rem/* 16px */;  text-align: center;  text-transform: uppercase;
  font-weight: 700;
  opacity: 0.7;"><p>${message}</p></li>`);
  }
  renderSearchList();
});

function addSearchHistory(text) {
  if (!searchHistory.includes(text)) {
    searchHistory.unshift(text);
    // if search history is more than 20 remove the last item
    if (searchHistory.length > 20) {
      searchHistory.pop();
    }
    localStorage.setItem("searchHistory", JSON.stringify(searchHistory));
  }
  renderSearchHistory();
}

function removeSearchHistory(text) {
  searchHistory = searchHistory.filter((search) => search !== text);
  localStorage.setItem("searchHistory", JSON.stringify(searchHistory));
  renderSearchHistory();
}

//when the search form is submitted add the search term to the search history
searchForm.addEventListener("submit", function (e) {
  e.preventDefault();
  const searchValue = searchField.value.trim();
  if (searchValue.length > 0) {
    addSearchHistory(searchValue);
    window.location.href = `/search?q=${searchValue}`;
  }
});

function searchLi(type, text) {
  let svgHTML = "";
  let removeBtn = "";
  if (type == "history") {
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
    removeBtn = `<button class="search-history-remove-btn" onclick="removeSearchHistory('${text}')">Remove</button>`;
  } else if (type == "search") {
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
<a  href="/search?q=${text}" class="search-suggestion-link">
  ${svgHTML}
  <p>${text}</p>
  </a>
  ${removeBtn}
</li>`;
}
