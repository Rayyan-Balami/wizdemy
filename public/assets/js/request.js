function RequestCard(
  request_id,
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
  id
) {
  let semesterHTML = "";
  if (semester) {
    semesterHTML = `<span title="Semester"># ${semester} Sem</span>`;
  }
  if(document_type === "labreport") {
    document_type = "lab report";
  }
  return `<div class="request-card">
  <!-- subject -->
  <p class="subject">${subject}</p>
  <!-- title  -->
  <h2 class="title">${title}</h2>
  <!-- request- -->
  <p class="request-details">${description}</p>
  <!-- education-level  -->
  <div class="education-level">
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
  <a href="profile.html" class="username">
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
      <p><a href="" class="time-ago" data-datetime="${created_at}"></a>
    </a></p>
      <!-- three dot icon -->
      <button class="three-dot-icon" onclick="openThreeDotMenu('/requests/details?request_id=${id}')">
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
                <form action="/upload/respond" method="post">
                <!-- respond button  -->
                <input type="hidden" name="request_id" value="${request_id}">
                <button type="submit" class="respond-button">
                    <span>Respond</span>
                    <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none'
                        stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                        <path d='M5 12h13M12 5l7 7-7 7' />
                    </svg>
                </button>
                </form>
            </div>
</div>`;
}

function ZeroResult(auth) {
  $continueWith = "";
  if (auth) {
    $continueWith = `<div class="continue-with">
        <h3 class="">
          Continue With
        </h3>
    
        <ul class="menu-list">
    
          <!-- upload form link -->
          <li>
            <a href="/">
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
            <a href="/question">
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
  }
  return `<div class="zeroResult-container">
  <!-- Error Container -->
  <div class="error-container ">

    <div class="svg-icon">
      <svg fill="#000000" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="hole"> <path d="M2.3384,25.8242a1,1,0,0,0,1.4145,0l.7664-.7667.7663.7667A1,1,0,0,0,6.7007,24.41l-.7672-.7676.7672-.7676a1,1,0,0,0-1.4151-1.4141l-.7663.7668-.7664-.7668a1,1,0,0,0-1.415,1.4141l.7672.7676-.7672.7676A1,1,0,0,0,2.3384,25.8242Z"></path> <path d="M55.98,40.2405a23.9922,23.9922,0,0,0-47.9607,0C2.7753,42.0383,0,44.3694,0,47c0,3.7141,5.3953,6.4485,12.9129,8.1108.0118.0025.0227.0057.0345.0076A91.8345,91.8345,0,0,0,32,57c15.5127,0,32-3.5049,32-10C64,44.37,61.2246,42.0372,55.98,40.2405ZM13.7349,53.2578a22,22,0,1,1,36.53,0A88.4654,88.4654,0,0,1,32,55,88.4654,88.4654,0,0,1,13.7349,53.2578Z"></path> <path d="M53,22.0039a3.001,3.001,0,1,0-3-3.001A3.0041,3.0041,0,0,0,53,22.0039Zm0-4.0019a1.001,1.001,0,1,1-1,1.0009A1.0018,1.0018,0,0,1,53,18.002Z"></path> <circle cx="57" cy="11.0005" r="1.0002"></circle> <path d="M41.5,28.0078A7.503,7.503,0,1,0,49,35.5107,7.51,7.51,0,0,0,41.5,28.0078Zm0,13.0059a5.503,5.503,0,1,1,5.5-5.503A5.5078,5.5078,0,0,1,41.5,41.0137Z"></path> <circle cx="40.5" cy="34.8918" r="1.5004"></circle> <path d="M30,35.5107a7.5,7.5,0,1,0-7.5,7.503A7.51,7.51,0,0,0,30,35.5107Zm-7.5,5.503a5.503,5.503,0,1,1,5.5-5.503A5.5078,5.5078,0,0,1,22.5,41.0137Z"></path> <path d="M23.5,33.3926A1.5007,1.5007,0,1,0,25,34.8933,1.5,1.5,0,0,0,23.5,33.3926Z"></path> <path d="M32.0176,45c-3.5547,0-6.8062,1.3965-8.4864,3.6436A2.7448,2.7448,0,0,0,25.707,53H38.3193a2.652,2.652,0,0,0,2.3975-1.5215,2.8063,2.8063,0,0,0-.33-2.9863C38.6792,46.3379,35.4722,45,32.0176,45Z"></path> <path d="M16.9048,28.3867a1.001,1.001,0,0,0,1.272-.6181c1.19-3.4375,5.3671-3.2286,5.542-3.2129A1,1,0,0,0,23.85,22.56c-2.0132-.127-6.2065.6416-7.5625,4.5547A1,1,0,0,0,16.9048,28.3867Z"></path> <path d="M40.2988,24.5557c.0469-.0069,4.3394-.25,5.5391,3.2129a1,1,0,1,0,1.89-.6543C46.3726,23.2012,42.1816,22.43,40.165,22.56a1,1,0,0,0-.9306,1.0654A1.0158,1.0158,0,0,0,40.2988,24.5557Z"></path> <path d="M32,14a1,1,0,0,0,1-1V9a1,1,0,0,0-2,0v4A1,1,0,0,0,32,14Z"></path> <path d="M36,15a.9967.9967,0,0,0,.707-.293l2.5-2.5a1,1,0,0,0-1.414-1.414l-2.5,2.5A1,1,0,0,0,36,15Z"></path> <path d="M27.793,14.707a1,1,0,0,0,1.414-1.414l-2.5-2.5a1,1,0,0,0-1.414,1.414Z"></path> </g> </g></svg>
    </div>

    <div class="status-msg-top">
      No Results Found
    </div>
  </div>

  ${$continueWith}

</div>`;
}

function changeCategory(category, auth) {
  const requestCardSection = $(".request-card-section");
  const ZeroResultSection = $(".zeroResult-container");

  requestCardSection.empty();
  ZeroResultSection.remove();

  ["note", "question", "labreport"].forEach((cat) => {
    const element = $(`#${cat}-category`);
    element.removeClass("is-active-category").attr("disabled", false);
    if (cat === category) {
      element.addClass("is-active-category").attr("disabled", true);
    }
  });

  $.ajax({
    url: "/request/api",
    type: "POST",
    data: { category },
    success: function (respond) {
      if (!respond.data.length) {
        requestCardSection.after(ZeroResult(auth));
        return;
      }
      respond.data.forEach((request) => {
        const requestCard = RequestCard(
          request.request_id,
          request.title,
          request.subject,
          request.description,
          request.education_level,
          request.class_faculty,
          request.semester,
          request.no_of_materials,
          request.document_type,
          request.username,
          request.created_at,
          request.id
        );
        requestCardSection.append(requestCard);
      });

      // Call updateTimeAgo to update time ago text for newly added content
      updateTimeAgo();
    },
    error: function (error) {
      console.log(error);
      requestCardSection.html("Failed to load data");
    },
  });
}
