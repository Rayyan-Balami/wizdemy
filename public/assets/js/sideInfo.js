async function toggleSideInfo(element) {
  const sideInfo = document.getElementById("sideInfo");
  sideInfo.classList.toggle("open");
  document.body.classList.toggle("sideInfo-open");
  const infoLink = element.getAttribute("data-info-link");
  const targetType = infoLink.split("/")[3];
  //add child to sideInfo <div class="spinner"></div>
  const spinner = document.createElement("div");
  spinner.className = "spinner";
  sideInfo.appendChild(spinner);

  try {
    const response = await fetch(infoLink);
    const { data, status } = await response.json();
    if (status === 200) {
      addInfoToSideInfo(data.data, targetType);
    }
  } catch (error) {
    console.error(error);
  }

  sideInfo.removeChild(spinner);
}

function addInfoToSideInfo(data, targetType) {
  const sideInfoInformationSection = document.querySelector(".info-section");
  const sideInfoDescriptionSection = document.querySelector(
    ".side-info-description"
  );
  sideInfoInformationSection.innerHTML = "";
  sideInfoDescriptionSection.innerHTML = "";

  const {
    username,
    created_at,
    updated_at,
    author,
    responded_to,
    repo_link,
    description,
  } = data;
  let infoText = infoLi("uploader", username, { label1: "Uploaded By" });

  if (targetType === "material") {
    infoText +=
      infoLi("author", author, {
        label1: "Author",
        label2: "Source",
        label3: "Credits",
      }) + infoLi("responded", responded_to, { label1: "Responded To" });
  }

  let createdAt = new Date(created_at);
  let updatedAt = new Date(updated_at);

  let options = { year: "numeric", month: "long", day: "numeric" };

  infoText += infoLi(
    "time",
    `Updated : ${updatedAt.toLocaleDateString(undefined, options)}`,
    { label1: `Created : ${createdAt.toLocaleDateString(undefined, options)}` }
  );
  sideInfoInformationSection.innerHTML = infoText;
  sideInfoDescriptionSection.innerHTML =
    targetType === "project" && repo_link
      ? `<a href="${repo_link}" target="_blank" class="repo-link">Visit GitHub Repo</a>`
      : `<p>${description}</p>`;
}

const infoTypeSvg = {
  uploader: `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 3.25A8.75 8.75 0 0 0 3.25 12A8.65 8.65 0 0 0 12 20.75a.75.75 0 0 0 0-1.5A7.17 7.17 0 0 1 4.75 12A7.26 7.26 0 0 1 12 4.75c4.81 0 7.25 2.44 7.25 7.25v1.38a1.46 1.46 0 1 1-2.91 0v-5a.75.75 0 0 0-1.5 0v.34A4.31 4.31 0 0 0 12 7.66a4.34 4.34 0 0 0 0 8.68a4.3 4.3 0 0 0 3.24-1.49a2.95 2.95 0 0 0 5.51-1.47V12c0-5.64-3.11-8.75-8.75-8.75m0 11.59A2.84 2.84 0 1 1 14.84 12A2.85 2.85 0 0 1 12 14.84"/></svg>`,
  author: ` <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
  <g id="SVGRepo_iconCarrier">
    <path d="M287.432 300.302C306.779 385.028 292.971 360.599 250.743 326.789" stroke="currentColor"
      stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
    </path>
    <path
      d="M94.828 70.3771C113.332 85.9691 176.677 40.604 186.268 43.0996C206.653 48.4 227.119 56.1071 247.838 61.4965C269.269 67.0723 296.33 67.1443 295.997 67.8392C294.169 71.6482 211.531 94.3032 189.318 98.9257C181.558 100.54 107.282 75.364 93 71.6482"
      stroke="currentColor" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
      stroke-linejoin="round"></path>
    <path d="M158 68.9995C53.7401 74.5448 80 78.9995 74 145" stroke="currentColor" stroke-opacity="0.9"
      stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
    </path>
    <path
      d="M120.922 84.9023C114.073 110.436 114.073 104.779 120.922 108.494C128.891 112.818 182.863 139.683 193.357 139.683C210.043 139.683 248.611 117.108 256.895 107.679"
      stroke="currentColor" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
      stroke-linejoin="round"></path>
    <path
      d="M254.527 195.65C243.826 307.409 100.913 269.227 118.063 178.545C111.711 169.636 99.9606 158.5 118.064 158.5"
      stroke="currentColor" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
      stroke-linejoin="round"></path>
    <path d="M202.342 217.653C191.302 226.163 177.423 229.779 167.993 217.653" stroke="currentColor"
      stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
    </path>
    <path d="M172.991 181.787C173.526 177.726 173.734 173.411 173.926 169.312" stroke="currentColor"
      stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
    </path>
    <path d="M205.545 181.787C206.547 177.575 206.945 173.572 206.945 169.312" stroke="currentColor"
      stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
    </path>
    <path d="M292.896 217.653C272.658 257.951 236.129 288.872 216.393 328.371" stroke="currentColor"
      stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
    </path>
    <path d="M307.729 214.535C328.431 219.263 318.55 236.092 302.265 227.927" stroke="currentColor"
      stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
    </path>
    <path d="M321 228.569C302.424 249.82 263.216 364.4 221.077 334.272" stroke="currentColor"
      stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
    </path>
    <path opacity="0.503384" d="M269.478 298.533C261.278 299.298 255.585 298.115 250.743 292.505"
      stroke="currentColor" stroke-opacity="0.9" stroke-width="14" stroke-linecap="round"
      stroke-linejoin="round"></path>
    <path
      d="M150.818 269.616C168.858 277.029 166.108 305.739 176.913 316.307C187.076 326.249 221.387 268.41 225.28 266.502C231.057 263.679 245.441 273.491 250.741 275.221"
      stroke="currentColor" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
      stroke-linejoin="round"></path>
    <path d="M152.381 270.673C127.565 277.279 85.1756 302.08 79 345.525" stroke="currentColor"
      stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
    </path>
    <path d="M261.425 169.128C280.874 167.251 266.987 186.589 257.165 192.391" stroke="currentColor"
      stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
    </path>
  </g>
</svg>`,
  responded: `<svg viewBox="0 0 24 24" style="padding:0.15rem;" fill="none" xmlns="http://www.w3.org/2000/svg">
  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
  <g id="SVGRepo_iconCarrier">
    <path
      d="M12.978 21.4554L13.6213 21.8409L12.978 21.4554ZM13.4659 20.6413L12.8226 20.2557L13.4659 20.6413ZM10.5341 20.6413L9.89077 21.0268H9.89077L10.5341 20.6413ZM11.022 21.4554L11.6653 21.0698L11.022 21.4554ZM3.34254 16.5893L4.03418 16.2992L4.03418 16.2992L3.34254 16.5893ZM8.21062 19.3254L8.19786 20.0752L8.21062 19.3254ZM5.77792 18.9946L5.49394 19.6888L5.49394 19.6888L5.77792 18.9946ZM20.6575 16.5893L21.3491 16.8794V16.8794L20.6575 16.5893ZM15.7893 19.3254L15.7766 18.5755L15.7893 19.3254ZM18.2221 18.9946L18.5061 19.6888L18.5061 19.6888L18.2221 18.9946ZM5.14876 4.87664L4.76041 4.23501V4.23501L5.14876 4.87664ZM3.66312 6.34395L3.02582 5.94854H3.02582L3.66312 6.34395ZM9.66251 19.5195L10.0361 18.8691L10.0361 18.8691L9.66251 19.5195ZM9.3023 4.97265C9.71651 4.97138 10.0513 4.63457 10.05 4.22036C10.0487 3.80615 9.71191 3.47139 9.2977 3.47266L9.3023 4.97265ZM21.7365 14.4642C21.7476 14.0501 21.4209 13.7055 21.0068 13.6944C20.5928 13.6833 20.2481 14.01 20.237 14.424L21.7365 14.4642ZM13.6213 21.8409L14.1092 21.0268L12.8226 20.2557L12.3347 21.0698L13.6213 21.8409ZM9.89077 21.0268L10.3787 21.8409L11.6653 21.0698L11.1774 20.2557L9.89077 21.0268ZM12.3347 21.0698C12.2671 21.1826 12.1458 21.2496 12 21.2496C11.8541 21.2496 11.7329 21.1826 11.6653 21.0698L10.3787 21.8409C11.1047 23.0525 12.8952 23.0525 13.6213 21.8409L12.3347 21.0698ZM3.75 12.6662V11.7773H2.25V12.6662H3.75ZM2.25 12.6662C2.25 13.6913 2.24958 14.4981 2.2946 15.1497C2.3401 15.8083 2.43455 16.3635 2.6509 16.8794L4.03418 16.2992C3.908 15.9984 3.83117 15.6274 3.79103 15.0464C3.75042 14.4584 3.75 13.712 3.75 12.6662H2.25ZM8.22338 18.5755C7.09333 18.5562 6.51282 18.4849 6.06191 18.3005L5.49394 19.6888C6.23158 19.9906 7.06826 20.056 8.19786 20.0752L8.22338 18.5755ZM2.6509 16.8794C3.18531 18.1536 4.20905 19.1631 5.49394 19.6888L6.06191 18.3005C5.14155 17.924 4.41322 17.203 4.03418 16.2992L2.6509 16.8794ZM15.8021 20.0752C16.9317 20.056 17.7684 19.9906 18.5061 19.6888L17.9381 18.3005C17.4872 18.4849 16.9067 18.5562 15.7766 18.5755L15.8021 20.0752ZM19.9658 16.2992C19.5868 17.203 18.8585 17.924 17.9381 18.3005L18.5061 19.6888C19.791 19.1631 20.8147 18.1536 21.3491 16.8794L19.9658 16.2992ZM3.75 11.7773C3.75 10.3078 3.75081 9.2589 3.82944 8.44214C3.90695 7.63695 4.05466 7.13546 4.30042 6.73937L3.02582 5.94854C2.60846 6.62121 2.42461 7.38153 2.33634 8.2984C2.24919 9.20371 2.25 10.3372 2.25 11.7773H3.75ZM4.76041 4.23501C4.05426 4.6624 3.45964 5.24935 3.02582 5.94854L4.30042 6.73937C4.6087 6.24249 5.03225 5.82383 5.5371 5.51827L4.76041 4.23501ZM11.1774 20.2557C10.9955 19.9522 10.8327 19.679 10.6738 19.4637C10.5054 19.2355 10.3094 19.0261 10.0361 18.8691L9.28893 20.1698C9.3196 20.1874 9.37008 20.2232 9.46688 20.3544C9.57318 20.4984 9.69425 20.6989 9.89077 21.0268L11.1774 20.2557ZM8.19786 20.0752C8.59427 20.082 8.841 20.0869 9.02805 20.1074C9.20155 20.1264 9.26024 20.1533 9.28893 20.1698L10.0361 18.8691C9.76085 18.711 9.47626 18.6475 9.19112 18.6163C8.91953 18.5866 8.59228 18.5817 8.22338 18.5755L8.19786 20.0752ZM14.1092 21.0268C14.3057 20.6989 14.4268 20.4984 14.5331 20.3544C14.6299 20.2232 14.6804 20.1874 14.711 20.1698L13.9639 18.8691C13.6906 19.0261 13.4945 19.2355 13.3261 19.4637C13.1672 19.679 13.0045 19.9522 12.8226 20.2557L14.1092 21.0268ZM15.7766 18.5755C15.4077 18.5817 15.0804 18.5866 14.8088 18.6163C14.5237 18.6475 14.2391 18.711 13.9639 18.8691L14.711 20.1698C14.7397 20.1533 14.7984 20.1264 14.9719 20.1074C15.159 20.0869 15.4057 20.082 15.8021 20.0752L15.7766 18.5755ZM9.2977 3.47266C7.0617 3.47951 5.93013 3.52705 4.76041 4.23501L5.5371 5.51827C6.29497 5.05958 6.99727 4.97972 9.3023 4.97265L9.2977 3.47266ZM20.237 14.424C20.2114 15.3801 20.1349 15.896 19.9658 16.2992L21.3491 16.8794C21.6333 16.2017 21.7102 15.4453 21.7365 14.4642L20.237 14.424Z"
      fill="#000"></path>
    <path
      d="M12 4.22224L11.473 3.68863C11.3303 3.82954 11.25 4.02172 11.25 4.22224C11.25 4.42277 11.3303 4.61494 11.473 4.75585L12 4.22224ZM20.25 11.7778C20.25 12.192 20.5858 12.5278 21 12.5278C21.4142 12.5278 21.75 12.192 21.75 11.7778H20.25ZM18.8512 4.87708L18.4629 5.51871L18.8512 4.87708ZM20.3369 6.34439L20.9742 5.94897V5.94897L20.3369 6.34439ZM14.777 2.53361C15.0717 2.24254 15.0747 1.76768 14.7836 1.47297C14.4925 1.17827 14.0177 1.17532 13.723 1.46639L14.777 2.53361ZM13.723 6.97809C14.0177 7.26916 14.4925 7.26622 14.7836 6.97151C15.0747 6.67681 15.0717 6.20194 14.777 5.91087L13.723 6.97809ZM12 4.97224C13.4807 4.97224 14.8952 4.97257 16.074 5.05235C16.6621 5.09215 17.1733 5.1507 17.5922 5.23404C18.0215 5.31946 18.3018 5.42118 18.4629 5.51871L19.2396 4.23545C18.8597 4.00551 18.3813 3.86165 17.8849 3.76288C17.378 3.66204 16.7964 3.59781 16.1753 3.55577C14.9354 3.47186 13.4654 3.47224 12 3.47224V4.97224ZM21.75 11.7778C21.75 10.3376 21.7508 9.20415 21.6637 8.29884C21.5754 7.38197 21.3915 6.62164 20.9742 5.94897L19.6996 6.7398C19.9453 7.1359 20.093 7.63739 20.1706 8.44258C20.2492 9.25933 20.25 10.3082 20.25 11.7778H21.75ZM18.4629 5.51871C18.9677 5.82427 19.3913 6.24293 19.6996 6.7398L20.9742 5.94897C20.5404 5.24979 19.9457 4.66284 19.2396 4.23545L18.4629 5.51871ZM12.527 4.75585L14.777 2.53361L13.723 1.46639L11.473 3.68863L12.527 4.75585ZM11.473 4.75585L13.723 6.97809L14.777 5.91087L12.527 3.68863L11.473 4.75585Z"
      fill="#000"></path>
  </g>
</svg>`,
  time: `<svg style="padding:0.15rem;" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"><path fill="currentColor" d="M8 15c-3.86 0-7-3.14-7-7s3.14-7 7-7s7 3.14 7 7s-3.14 7-7 7M8 2C4.69 2 2 4.69 2 8s2.69 6 6 6s6-2.69 6-6s-2.69-6-6-6"/><path fill="currentColor" d="M10 10.5c-.09 0-.18-.02-.26-.07l-2.5-1.5A.5.5 0 0 1 7 8.5v-4c0-.28.22-.5.5-.5s.5.22.5.5v3.72l2.26 1.35a.502.502 0 0 1-.26.93"/></svg>`,
};

function infoLi(type, text, label = {}) {
  return ` <li>
  <span>
    ${infoTypeSvg[type]}
  </span>
  <div>
    <h3>
      ${text ? text : "- - - - - - - -"}
    </h3>
    <div>
      ${label.label1 ? `<span>${label.label1}</span>` : ""}
      ${label.label2 ? `<span>${label.label2}</span>` : ""}
      ${label.label3 ? `<span>${label.label3}</span>` : ""}
    </div>
  </div>
</li>`;
}
