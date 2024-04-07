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


//add event listener in logout form to show confirm modal (id = logoutForm )

document.getElementById("logoutForm").addEventListener("submit", async (event) => {
  //prevent default form submission
  event.preventDefault();

  const confirmed = await openConfirmModal(
    'logout',
    `Do you want to logout ?`
  );

  // If user cancels the action, do nothing
  if (confirmed) {
    //remove prevent default
    document.getElementById("logoutForm").submit();
  }
});


//add event listener in delete account form to show confirm modal (id = deleteAccountForm )

function smallClientAlert(message) {
  const checkAlert = document.querySelector(".smallClientAlert");
  if (checkAlert) {
    checkAlert.remove();
  }

  const Alert = document.createElement("div");
  Alert.classList.add("smallClientAlert");
  Alert.innerHTML = message;
  document.body.appendChild(Alert);
  console.log(Alert);
  Alert.classList.add("show");
  setTimeout(() => {
    Alert.classList.remove("show");
    Alert.classList.add("hide");
    setTimeout(() => {
      Alert.remove();
    }, 500);
  }, 3000);
}

// smallClientAlert("This is a small alert message");