//website config
const SITE_NAME = "WizDemy";
const SITE_DOMAIN = "http://localhost:8000";

function RequestCard(
  page,
  request_id,
  user_id,
  title,
  subject,
  description,
  education_level,
  class_faculty,
  semester,
  no_of_materials,
  document_type,
  username,
  created_at,
  status
) {
  let semesterHTML = "";
  let suspendRespondHTML = "";

  if (status == "suspend") {
    suspendRespondHTML = `<div class="suspended-request">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="1.7">
          <path stroke-linecap="round" d="M16 12H8" />
          <circle cx="12" cy="12" r="10" />
        </g>
      </svg> Suspended
    </div>`;
  } else {
    suspendRespondHTML = `<form action="/material/respond/${request_id}" method="post">
    <!-- respond button  -->
    <button type="submit" class="respond-button">
        <span>Respond</span>
        <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none'
            stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
            <path d='M5 12h13M12 5l7 7-7 7' />
        </svg>
    </button>
    </form>`;
  }

  if (semester) {
    semesterHTML = `<span title="Semester"># ${semester} Sem</span>`;
  }
  if (document_type === "labreport") {
    document_type = "lab report";
  }
  return `<div class="request-card" ${page == "profile" ? `id="card-${request_id}"` : ""
    }>
  <!-- subject -->
  <p class="subject">${subject}</p>
  <!-- title  -->
  <h2 class="title">${title}</h2>
  <!-- request- -->
  <p class="request-details">${description}</p>
  <!-- educationLevel  -->
  <div class="educationLevel">
          <span title="Education Level"># ${education_level}</span>
          <span title="Class/Faculty"># ${class_faculty}</span>
            ${semesterHTML}
  </div>
  <!-- responses  -->
  <div class="no-of-responses">
      <p>Responses</p><span>${no_of_materials}</span>
  </div>
  <!-- document need ( notes, lab reports, question)  -->
  <div class="document-type-needed">
      <p>Document Need</p><span>${document_type}</span>
  </div>
  <!-- username  -->
  <a href="${page == "profile" ? "#" : `/profile/${user_id}`}" class="username">
      <!-- at icon @  -->
      <svg xmlns="http://www.w3.org/2000/svg" height="14" width="14" fill="currentColor" style="flex-shrink: 0"
          viewBox="0 0 512 512">
          <path
              d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256v32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32v80 32c0 17.7 14.3 32 32 32s32-14.3 32-32V256c0-106-86-192-192-192zm64 192a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z">
          </path>
      </svg>
      <!-- username  -->
      <h3>${username}</h3>
  </a>

  <!-- time  -->
  <div class="time">
      <p><a href="${page == "profile" ? "#" : `/profile/${user_id}`
    }" class="time-ago" data-datetime="${created_at}"></a>
    </a></p>
      <!-- three dot icon -->
      <button class="three-dot-icon" onclick="openThreeDotMenu(this)"
      ${page == "profile"
      ? `
      data-card-id="${request_id}"
      data-edit-link="/request/edit/${request_id}"
      data-delete-link="/api/request/delete/${request_id}"
      `
      : ""
    }
      data-copy-link="${SITE_DOMAIN}/request/${request_id}"
      >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 5 24">
              <path fill="#000"
                  d="M5.217 12a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0m0-9.392a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0m0 18.783a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0" />
          </svg>
      </button>
  </div>

  <!-- respond button, see details  -->
            <div class="button-wrapper">
                <!-- see details -->
                <button type="button" onclick="toggleSideInfo()" class="see-details-button">
                    • <span>See Details</span>
                </button>
                ${suspendRespondHTML}
            </div>
</div>`;
}

function MaterialCard(
  page,
  class_faculty,
  comments_count,
  created_at,
  document_type,
  education_level,
  file_path,
  format,
  likes_count,
  material_id,
  responded_to,
  semester,
  subject,
  thumbnail_path,
  title,
  user_id,
  updated_at,
  username,
  views_count,
  status
) {
  let respondedTo = "";
  let suspendHTML = "";
  let formatHTML = "";

  if (status == "suspend") {
    suspendHTML = `<div class="suspended-svg">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="1.7">
          <path stroke-linecap="round" d="M16 12H8" />
          <circle cx="12" cy="12" r="10" />
        </g>
      </svg> Suspended
    </div>`;
  }
  if (responded_to) {
    respondedTo = ` <!-- is responded post to request ?  -->
    <div class="request-responded-post">
      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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
      </svg>
    </div>`;
  }
  handwriten = `<!-- handwritten svg  -->
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      fill="currentColor" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
      <g id="SVGRepo_iconCarrier">
        <path d="M8.78355 21.9999C7.09836 21.2478 5.70641 20.0758 4.7915 18.5068" stroke="currentColor"
          stroke-width="1.5" stroke-linecap="round"></path>
        <path d="M14.8252 2.18595C16.5021 1.70882 18.2333 2.16305 19.4417 3.39724" stroke="currentColor"
          stroke-width="1.5" stroke-linecap="round"></path>
        <path
          d="M4.0106 8.36655L3.63846 7.71539L4.0106 8.36655ZM6.50218 8.86743L7.15007 8.48962L6.50218 8.86743ZM3.2028 10.7531L2.55491 11.1309H2.55491L3.2028 10.7531ZM7.69685 3.37253L8.34474 2.99472V2.99472L7.69685 3.37253ZM8.53873 4.81624L7.89085 5.19405L8.53873 4.81624ZM10.4165 9.52517C10.6252 9.88299 11.0844 10.0039 11.4422 9.79524C11.8 9.58659 11.9209 9.12736 11.7123 8.76955L10.4165 9.52517ZM7.53806 12.1327C7.74672 12.4905 8.20594 12.6114 8.56376 12.4027C8.92158 12.1941 9.0425 11.7349 8.83384 11.377L7.53806 12.1327ZM4.39747 5.25817L3.74958 5.63598L4.39747 5.25817ZM11.8381 2.9306L12.486 2.55279V2.55279L11.8381 2.9306ZM14.3638 7.26172L15.0117 6.88391L14.3638 7.26172ZM16.0475 10.1491L16.4197 10.8003C16.5934 10.701 16.7202 10.5365 16.772 10.3433C16.8238 10.15 16.7962 9.94413 16.6954 9.77132L16.0475 10.1491ZM17.6632 5.37608L17.0153 5.75389L17.6632 5.37608ZM20.1888 9.7072L20.8367 9.32939V9.32939L20.1888 9.7072ZM6.99128 17.2497L7.63917 16.8719L6.99128 17.2497ZM16.9576 19.2533L16.5854 18.6021L16.9576 19.2533ZM13.784 15.3C13.9927 15.6578 14.4519 15.7787 14.8097 15.5701C15.1676 15.3614 15.2885 14.9022 15.0798 14.5444L13.784 15.3ZM4.38275 9.0177C5.01642 8.65555 5.64023 8.87817 5.85429 9.24524L7.15007 8.48962C6.4342 7.26202 4.82698 7.03613 3.63846 7.71539L4.38275 9.0177ZM3.63846 7.71539C2.44761 8.39597 1.83532 9.8969 2.55491 11.1309L3.85068 10.3753C3.64035 10.0146 3.75139 9.37853 4.38275 9.0177L3.63846 7.71539ZM7.04896 3.75034L7.89085 5.19405L9.18662 4.43843L8.34474 2.99472L7.04896 3.75034ZM7.89085 5.19405L10.4165 9.52517L11.7123 8.76955L9.18662 4.43843L7.89085 5.19405ZM8.83384 11.377L7.15007 8.48962L5.85429 9.24524L7.53806 12.1327L8.83384 11.377ZM7.15007 8.48962L5.04535 4.88036L3.74958 5.63598L5.85429 9.24524L7.15007 8.48962ZM5.57742 3.5228C6.21109 3.16065 6.8349 3.38327 7.04896 3.75034L8.34474 2.99472C7.62887 1.76712 6.02165 1.54123 4.83313 2.22048L5.57742 3.5228ZM4.83313 2.22048C3.64228 2.90107 3.02999 4.40199 3.74958 5.63598L5.04535 4.88036C4.83502 4.51967 4.94606 3.88363 5.57742 3.5228L4.83313 2.22048ZM11.1902 3.30841L13.7159 7.63953L15.0117 6.88391L12.486 2.55279L11.1902 3.30841ZM13.7159 7.63953L15.3997 10.5269L16.6954 9.77132L15.0117 6.88391L13.7159 7.63953ZM9.71869 3.08087C10.3524 2.71872 10.9762 2.94134 11.1902 3.30841L12.486 2.55279C11.7701 1.32519 10.1629 1.0993 8.9744 1.77855L9.71869 3.08087ZM8.9744 1.77855C7.78355 2.45914 7.17126 3.96006 7.89085 5.19405L9.18662 4.43843C8.97629 4.07774 9.08733 3.4417 9.71869 3.08087L8.9744 1.77855ZM17.0153 5.75389L19.5409 10.085L20.8367 9.32939L18.311 4.99827L17.0153 5.75389ZM15.5437 5.52635C16.1774 5.1642 16.8012 5.38682 17.0153 5.75389L18.311 4.99827C17.5952 3.77068 15.988 3.54478 14.7994 4.22404L15.5437 5.52635ZM14.7994 4.22404C13.6086 4.90462 12.9963 6.40555 13.7159 7.63953L15.0117 6.88391C14.8013 6.52322 14.9124 5.88718 15.5437 5.52635L14.7994 4.22404ZM2.55491 11.1309L6.34339 17.6276L7.63917 16.8719L3.85068 10.3753L2.55491 11.1309ZM16.5854 18.6021C13.2185 20.5264 9.24811 19.631 7.63917 16.8719L6.34339 17.6276C8.45414 21.2472 13.4079 22.1458 17.3297 19.9045L16.5854 18.6021ZM19.5409 10.085C21.1461 12.8377 19.9501 16.6792 16.5854 18.6021L17.3297 19.9045C21.2539 17.6618 22.9512 12.9554 20.8367 9.32939L19.5409 10.085ZM15.0798 14.5444C14.4045 13.3863 14.8772 11.6818 16.4197 10.8003L15.6754 9.49797C13.5735 10.6993 12.5995 13.2687 13.784 15.3L15.0798 14.5444Z"
          fill="#000"></path>
      </g>
    </svg>`;
  typed = `<!-- typed svg  -->
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
      <g id="SVGRepo_iconCarrier">
        <path
          d="M12 3H8C6.11438 3 5.17157 3 4.58579 3.58579C4 4.17157 4 5.11438 4 7V7.95M12 3H16C17.8856 3 18.8284 3 19.4142 3.58579C20 4.17157 20 5.11438 20 7V7.95M12 3V21"
          stroke="#1C274C" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M7 21H17" stroke="#1C274C" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
        </path>
      </g>
    </svg>`;
  photo = `<!-- photo svg  -->
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
      <g id="SVGRepo_iconCarrier">
        <path
          d="M8 11C9.10457 11 10 10.1046 10 9C10 7.89543 9.10457 7 8 7C6.89543 7 6 7.89543 6 9C6 10.1046 6.89543 11 8 11Z"
          stroke="#000000" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M6.56055 21C12.1305 8.89998 16.7605 6.77998 22.0005 14.63" stroke="#000000" stroke-width="1.7"
          stroke-linecap="round" stroke-linejoin="round"></path>
        <path
          d="M18 3H6C3.79086 3 2 4.79086 2 7V17C2 19.2091 3.79086 21 6 21H18C20.2091 21 22 19.2091 22 17V7C22 4.79086 20.2091 3 18 3Z"
          stroke="#000000" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
      </g>
    </svg>`;
  if (format == "handwritten") {
    formatHTML = handwriten;
  } else if (format == "typed") {
    formatHTML = typed;
  } else if (format == "photo") {
    formatHTML = photo;
  }

  return `<div class="card " ${page == "profile" ? `id="card-${material_id}"` : ""
    }>
  <!-- image -->
  <a href="/material/view/${material_id}" class="thumbnail">
    <img src="/${thumbnail_path}" alt="thumbnail" />

    <div>
    <!-- status -->
      ${suspendHTML}
      <!-- responded to -->
      ${respondedTo}
      <!-- document format (handwritten, typed, photo) -->
      <div class="document-format">
        ${formatHTML}
      </div>
    </div>
  </a>

  <!-- subject  -->
  <a href="/material/view/${material_id}">
    <p class="subject">
    ${subject} • 
    ${education_level} • 
    ${class_faculty}
    ${semester != "" ? " • " + semester + " sem" : ""}
    </p>
    <!-- title  -->
    <h2 class="title">${title}</h2>
  </a>

  <!-- username  -->
  <a href="${page == "profile" ? "#" : `/profile/${user_id}`}" class="username">
    <!-- at icon @  -->
    <svg xmlns="http://www.w3.org/2000/svg" height="14" width="14" fill="currentColor" style="flex-shrink: 0"
      viewBox="0 0 512 512">
      <path
        d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256v32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32v80 32c0 17.7 14.3 32 32 32s32-14.3 32-32V256c0-106-86-192-192-192zm64 192a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z">
      </path>
    </svg>
    <!-- username  -->
    <h3>${username}</h3>
  </a>

  <!-- time  -->
  <div class="time">
    <p><a href="${page == "profile" ? "#" : `/profile/${user_id}`
    }" class="time-ago" data-datetime="${created_at}"></a></p>
    <!-- three dot icon -->
    <button class="three-dot-icon" onclick="openThreeDotMenu(this)"
    ${page == "profile"
      ? `
    data-card-id="${material_id}"
    data-edit-link="/material/edit/${material_id}"
    data-delete-link="/api/material/delete/${material_id}"
    `
      : ""
    }
    data-copy-link="${SITE_DOMAIN}/material/view/${material_id}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 5 24">
        <path fill="#000"
          d="M5.217 12a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0m0-9.392a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0m0 18.783a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0" />
      </svg>
    </button>
  </div>

  <!-- intercation -->
  <a href="/material/view/${material_id}" class="intercation">
    <!-- views  -->
    <div class="view">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
        </path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
        </path>
      </svg>
      <span>${views_count}</span>
    </div>
    <!-- comments -->
    <div class="comment">
      <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
          <path d="M7 7H15" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
          <path d="M7 11H11" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          </path>
          <path
            d="M19 3H5C3.89543 3 3 3.89543 3 5V15C3 16.1046 3.89543 17 5 17H8L11.6464 20.6464C11.8417 20.8417 12.1583 20.8417 12.3536 20.6464L16 17H19C20.1046 17 21 16.1046 21 15V5C21 3.89543 20.1046 3 19 3Z"
            stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </g>
      </svg>
      <span>${comments_count}</span>
    </div>
    <!-- likes -->
    <div class="like">
      <svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256">
        <path fill="currentColor"
          d="M178 28c-20.09 0-37.92 7.93-50 21.56C115.92 35.93 98.09 28 78 28a66.08 66.08 0 0 0-66 66c0 72.34 105.81 130.14 110.31 132.57a12 12 0 0 0 11.38 0C138.19 224.14 244 166.34 244 94a66.08 66.08 0 0 0-66-66m-5.49 142.36a328.69 328.69 0 0 1-44.51 31.8a328.69 328.69 0 0 1-44.51-31.8C61.82 151.77 36 123.42 36 94a42 42 0 0 1 42-42c17.8 0 32.7 9.4 38.89 24.54a12 12 0 0 0 22.22 0C145.3 61.4 160.2 52 178 52a42 42 0 0 1 42 42c0 29.42-25.82 57.77-47.49 76.36" />
      </svg>
      <span>${likes_count}</span>
    </div>
  </a>
</div>`;
}

function ProjectCard(
  page,
  project_id,
  repo_link,
  user_id,
  username,
  created_at,
  updated_at,
  status
) {
  let suspendHTML = "";

  if (status == "suspend") {
    suspendHTML = `
    <div>
    <div class="suspended-svg">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-width="1.7">
          <path stroke-linecap="round" d="M16 12H8" />
          <circle cx="12" cy="12" r="10" />
        </g>
      </svg> Suspended
    </div>
    </div>`;
  }
  // console.log(page, project_id, repo_link, user_id, username, created_at);
  let repo_info = repo_link.replace("https://github.com/", "");
  return ` <!--project card  -->
  <div class="card project-card" ${page == "profile" ? `id="card-${project_id}"` : ""
    }>
    <!-- image -->
    <a href="${repo_link}" target="_blank" class="thumbnail">
      <img src="https://opengraph.githubassets.com/wizdemy/${repo_info}" alt="github repo thumbnail">
      ${suspendHTML}
    </a>
    <!-- username  -->
    <a href="${page == "profile" ? "#" : `/profile/'.${user_id}'`
    }" class="username">
      <!-- at icon @  -->
      <svg xmlns="http://www.w3.org/2000/svg" height="14" width="14" fill="currentColor" style="flex-shrink: 0"
        viewBox="0 0 512 512">
        <path
          d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256v32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32v80 32c0 17.7 14.3 32 32 32s32-14.3 32-32V256c0-106-86-192-192-192zm64 192a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z">
        </path>
      </svg>
      <!-- username  -->
      <h3>
        ${username}
      </h3>
    </a>
    <!-- time  -->
    <div class="time">
      <p><a href="${page == "profile" ? "#" : `/profile/${user_id}`
    }" class="time-ago"
          data-datetime="${created_at}"></a></p>
      <!-- three dot icon -->
      <button class="three-dot-icon" onclick="openThreeDotMenu(this)"
      ${page == "profile"
      ? `
      data-card-id="${project_id}"
      data-edit-link="/project/edit/${project_id}"
      data-delete-link="/api/project/delete/${project_id}"
      `
      : ""
    }
    data-copy-link="${repo_link}">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 5 24">
        <path fill="#000"
          d="M5.217 12a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0m0-9.392a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0m0 18.783a2.608 2.608 0 1 1-5.216 0a2.608 2.608 0 0 1 5.216 0" />
      </svg>
    </button>
    </div>
  </div>`;
}

function ZeroResult(type) {
  let message = {
    default: "No Results Found",
    myMaterial: "Ouch! No Uploads",
    ghostProfile: "Looking for a Ghost?",
    search: "No Matches Found",
    myRequest: "No Requests Made",
    myProject: "No Repos Linked",
  };

  // Extract user_id from the URL to see if its other user's profile
  const urlParams = new URLSearchParams(window.location.search);
  const user_id = urlParams.get("id");

  continueWith = `<div class="continue-with">
        <h3 class="">
          Continue With
        </h3>
    
        <ul class="menu-list">
    
          <!-- upload form link -->
          <li>
            <a href="/material/create">
              <span>
              <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path opacity="0.4"
                    d="M11.9993 2C16.7133 2 19.0704 2 20.5348 3.46447C21.2923 4.22195 21.658 5.21824 21.8345 6.65598V10H2.16406V6.65598C2.3406 5.21824 2.70628 4.22195 3.46377 3.46447C4.92823 2 7.28525 2 11.9993 2Z"
                    fill="currentColor"></path>
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M2 14C2 11.1997 2 9.79961 2.54497 8.73005C3.02433 7.78924 3.78924 7.02433 4.73005 6.54497C5.79961 6 7.19974 6 10 6H14C16.8003 6 18.2004 6 19.27 6.54497C20.2108 7.02433 20.9757 7.78924 21.455 8.73005C22 9.79961 22 11.1997 22 14C22 16.8003 22 18.2004 21.455 19.27C20.9757 20.2108 20.2108 20.9757 19.27 21.455C18.2004 22 16.8003 22 14 22H10C7.19974 22 5.79961 22 4.73005 21.455C3.78924 20.9757 3.02433 20.2108 2.54497 19.27C2 18.2004 2 16.8003 2 14ZM12.5303 10.4697C12.3897 10.329 12.1989 10.25 12 10.25C11.8011 10.25 11.6103 10.329 11.4697 10.4697L8.96967 12.9697C8.67678 13.2626 8.67678 13.7374 8.96967 14.0303C9.26256 14.3232 9.73744 14.3232 10.0303 14.0303L11.25 12.8107V17C11.25 17.4142 11.5858 17.75 12 17.75C12.4142 17.75 12.75 17.4142 12.75 17V12.8107L13.9697 14.0303C14.2626 14.3232 14.7374 14.3232 15.0303 14.0303C15.3232 13.7374 15.3232 13.2626 15.0303 12.9697L12.5303 10.4697Z"
                    fill="currentColor"></path>
                </g>
              </svg>
              </span>
              <div>
                <h3>Upload</h3>
                <div>
                  <span>Contribute in
                    <?= SITE_NAME ?> community
                  </span>
                </div>
              </div>
            </a>
          </li>
          <!-- request form link -->
          <li>
            <a href="/request/create">
              <span>
              <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path
                    d="M12.9839 22.4946L13.521 21.5879C13.9375 20.8846 14.1458 20.5329 14.4804 20.3384C14.815 20.144 15.2362 20.1367 16.0786 20.1222C17.3224 20.1008 18.1024 20.0247 18.7566 19.7539C19.9704 19.2515 20.9348 18.2878 21.4375 17.0748C21.6226 16.6283 21.7169 16.123 21.7648 15.4515C21.7903 15.0958 21.803 14.9179 21.708 14.7756C21.6131 14.6332 21.4329 14.5728 21.0723 14.452C19.5606 13.9454 16.0584 12.6565 14.1 11.0008C11.8925 9.13444 9.91782 5.3404 9.21118 3.88615C9.0707 3.59705 9.00047 3.4525 8.87715 3.37622C8.75383 3.29994 8.59743 3.30159 8.28463 3.3049C6.25036 3.32638 5.32915 3.43899 4.36537 4.02919C3.69883 4.43737 3.13843 4.9974 2.72997 5.66349C2 6.85388 2 8.47432 2 11.7152V12.7053C2 15.0118 2 16.1651 2.37707 17.0748C2.87984 18.2878 3.84419 19.2515 5.05797 19.7539C5.71215 20.0247 6.49219 20.1008 7.73591 20.1222C8.57837 20.1367 8.9996 20.144 9.33417 20.3384C9.66874 20.5329 9.87702 20.8846 10.2936 21.5879L10.8307 22.4946C11.3094 23.3028 12.5052 23.3028 12.9839 22.4946Z"
                    fill="currentColor"></path>
                  <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                    d="M14.8719 0.239228C15.2073 0.55542 15.2039 1.06491 14.8643 1.3772L13.7622 2.39066C14.721 2.39968 15.6433 2.42144 16.4756 2.47388C17.1913 2.51898 17.8616 2.5879 18.4457 2.69609C19.0178 2.80206 19.569 2.95641 20.0069 3.20311C20.8206 3.66166 21.5058 4.29141 22.0058 5.04157C22.4867 5.76328 22.6986 6.57904 22.8003 7.56276C22.8998 8.52518 22.8998 9.72792 22.8998 11.253V11.2953C22.8998 11.7397 22.5129 12.1 22.0355 12.1C21.5582 12.1 21.1712 11.7397 21.1712 11.2953C21.1712 9.7186 21.1703 8.59328 21.0797 7.71697C20.9904 6.85308 20.8201 6.31502 20.5369 5.89005C20.1817 5.35695 19.6936 4.90776 19.1118 4.57993C18.9261 4.47529 18.6031 4.36615 18.1084 4.27451C17.6257 4.18509 17.0367 4.12228 16.3589 4.07957C15.5758 4.03023 14.7025 4.00921 13.7763 4.00026L14.8643 5.00068C15.2039 5.31298 15.2073 5.82246 14.8719 6.13865C14.5364 6.45485 13.9892 6.45801 13.6496 6.14572L11.0568 3.76146C10.8923 3.61027 10.7998 3.40409 10.7998 3.18894C10.7998 2.97379 10.8923 2.76761 11.0568 2.61642L13.6496 0.232165C13.9892 -0.0801259 14.5364 -0.0769636 14.8719 0.239228Z"
                    fill="currentColor"></path>
                </g>
              </svg>
              </span>
              <div>
                <h3>Request</h3>
                <div>
                  <span>Notes, lab reports, questions</span>
                </div>
              </div>
            </a>
          </li>
        </ul>
      </div>`;

  myMaterialSvg = `<svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
  <g id="SVGRepo_iconCarrier">
    <path
      d="M176.997 244.998C166.917 256.975 162.876 268.785 164.875 280.431C167.873 297.898 182.386 323.2 203.839 317.939C225.293 312.678 259.938 291.273 233.121 244.998"
      stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
    </path>
    <path d="M214.541 276.105C214.633 272.355 214.562 273.354 214.562 269.669" stroke="#000000"
      stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
    <path d="M194.184 276.105C194.184 273.96 194.184 271.814 194.184 269.669" stroke="#000000"
      stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
    <path d="M203.838 293.268C203.838 295.348 203.838 299.675 203.838 300.817" stroke="#000000"
      stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
    <path
      d="M144.933 266.446C142.529 277.579 143.178 285.299 146.88 289.607C152.432 296.068 121.779 354.706 121.779 357.016C121.779 359.326 162.553 339.367 165.809 336.296C169.065 333.224 190.661 340.283 207.172 339.21C223.683 338.137 239.165 331.051 243.163 331.051C247.161 331.051 276.993 352.011 278.315 353.21C279.637 354.409 264.96 288.114 260.63 284.523C256.301 280.931 265.83 267.518 263.036 263.232"
      stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
    </path>
    <path opacity="0.503384"
      d="M186.163 160.13C169.151 166.114 153.774 160.036 144.551 153.547C141.069 151.097 122.337 172.472 107.1 153.547C82.8435 123.42 117.262 77.4495 154.954 77.4495C162.796 77.4495 164.984 45.9185 199.34 42.3311C238.731 38.2179 240.427 73.7911 245.808 73.7911C249.66 73.7911 269.015 56.5109 288.065 74.7816C328.285 113.356 268.369 130.564 268.693 131.594C270.689 137.908 288.78 133.693 291.58 144.034C298.859 170.908 242.315 162.622 231.242 154.278"
      stroke="#000000" stroke-opacity="0.9" stroke-width="14" stroke-linecap="round" stroke-linejoin="round">
    </path>
    <path opacity="0.503384" d="M195.694 175.227C197.897 189.779 193.254 224.238 192.051 226.637" stroke="#000000"
      stroke-opacity="0.9" stroke-width="14" stroke-linecap="round" stroke-linejoin="round"></path>
    <path opacity="0.503384" d="M220.133 172.472C215.721 191.104 220.75 210.21 220.75 228.473" stroke="#000000"
      stroke-opacity="0.9" stroke-width="14" stroke-linecap="round" stroke-linejoin="round"></path>
    <path opacity="0.503384" d="M234.29 181.441C331.937 207.711 69.7553 214.031 181.698 183.326" stroke="#000000"
      stroke-opacity="0.9" stroke-width="14" stroke-linecap="round" stroke-linejoin="round"></path>
  </g>
</svg>`;

  ghostProfileSvg = ` <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
<g id="SVGRepo_iconCarrier">
  <path
    d="M127.045 94.768C193.909 -4.76792 315.863 155.5 230.166 221.102C163.575 272.083 85.3939 192.621 116.659 123.48"
    stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
  </path>
  <path
    d="M283.322 113.389C285.936 108.102 287.922 105.468 291.601 103.322C307.135 94.2618 309.71 145.11 297.972 158.802C282.852 176.438 271.649 136.939 282.295 118.826"
    stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
  </path>
  <path
    d="M311.027 113.389C313.641 108.102 315.627 105.468 319.306 103.322C334.84 94.2618 337.416 145.11 325.677 158.802C310.557 176.438 299.354 136.939 310 118.826"
    stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
  </path>
  <path d="M68 329.49C79.7542 226.834 223.411 226.834 233.074 337.491" stroke="#000000" stroke-opacity="0.9"
    stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M322.537 125.336V135.725" stroke="#000000" stroke-opacity="0.9" stroke-width="12"
    stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M293.678 125.336V135.725" stroke="#000000" stroke-opacity="0.9" stroke-width="12"
    stroke-linecap="round" stroke-linejoin="round"></path>
  <path opacity="0.503384" d="M294.256 102.248C261.263 117.752 234.328 128.141 213.45 133.416" stroke="#000000"
    stroke-opacity="0.9" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"></path>
  <path opacity="0.503384" d="M288.484 165.739C247.211 158.043 222.199 154.195 213.45 154.195" stroke="#000000"
    stroke-opacity="0.9" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"></path>
</g>
</svg>`;

  searchSvg = ` <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
<g id="SVGRepo_iconCarrier">
  <path
    d="M107.959 118.707C112.507 109.238 119.972 102.956 130.392 101.245C179.396 93.2005 214.204 155.467 173.452 188.916C136.661 219.112 88.5141 182.545 101.445 140.091"
    stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
  </path>
  <path
    d="M223.138 126.077C256.976 65.954 347.241 123.665 303.865 178.979C274.655 216.229 207.817 202.447 216.774 149.735"
    stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
  </path>
  <path
    d="M89.8422 154.097C79.9992 170.208 37.6369 197.245 28.5285 218.499C21.7425 234.332 92.924 220.223 102.399 218.499"
    stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
  </path>
  <path d="M324.597 159.292C395.562 218.499 388.822 230.513 290.988 230.513" stroke="#000000"
    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M290.988 230.513C291.352 256.859 299.318 320.051 294.391 346.115" stroke="#000000"
    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M102.402 218.5C108.739 248.16 110.802 315.959 110.802 346.115" stroke="#000000" stroke-opacity="0.9"
    stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M137.364 91.9387C172.521 41.4597 241.039 42.7016 266.303 86.6748" stroke="#000000"
    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M195.08 148.426C199.92 146.748 211.061 147.13 215.956 147.596" stroke="#000000" stroke-opacity="0.9"
    stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M132.697 205.682C157.035 257.62 239.597 256.499 260.201 211.626" stroke="#000000"
    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M142.439 155.071C142.866 151.4 142.787 147.686 142.787 143.991" stroke="#000000" stroke-opacity="0.5"
    stroke-width="12" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M265.689 160.092C265.689 155.18 265.811 151.693 266.303 147.198" stroke="#000000"
    stroke-opacity="0.5" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M91.5781 167.377C86.3674 153.643 89.5855 145.207 91.7203 135.239" stroke="#000000"
    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M327.589 159.301C332.555 150.783 329.747 143.94 324.789 136.501" stroke="#000000"
    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M324.393 168.901C325.826 168.178 326.526 166.501 327.593 165.301" stroke="#000000"
    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M94.0039 160.501C95.4013 159.585 96.9383 159.701 98.4035 159.301" stroke="#000000"
    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
</g>
</svg>`;

  myRequestSvg = `<svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M148.427 132.9C215.702 45.876 338.403 185.999 252.181 243.354C185.181 287.927 106.521 218.453 137.977 158.003" stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M222.555 180.284C222.635 180.459 222.804 180.575 223.03 180.679C223.319 180.859 223.58 181.055 223.867 181.236C224.143 181.41 224.478 181.554 224.798 181.696C225.365 181.947 225.956 182.168 226.594 182.346C227.036 182.469 227.491 182.565 227.964 182.634C228.504 182.714 229.073 182.734 229.626 182.735C230.116 182.735 230.604 182.686 231.087 182.645C231.575 182.605 232.056 182.538 232.532 182.462C233.496 182.307 234.451 182.068 235.314 181.761C236.139 181.468 236.858 181.078 237.428 180.611C237.695 180.392 237.903 180.164 238.077 179.913" stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M178.811 179.913C179.019 180.207 179.291 180.474 179.538 180.744C179.851 181.085 180.206 181.396 180.571 181.694C181.971 182.833 183.751 183.641 185.641 183.982C187.757 184.362 189.926 184.055 191.887 183.324C192.287 183.176 192.668 183.011 193.047 182.823C193.504 182.594 193.927 182.294 194.333 182.007" stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M155.001 292C155.001 292 154 302.314 153.001 321.549C152 340.814 151.001 369 151.001 369" stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M255.501 366C255.501 330.878 252.001 289.584 252.001 289.584C281.756 290.185 295.875 289.477 307.371 263.405C315.537 244.886 307.371 187 307.371 187" stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M156.001 286.725C156.001 286.725 136.453 289.223 114.229 279.169C92.0042 269.115 95.9404 208.058 114.228 181" stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M117.343 174.496C124.359 114.592 120.235 61.656 200.803 61.656C272.556 61.656 298.585 108.904 298.585 178.551" stroke="#000000" stroke-opacity="0.9" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M288.933 148.523C288.933 148.523 294.295 163.923 294.295 181.769C294.295 199.615 292.032 208.331 291.491 215.014" stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M122.988 147.281C122.988 147.281 117.402 168.505 117.402 184.675C117.402 200.846 116.781 200.676 119.574 222.069" stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M94.6228 101.875C105.525 97.0946 109.362 113.263 98.6301 117.259C87.8001 121.292 85.8363 107.69 90.0816 104.528C90.798 103.994 91.5268 104.155 92.2185 103.467" stroke="#000000" stroke-opacity="0.9" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M128.586 93.8959C140.239 82.9861 150.02 106.169 136.313 109.578C126.2 112.093 122.354 102.864 130.132 95.1254" stroke="#000000" stroke-opacity="0.9" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M106.001 109C107.498 104.859 106.114 74.9739 107.514 72.5657C107.67 72.2987 117.501 67.7122 127.491 64.4303C134.165 62.2376 142.306 60.7738 142.528 61.0285C143.591 62.2466 142.528 91.4518 142.528 96.5965" stroke="#000000" stroke-opacity="0.9" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>`;

  myProjectSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 50 50"><path fill="currentColor" fill-rule="evenodd" d="M25 10c-8.3 0-15 6.7-15 15c0 6.6 4.3 12.2 10.3 14.2c.8.1 1-.3 1-.7v-2.6c-4.2.9-5.1-2-5.1-2c-.7-1.7-1.7-2.2-1.7-2.2c-1.4-.9.1-.9.1-.9c1.5.1 2.3 1.5 2.3 1.5c1.3 2.3 3.5 1.6 4.4 1.2c.1-1 .5-1.6 1-2c-3.3-.4-6.8-1.7-6.8-7.4c0-1.6.6-3 1.5-4c-.2-.4-.7-1.9.1-4c0 0 1.3-.4 4.1 1.5c1.2-.3 2.5-.5 3.8-.5c1.3 0 2.6.2 3.8.5c2.9-1.9 4.1-1.5 4.1-1.5c.8 2.1.3 3.6.1 4c1 1 1.5 2.4 1.5 4c0 5.8-3.5 7-6.8 7.4c.5.5 1 1.4 1 2.8v4.1c0 .4.3.9 1 .7c6-2 10.2-7.6 10.2-14.2C40 16.7 33.3 10 25 10" clip-rule="evenodd"/></svg>`;

  defaultSvg = `  <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
<g id="SVGRepo_iconCarrier">
  <path
    d="M215.835 236.523C230.615 231.916 324.859 219.284 329.748 226.618C334.971 234.451 321.015 256.19 317.642 262.938"
    stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
  </path>
  <path
    d="M200.43 255.233C193.052 270.139 138.403 369.463 140.997 374.65C184.626 369.677 267.828 372.737 277.473 363.093C283.205 357.361 284.422 345.24 289.029 338.33"
    stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
  </path>
  <path d="M264.26 253.033C263.823 251.417 265.394 250.388 265.911 249.181" stroke="#000000"
    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
  <path
    d="M83.7379 96.0933C118.308 -5.87526 268.629 41.5108 238.84 147.353C222.69 204.731 112.861 231.738 88.9965 140.507"
    stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
  </path>
  <path d="M202.97 130.113C202.266 124.677 202.005 121.366 200.834 116.492" stroke="#000000"
    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M171.583 131.136C171.322 126.558 170.176 123.198 168.959 118.776" stroke="#000000"
    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
  <path
    d="M305.535 279.447C299.282 280.768 293.481 283.147 288.475 287.151C243.516 323.118 311.573 335.609 332.5 293.755C336.586 285.581 335.535 276.637 330.298 270.092"
    stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
  </path>
  <path
    d="M88.9297 248.328C101.082 196.886 176.995 234.502 167.073 274.192C161.18 297.761 139.925 269.243 136.806 259.884"
    stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
  </path>
  <path d="M137.356 268.919C135.606 293.004 109.681 282.343 100.485 269.469" stroke="#000000"
    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
</g>
</svg>`;

  return `<div class="zeroResult-container">
  <!-- Error Container -->
  <div class="error-container ">

    <div class="svg-icon">
      ${type === "myMaterial"
      ? myMaterialSvg
      : type === "search"
        ? searchSvg
        : type === "ghostProfile"
          ? ghostProfileSvg
          : type === "myRequest"
            ? myRequestSvg
            : type === "myProject"
              ? myProjectSvg
              : defaultSvg
    }
    </div>

    <div class="status-msg-top">
      <h2>${message[type]}</h2>
    </div>
  </div>

  ${continueWith}

</div>`;
}

$(document).ready(function () {

  //extract the page from the url /profile/1 or /search?q=math
  const page = window.location.pathname.split("/")[1];


  // Add event listener to the "requestCheck" checkbox
  $("#requestCheck").on("change", function () {
    if ($(this).is(":checked")) {
      //if the requestCheck is checked, then disable the projectRadio and usersRadio
      $("#projectsCategory").prop("disabled", true);
      $("#userCategory").prop("disabled", true);
      changeCategory(page);
    } else {
      //if the requestCheck is unchecked, then enable the projectRadio
      $("#projectsCategory").prop("disabled", false);
      $("#userCategory").prop("disabled", false);
      changeCategory(page);
    }
  });
});

function changeCategory(page) {
  //enable the requestCheck
  $("#requestCheck").prop("disabled", false);
  let category = $("input[name='category']:checked").val(); // Get the currently selected category
  console.log(page, category);
  if (page === "request") {
    requestCategoryChange(page, category);
  } else if (page === "profile") {
    if ($("#requestCheck").prop("checked")) {
      myRequests(page, category);
    } else {
      myMaterials(page, category);
    }
  } else if (page === "search") {
    if ($("#requestCheck").prop("checked")) {
      searchRequests(page, category);
    } else {
      searchMaterials(page, category);
    }
  }
}

// Declare cardCategory globally
const cardCategory = $(".card-category");

function ajaxRequest(url, type, data = {}, cardType, zeroResultType, page) {
  let cardSection = $(".card-section");
  const ZeroResultSection = $(".zeroResult-container");

  if (cardSection.length === 0) {
    cardSection = $("<div class='card-section'></div>");
    cardCategory.after(cardSection);
  } else {
    cardSection.empty();
  }

  ZeroResultSection.remove();

  $.ajax({
    url: url,
    type: type,
    data: data,
    success: function (response) {
      console.log(response);
      renderData(response.data, cardType, zeroResultType, page);
    },
    error: function (error) {
      console.log(error);
      cardSection.html("Failed to load data");
    },
  });
}

function renderData(data, cardType, zeroResultType, page) {
  const cardSection = $(".card-section");

  if (data.length === 0) {
    cardCategory.after(ZeroResult(zeroResultType));
    cardSection.remove();
    return;
  }

  data.forEach((item) => {
    let card;
    if (cardType === "request") {
      card = RequestCard(
        page,
        item.request_id,
        item.user_id,
        item.title,
        item.subject,
        item.description,
        item.education_level,
        item.class_faculty,
        item.semester,
        item.no_of_materials,
        item.document_type,
        item.username,
        item.created_at,
        item.status
      );
    } else if (cardType === "material") {
      card = MaterialCard(
        page,
        item.class_faculty,
        item.comments_count,
        item.created_at,
        item.document_type,
        item.education_level,
        item.file_path,
        item.format,
        item.likes_count,
        item.material_id,
        item.responded_to,
        item.semester,
        item.subject,
        item.thumbnail_path,
        item.title,
        item.user_id,
        item.updated_at,
        item.username,
        item.views_count,
        item.status
      );
    } else if (cardType === "project") {
      card = ProjectCard(
        page,
        item.project_id,
        item.repo_link,
        item.user_id,
        item.username,
        item.created_at,
        item.updated_at,
        item.status
      );
    } else if (cardType === "profile") {
      card = UserCard(
        page,
        item.user_id,
        item.username,
        item.email,
        item.created_at,
        item.updated_at,
        item.status
      );
    }

    cardSection.append(card);
    updateTimeAgo();
  });
}

// Functions for different types of AJAX calls

function requestCategoryChange(page, category) {
  ajaxRequest(`/api/${page}/category`, "POST", { category }, "request", "myRequest", page);
}

function myMaterials(page, category) {
  const user_id = getUserIdFromUrl();
  ajaxRequest(`/api/${page}/myMaterials`, "POST", { category, user_id }, "material", "myMaterial", page);
}

function myRequests(page, category) {
  const user_id = getUserIdFromUrl();
  ajaxRequest(`/api/${page}/myRequests`, "POST", { category, user_id }, "request", "myRequest", page);
}

function myProjects(page) {
  $("#requestCheck").prop("disabled", true);
  const user_id = getUserIdFromUrl();
  ajaxRequest(`/api/${page}/myProjects`, "POST", { user_id }, "project", "myProject", page);
}

function searchMaterials(page, category) {
  const searchQuery = getSearchQueryFromUrl();
  ajaxRequest(`/api/search?q=${searchQuery}`, "POST", {
    category,
    "search_type": "material",
  }, "material", "search", page);
}

function searchRequests(page, category) {
  const searchQuery = getSearchQueryFromUrl();
  ajaxRequest(`/api/search?q=${searchQuery}`, "POST", {
    category,
    "search_type": "request",
  }, "request", "search", page);
}

function searchProjects(page) {

  $("#requestCheck").prop("disabled", true);
  const searchQuery = getSearchQueryFromUrl();
  ajaxRequest(`/api/search?q=${searchQuery}`, "POST", {
    "search_type": "project",
  }, "project", "search", page);
}

function searchUsers(page) {
  console.log("searchUsers fun");
  $("#requestCheck").prop("disabled", true);
  const searchQuery = getSearchQueryFromUrl();
  ajaxRequest(`/api/search?q=${searchQuery}`, "POST", {
    "search_type": "user",
  }, "profile", "search", page);
}

// Helper functions

function getUserIdFromUrl() {
  const pathSegments = window.location.pathname.split("/");
  return pathSegments[pathSegments.length - 1];
}

function getSearchQueryFromUrl() {
  return new URLSearchParams(window.location.search).get("q");
}
