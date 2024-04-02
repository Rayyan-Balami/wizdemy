const confirmModal = document.getElementById("confirm-modal");

const msgBox = confirmModal.querySelector("#msg-box");

const svgBox = confirmModal.querySelector("#svg-box");

const confirmButton = confirmModal.querySelector("#confirm-button");

const cancelButton = confirmModal.querySelector("#cancel-button");

function openConfirmModal(status, msg) {
  return new Promise((resolve, reject) => {
    confirmModal.setAttribute("data-modal-type", status);
    msgBox.innerHTML = msg;
    svgBox.innerHTML = svgCollection[status];
    confirmButton.querySelector("h3").innerHTML = status;
    confirmModal.classList.add("open");
    document.body.classList.add("menu-open");

    // Resolve or reject the Promise based on user action
    confirmButton.onclick = () => resolve(true);

    cancelButton.onclick = () => resolve(false);
  });
}
function closeConfirmModal() {
  confirmModal.setAttribute("data-modal-type", "default");
  confirmModal.classList.remove("open");
  document.body.classList.remove("menu-open");
}


const svgCollection = {
  suspend : `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M12 1c6.075 0 11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12S5.925 1 12 1M2.5 12a9.5 9.5 0 0 0 9.5 9.5a9.5 9.5 0 0 0 9.5-9.5A9.5 9.5 0 0 0 12 2.5A9.5 9.5 0 0 0 2.5 12m15.75.75H5.75a.75.75 0 0 1 0-1.5h12.5a.75.75 0 0 1 0 1.5"/></svg>`,

  active : `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" fill-opacity="0.25" d="M3 12a9 9 0 1 1 18 0a9 9 0 0 1-18 0"/><circle cx="12" cy="10" r="4" fill="currentColor"/><path fill="currentColor" fill-rule="evenodd" d="M18.22 18.246c.06.097.041.22-.04.297A8.969 8.969 0 0 1 12 21a8.969 8.969 0 0 1-6.18-2.457a.239.239 0 0 1-.04-.297C6.942 16.318 9.291 15 12 15c2.708 0 5.057 1.318 6.22 3.246" clip-rule="evenodd"/></svg>`,

  delete : `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
  <path fill="currentColor" fill-rule="evenodd"
    d="M10.31 2.25h3.38c.217 0 .406 0 .584.028a2.25 2.25 0 0 1 1.64 1.183c.084.16.143.339.212.544l.111.335a1.25 1.25 0 0 0 1.263.91h3a.75.75 0 0 1 0 1.5h-17a.75.75 0 0 1 0-1.5h3.09a1.25 1.25 0 0 0 1.173-.91l.112-.335c.068-.205.127-.384.21-.544a2.25 2.25 0 0 1 1.641-1.183c.178-.028.367-.028.583-.028m-1.302 3a2.757 2.757 0 0 0 .175-.428l.1-.3c.091-.273.112-.328.133-.368a.75.75 0 0 1 .547-.395a3.2 3.2 0 0 1 .392-.009h3.29c.288 0 .348.002.392.01a.75.75 0 0 1 .547.394c.021.04.042.095.133.369l.1.3l.039.112c.039.11.085.214.136.315z"
    clip-rule="evenodd" />
  <path fill="currentColor"
    d="M5.915 8.45a.75.75 0 1 0-1.497.1l.464 6.952c.085 1.282.154 2.318.316 3.132c.169.845.455 1.551 1.047 2.104c.591.554 1.315.793 2.17.904c.822.108 1.86.108 3.146.108h.879c1.285 0 2.324 0 3.146-.108c.854-.111 1.578-.35 2.17-.904c.591-.553.877-1.26 1.046-2.104c.162-.813.23-1.85.316-3.132l.464-6.952a.75.75 0 0 0-1.497-.1l-.46 6.9c-.09 1.347-.154 2.285-.294 2.99c-.137.685-.327 1.047-.6 1.303c-.274.256-.648.422-1.34.512c-.713.093-1.653.095-3.004.095h-.774c-1.35 0-2.29-.002-3.004-.095c-.692-.09-1.066-.256-1.34-.512c-.273-.256-.463-.618-.6-1.302c-.14-.706-.204-1.644-.294-2.992z" />
  <path fill="currentColor"
    d="M9.425 10.254a.75.75 0 0 1 .821.671l.5 5a.75.75 0 0 1-1.492.15l-.5-5a.75.75 0 0 1 .671-.821m5.15 0a.75.75 0 0 1 .671.82l-.5 5a.75.75 0 0 1-1.492-.149l.5-5a.75.75 0 0 1 .82-.671" />
</svg>`,

default : `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><g fill="currentColor"><path d="M224 128a96 96 0 1 1-96-96a96 96 0 0 1 96 96" opacity="0.2"/><path d="M140 180a12 12 0 1 1-12-12a12 12 0 0 1 12 12M128 72c-22.06 0-40 16.15-40 36v4a8 8 0 0 0 16 0v-4c0-11 10.77-20 24-20s24 9 24 20s-10.77 20-24 20a8 8 0 0 0-8 8v8a8 8 0 0 0 16 0v-.72c18.24-3.35 32-17.9 32-35.28c0-19.85-17.94-36-40-36m104 56A104 104 0 1 1 128 24a104.11 104.11 0 0 1 104 104m-16 0a88 88 0 1 0-88 88a88.1 88.1 0 0 0 88-88"/></g></svg>`
};
