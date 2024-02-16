<!-- notification overlay -->
<div id="notificationOverlay" onclick="toggleNotificationOverlay()">
  <div id="notificationModal">
    <div class="notification-header">
      <button type="button" id="back-button-notification" onclick="closeNotificationOverlay()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path fill="currentColor"
            d="m7.825 13l4.9 4.9q.3.3.288.7t-.313.7q-.3.275-.7.288t-.7-.288l-6.6-6.6q-.15-.15-.213-.325T4.426 12q0-.2.063-.375T4.7 11.3l6.6-6.6q.275-.275.688-.275t.712.275q.3.3.3.713t-.3.712L7.825 11H19q.425 0 .713.288T20 12q0 .425-.288.713T19 13z" />
        </svg>
      </button>
      <h3>Notificaitons</h3>
    </div>
    <ul>
      <li>
        <div class="notification-category">
          <span id="category">Interaction</span>
          ·
          <span id="time">1 hour ago</span>
          <button id="removeNotificationBtn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
            </svg>
          </button>
        </div>
        <div class="notification-body">
          <span class="notification-icon">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path d="M7 7H15" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path d="M7 11H11" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path
                  d="M19 3H5C3.89543 3 3 3.89543 3 5V15C3 16.1046 3.89543 17 5 17H8L11.6464 20.6464C11.8417 20.8417 12.1583 20.8417 12.3536 20.6464L16 17H19C20.1046 17 21 16.1046 21 15V5C21 3.89543 20.1046 3 19 3Z"
                  stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </g>
            </svg>
          </span>
          <div class="notification-content">
            <p><span id="username">@ ninjahatori</span>
              <span id="action">commented in your post</span>
            </p>
            <p id="message">"This is the comment...This is the comment...This is the comment..."</p>
          </div>
        </div>
      </li>
      <li>
        <div class="notification-category">
          <span id="category">Interaction</span>
          ·
          <span id="time">1 hour ago</span>
          <button id="removeNotificationBtn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
            </svg>
          </button>
        </div>
        <div class="notification-body">
          <span class="notification-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256">
              <path fill="currentColor"
                d="M178 28c-20.09 0-37.92 7.93-50 21.56C115.92 35.93 98.09 28 78 28a66.08 66.08 0 0 0-66 66c0 72.34 105.81 130.14 110.31 132.57a12 12 0 0 0 11.38 0C138.19 224.14 244 166.34 244 94a66.08 66.08 0 0 0-66-66m-5.49 142.36a328.69 328.69 0 0 1-44.51 31.8a328.69 328.69 0 0 1-44.51-31.8C61.82 151.77 36 123.42 36 94a42 42 0 0 1 42-42c17.8 0 32.7 9.4 38.89 24.54a12 12 0 0 0 22.22 0C145.3 61.4 160.2 52 178 52a42 42 0 0 1 42 42c0 29.42-25.82 57.77-47.49 76.36" />
            </svg>
          </span>
          <div class="notification-content">
            <p><span id="username">@ ninjahatori</span>
              <span id="action">liked your post</span>
            </p>
            <p id="message">"like counts : 48"</p>
          </div>
        </div>
      </li>
      <li>
        <div class="notification-category">
          <span id="category">Report</span>
          ·
          <span id="time">1 hour ago</span>
          <button id="removeNotificationBtn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
            </svg>
          </button>
        </div>
        <div class="notification-body">
          <span class="notification-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor" fill-rule="evenodd"
                d="M5 1.25a.75.75 0 0 1 .75.75v1.085l1.574-.315a9.427 9.427 0 0 1 5.35.492l.413.165a6.55 6.55 0 0 0 4.021.273c1.28-.32 2.307 1.067 1.628 2.197l-1.278 2.131c-.377.627-.437.757-.452.875a.754.754 0 0 0 0 .194c.015.118.075.248.452.875l1.56 2.601c.57.95.06 2.18-1.014 2.45l-.1.024a9.427 9.427 0 0 1-5.788-.393a7.927 7.927 0 0 0-4.498-.413l-1.868.374V22a.75.75 0 0 1-1.5 0V2A.75.75 0 0 1 5 1.25m.75 11.835l1.574-.315a9.428 9.428 0 0 1 5.35.492a7.927 7.927 0 0 0 4.866.33l.1-.025a.15.15 0 0 0 .092-.222l-1.56-2.601l-.06-.098c-.282-.47-.532-.885-.594-1.354a2.253 2.253 0 0 1 0-.584c.062-.469.311-.884.595-1.353l.059-.099l1.253-2.09a8.05 8.05 0 0 1-4.895-.346l-.414-.166a7.927 7.927 0 0 0-4.498-.413l-1.868.374z"
                clip-rule="evenodd" />
            </svg>
          </span>
          <div class="notification-content">
            <p><span id="username">@ ninjahatori</span>
              <span id="action">Repoted in your post</span>
            </p>
            <p id="message">"I am the author of this post"</p>
          </div>
        </div>
      </li>
      <li>
        <div class="notification-category">
          <span id="category">Admin</span>
          ·
          <span id="time">1 hour ago</span>
          <button id="removeNotificationBtn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
            </svg>
          </button>
        </div>
        <div class="notification-body">
          <span class="notification-icon">
            <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path
                  d="M169.562 158.468C172.723 143.863 188.522 134.417 202.42 131.439C278.386 115.161 314.412 201.317 267.078 242.734C225.658 278.977 150.298 244.532 166.912 178.077"
                  stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path d="M180.504 265.903C158.81 277.858 129.811 297.195 105.777 304.062" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M214.719 281.677C246.965 293.888 278.57 299.822 311.937 308.832" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M180.503 265.903C82.5548 224.942 122.393 218.848 169.317 236.19" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path
                  d="M327.306 211.316C320.772 213.104 313.707 208.576 307.167 211.846C286.241 222.308 351.269 279.131 313.527 311.481C306.592 317.426 298.551 322.599 289.678 325.261C275.984 329.369 260.719 327.767 246.749 330.561C232.66 333.379 220.402 350.441 239.86 356"
                  stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path d="M311.937 308.832C327.788 306.392 321.295 326.14 308.227 313.072" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M105.78 304.062C88.4488 311.249 82.9796 300.938 70.8008 290.282" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M139.03 342.308C123.46 352.398 109.624 355.167 92.5312 345.4" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M350.098 310.422C288.359 284.983 233.083 265.903 175.016 238.78" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M351.686 308.301C349.24 283.761 369.319 305.987 373.945 316.782" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M346.918 309.892C332.921 327.365 365.863 317.792 373.947 316.781" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M233.082 223.013C228.402 225.102 224.355 225.805 219.832 223.543" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M257.515 227.136C256.901 223.613 258.58 219.231 259.345 216.682" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M70.8005 290.282C65.5847 289.885 56.8604 289.236 53.8047 292.292" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M89.8894 344.321C85.1582 343.573 81.7853 345.017 78.1406 346.839" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path
                  d="M259.278 115.132C257.236 105.677 308.483 29.7598 317.182 47.158C330.315 73.4239 296.203 114.899 296.203 130.238C296.203 135.166 316.098 115.777 320.539 126.881C324.131 135.861 313.387 148.908 307.112 153.735C304.929 155.415 298.327 154.628 299.559 157.092C299.717 157.407 334.024 166.814 307.112 172.197C304.901 172.639 302.636 172.756 300.398 173.036"
                  stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path
                  d="M146.858 202.762C129.834 161.686 87.4826 88.7261 33.1626 88.7261C-4.25663 88.7261 49.8853 152.314 54.1424 155.861C66.6065 166.248 77.3107 177.351 88.5492 188.589C91.2026 191.243 81.5713 185.68 78.4787 183.554C73.6425 180.229 45.956 158.316 39.8765 168.449C31.0635 183.136 48.7612 200.078 59.1773 207.891C67.8583 214.402 76.9239 214.419 76.8004 214.604C72.4305 221.16 61.6979 212.639 57.499 223.835C52.2874 237.733 85.8143 257.403 97.7802 257.403"
                  stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path d="M211.775 284.983C186.335 308.62 166.864 329.654 139.027 342.308" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M128.504 297.548C133.258 310.12 138.34 322.733 142.553 335.375" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
              </g>
            </svg>
          </span>
          <div class="notification-content">
            <p><span id="username">@ cupid</span>
              <span id="action">maya ko tira</span>
            </p>
            <p id="message">"keep learnig keep growing"</p>
          </div>
        </div>
      </li>
      <li>
        <div class="notification-category">
          <span id="category">Promotion</span>
          ·
          <span id="time">1 hour ago</span>
          <button id="removeNotificationBtn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
            </svg>
          </button>
        </div>
        <div class="notification-body">
          <span class="notification-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <g fill="none" fill-rule="evenodd">
                <path
                  d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                <path fill="currentColor"
                  d="M19 4.741V8a3 3 0 1 1 0 6v3c0 1.648-1.881 2.589-3.2 1.6l-2.06-1.546A8.658 8.658 0 0 0 10 15.446v2.844a2.71 2.71 0 0 1-5.316.744l-1.57-5.496a4.7 4.7 0 0 1 3.326-7.73l3.018-.168a9.344 9.344 0 0 0 4.19-1.259l2.344-1.368C17.326 2.236 19 3.197 19 4.741M5.634 15.078l.973 3.407A.71.71 0 0 0 8 18.29v-3.01l-1.56-.087a4.723 4.723 0 0 1-.806-.115M17 4.741L14.655 6.11A11.343 11.343 0 0 1 10 7.604v5.819c1.787.246 3.488.943 4.94 2.031L17 17zM8 7.724l-1.45.08a2.7 2.7 0 0 0-.17 5.377l.17.015l1.45.08zM19 10v2a1 1 0 0 0 .117-1.993z" />
              </g>
            </svg>
          </span>
          <div class="notification-content">
            <p><span id="username">@ promotionTeam</span>
              <span id="action">janey ho ?</span>
            </p>
            <p id="message">"KBC IT FEST 2024/2/2"</p>
          </div>
        </div>
      </li>
      <li>
        <div class="notification-category">
          <span id="category">Interaction</span>
          ·
          <span id="time">1 hour ago</span>
          <button id="removeNotificationBtn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
            </svg>
          </button>
        </div>
        <div class="notification-body">
          <span class="notification-icon">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path d="M7 7H15" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path d="M7 11H11" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path
                  d="M19 3H5C3.89543 3 3 3.89543 3 5V15C3 16.1046 3.89543 17 5 17H8L11.6464 20.6464C11.8417 20.8417 12.1583 20.8417 12.3536 20.6464L16 17H19C20.1046 17 21 16.1046 21 15V5C21 3.89543 20.1046 3 19 3Z"
                  stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </g>
            </svg>
          </span>
          <div class="notification-content">
            <p><span id="username">@ ninjahatori</span>
              <span id="action">commented in your post</span>
            </p>
            <p id="message">"This is the comment...This is the comment...This is the comment..."</p>
          </div>
        </div>
      </li>
      <li>
        <div class="notification-category">
          <span id="category">Interaction</span>
          ·
          <span id="time">1 hour ago</span>
          <button id="removeNotificationBtn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
            </svg>
          </button>
        </div>
        <div class="notification-body">
          <span class="notification-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256">
              <path fill="currentColor"
                d="M178 28c-20.09 0-37.92 7.93-50 21.56C115.92 35.93 98.09 28 78 28a66.08 66.08 0 0 0-66 66c0 72.34 105.81 130.14 110.31 132.57a12 12 0 0 0 11.38 0C138.19 224.14 244 166.34 244 94a66.08 66.08 0 0 0-66-66m-5.49 142.36a328.69 328.69 0 0 1-44.51 31.8a328.69 328.69 0 0 1-44.51-31.8C61.82 151.77 36 123.42 36 94a42 42 0 0 1 42-42c17.8 0 32.7 9.4 38.89 24.54a12 12 0 0 0 22.22 0C145.3 61.4 160.2 52 178 52a42 42 0 0 1 42 42c0 29.42-25.82 57.77-47.49 76.36" />
            </svg>
          </span>
          <div class="notification-content">
            <p><span id="username">@ ninjahatori</span>
              <span id="action">liked your post</span>
            </p>
            <p id="message">"like counts : 48"</p>
          </div>
        </div>
      </li>
      <li>
        <div class="notification-category">
          <span id="category">Report</span>
          ·
          <span id="time">1 hour ago</span>
          <button id="removeNotificationBtn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
            </svg>
          </button>
        </div>
        <div class="notification-body">
          <span class="notification-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor" fill-rule="evenodd"
                d="M5 1.25a.75.75 0 0 1 .75.75v1.085l1.574-.315a9.427 9.427 0 0 1 5.35.492l.413.165a6.55 6.55 0 0 0 4.021.273c1.28-.32 2.307 1.067 1.628 2.197l-1.278 2.131c-.377.627-.437.757-.452.875a.754.754 0 0 0 0 .194c.015.118.075.248.452.875l1.56 2.601c.57.95.06 2.18-1.014 2.45l-.1.024a9.427 9.427 0 0 1-5.788-.393a7.927 7.927 0 0 0-4.498-.413l-1.868.374V22a.75.75 0 0 1-1.5 0V2A.75.75 0 0 1 5 1.25m.75 11.835l1.574-.315a9.428 9.428 0 0 1 5.35.492a7.927 7.927 0 0 0 4.866.33l.1-.025a.15.15 0 0 0 .092-.222l-1.56-2.601l-.06-.098c-.282-.47-.532-.885-.594-1.354a2.253 2.253 0 0 1 0-.584c.062-.469.311-.884.595-1.353l.059-.099l1.253-2.09a8.05 8.05 0 0 1-4.895-.346l-.414-.166a7.927 7.927 0 0 0-4.498-.413l-1.868.374z"
                clip-rule="evenodd" />
            </svg>
          </span>
          <div class="notification-content">
            <p><span id="username">@ ninjahatori</span>
              <span id="action">Repoted in your post</span>
            </p>
            <p id="message">"I am the author of this post"</p>
          </div>
        </div>
      </li>
      <li>
        <div class="notification-category">
          <span id="category">Admin</span>
          ·
          <span id="time">1 hour ago</span>
          <button id="removeNotificationBtn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
            </svg>
          </button>
        </div>
        <div class="notification-body">
          <span class="notification-icon">
            <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path
                  d="M169.562 158.468C172.723 143.863 188.522 134.417 202.42 131.439C278.386 115.161 314.412 201.317 267.078 242.734C225.658 278.977 150.298 244.532 166.912 178.077"
                  stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path d="M180.504 265.903C158.81 277.858 129.811 297.195 105.777 304.062" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M214.719 281.677C246.965 293.888 278.57 299.822 311.937 308.832" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M180.503 265.903C82.5548 224.942 122.393 218.848 169.317 236.19" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path
                  d="M327.306 211.316C320.772 213.104 313.707 208.576 307.167 211.846C286.241 222.308 351.269 279.131 313.527 311.481C306.592 317.426 298.551 322.599 289.678 325.261C275.984 329.369 260.719 327.767 246.749 330.561C232.66 333.379 220.402 350.441 239.86 356"
                  stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path d="M311.937 308.832C327.788 306.392 321.295 326.14 308.227 313.072" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M105.78 304.062C88.4488 311.249 82.9796 300.938 70.8008 290.282" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M139.03 342.308C123.46 352.398 109.624 355.167 92.5312 345.4" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M350.098 310.422C288.359 284.983 233.083 265.903 175.016 238.78" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M351.686 308.301C349.24 283.761 369.319 305.987 373.945 316.782" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M346.918 309.892C332.921 327.365 365.863 317.792 373.947 316.781" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M233.082 223.013C228.402 225.102 224.355 225.805 219.832 223.543" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M257.515 227.136C256.901 223.613 258.58 219.231 259.345 216.682" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M70.8005 290.282C65.5847 289.885 56.8604 289.236 53.8047 292.292" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M89.8894 344.321C85.1582 343.573 81.7853 345.017 78.1406 346.839" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path
                  d="M259.278 115.132C257.236 105.677 308.483 29.7598 317.182 47.158C330.315 73.4239 296.203 114.899 296.203 130.238C296.203 135.166 316.098 115.777 320.539 126.881C324.131 135.861 313.387 148.908 307.112 153.735C304.929 155.415 298.327 154.628 299.559 157.092C299.717 157.407 334.024 166.814 307.112 172.197C304.901 172.639 302.636 172.756 300.398 173.036"
                  stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path
                  d="M146.858 202.762C129.834 161.686 87.4826 88.7261 33.1626 88.7261C-4.25663 88.7261 49.8853 152.314 54.1424 155.861C66.6065 166.248 77.3107 177.351 88.5492 188.589C91.2026 191.243 81.5713 185.68 78.4787 183.554C73.6425 180.229 45.956 158.316 39.8765 168.449C31.0635 183.136 48.7612 200.078 59.1773 207.891C67.8583 214.402 76.9239 214.419 76.8004 214.604C72.4305 221.16 61.6979 212.639 57.499 223.835C52.2874 237.733 85.8143 257.403 97.7802 257.403"
                  stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path d="M211.775 284.983C186.335 308.62 166.864 329.654 139.027 342.308" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M128.504 297.548C133.258 310.12 138.34 322.733 142.553 335.375" stroke="#000000"
                  stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
              </g>
            </svg>
          </span>
          <div class="notification-content">
            <p><span id="username">@ cupid</span>
              <span id="action">maya ko tira</span>
            </p>
            <p id="message">"keep learnig keep growing"</p>
          </div>
        </div>
      </li>
      <li>
        <div class="notification-category">
          <span id="category">Promotion</span>
          ·
          <span id="time">1 hour ago</span>
          <button id="removeNotificationBtn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
            </svg>
          </button>
        </div>
        <div class="notification-body">
          <span class="notification-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <g fill="none" fill-rule="evenodd">
                <path
                  d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                <path fill="currentColor"
                  d="M19 4.741V8a3 3 0 1 1 0 6v3c0 1.648-1.881 2.589-3.2 1.6l-2.06-1.546A8.658 8.658 0 0 0 10 15.446v2.844a2.71 2.71 0 0 1-5.316.744l-1.57-5.496a4.7 4.7 0 0 1 3.326-7.73l3.018-.168a9.344 9.344 0 0 0 4.19-1.259l2.344-1.368C17.326 2.236 19 3.197 19 4.741M5.634 15.078l.973 3.407A.71.71 0 0 0 8 18.29v-3.01l-1.56-.087a4.723 4.723 0 0 1-.806-.115M17 4.741L14.655 6.11A11.343 11.343 0 0 1 10 7.604v5.819c1.787.246 3.488.943 4.94 2.031L17 17zM8 7.724l-1.45.08a2.7 2.7 0 0 0-.17 5.377l.17.015l1.45.08zM19 10v2a1 1 0 0 0 .117-1.993z" />
              </g>
            </svg>
          </span>
          <div class="notification-content">
            <p><span id="username">@ promotionTeam</span>
              <span id="action">janey ho ?</span>
            </p>
            <p id="message">"KBC IT FEST 2024/2/2"</p>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div>
