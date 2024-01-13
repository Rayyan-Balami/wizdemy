const sideNav = document.querySelector("#side-nav");
const settingsDropdown = document.querySelector("#setting-dropdown");
const hamburger = document.querySelector("#hamburger");
const settingIcon = document.querySelector("#setting-icon");
const caretUpIcon = document.querySelector("#caret-up-icon");

const hamburgerSvg = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
<path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
    stroke-width="2.3" d="M4 5h16M4 12h16m-7 7h7" />
</svg>`;
const closeSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M20 20L4 4m16 0L4 20"/></svg>`;

function toggleSideNav() {
  // Toggle the side navigation
  sideNav.classList.toggle("open");
  // toggle the body.body.side-nav-open for width smaller than 640px
  document.body.classList.toggle("side-nav-open");
  // Change the hamburger icon to close icon

}


function toggleSettingsDropdown() {
  // Toggle the display of the settings dropdown
  settingsDropdown.classList.toggle("open");
  // Toggle the rotate class on the settings icon
  settingIcon.classList.toggle("rotate");
  // Toggle the rotate class on the caret up icon
  caretUpIcon.classList.toggle("rotate");
}



