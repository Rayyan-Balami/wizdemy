const cards = document.querySelectorAll(".card");
const threeDotMenu = document.getElementById("three-dot-menu");
const threeDotMenuCopyLink = document.getElementById("copy-link");

function openThreeDotMenu(element) {
  const copyLink = element.getAttribute("data-copy-link");
  threeDotMenuCopyLink.setAttribute("data-copy-link", copyLink);
  threeDotMenu.classList.add("open");
  document.body.classList.add("menu-open");
}
function copyLink() {
  const link = threeDotMenuCopyLink.getAttribute("data-copy-link");
  navigator.clipboard.writeText(link).then(() => {
    console.log("Link copied to clipboard");
  });
}

function closeThreeDotMenu() {
  if (targetElement.matches('#particular-element')) {
    // If the clicked element is the particular element, do nothing
    return;
  }
  threeDotMenu.classList.remove("open");
  document.body.classList.remove("menu-open");
}