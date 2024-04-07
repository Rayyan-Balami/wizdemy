<!-- three dot menu popup -->
<div id="three-dot-menu" onclick="closeThreeDotMenu()">
  <ul>
    <!-- copy link -->
    <button id="copy-link" data-copy-link="" onclick="copyLink()">
      <li>
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g fill="none" stroke="currentColor" stroke-width="1.5">
              <path
                d="M6 11c0-2.828 0-4.243.879-5.121C7.757 5 9.172 5 12 5h3c2.828 0 4.243 0 5.121.879C21 6.757 21 8.172 21 11v5c0 2.828 0 4.243-.879 5.121C19.243 22 17.828 22 15 22h-3c-2.828 0-4.243 0-5.121-.879C6 20.243 6 18.828 6 16z" />
              <path d="M6 19a3 3 0 0 1-3-3v-6c0-3.771 0-5.657 1.172-6.828C5.343 2 7.229 2 11 2h4a3 3 0 0 1 3 3" />
            </g>
          </svg>
        </span>
        <div>
          <h3>Copy</h3>
        </div>
      </li>
    </button>
    <!-- save -->
    <button>
      <li>
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g fill="none" stroke="currentColor" stroke-width="1.5">
              <path
                d="M21 16.09v-4.992c0-4.29 0-6.433-1.318-7.766C18.364 2 16.242 2 12 2C7.757 2 5.636 2 4.318 3.332C3 4.665 3 6.81 3 11.098v4.993c0 3.096 0 4.645.734 5.321c.35.323.792.526 1.263.58c.987.113 2.14-.907 4.445-2.946c1.02-.901 1.529-1.352 2.118-1.47c.29-.06.59-.06.88 0c.59.118 1.099.569 2.118 1.47c2.305 2.039 3.458 3.059 4.445 2.945c.47-.053.913-.256 1.263-.579c.734-.676.734-2.224.734-5.321Z" />
              <path stroke-linecap="round" d="M15 6H9" />
            </g>
          </svg>
        </span>
        <div>
          <h3>Bookmark</h3>
        </div>
      </li>
    </button>
    <!-- info/ description -->
    <button onclick="toggleSideInfo()">
      <li class="meta-data text-sm">
        <span>
          <svg fill="currentColor" viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
              <path
                d="M 24.3320 13.2461 C 24.3320 15.1211 25.8320 16.6211 27.7070 16.6211 C 29.6055 16.6211 31.0820 15.1211 31.0586 13.2461 C 31.0586 11.3477 29.6055 9.8477 27.7070 9.8477 C 25.8320 9.8477 24.3320 11.3477 24.3320 13.2461 Z M 18.5195 44.2305 C 18.5195 45.3789 19.3399 46.1523 20.5820 46.1523 L 35.4179 46.1523 C 36.6601 46.1523 37.4805 45.3789 37.4805 44.2305 C 37.4805 43.1055 36.6601 42.3320 35.4179 42.3320 L 30.7070 42.3320 L 30.7070 24.4492 C 30.7070 23.1836 29.8867 22.3399 28.6680 22.3399 L 21.2383 22.3399 C 20.0195 22.3399 19.1992 23.0899 19.1992 24.2148 C 19.1992 25.3867 20.0195 26.1602 21.2383 26.1602 L 26.3711 26.1602 L 26.3711 42.3320 L 20.5820 42.3320 C 19.3399 42.3320 18.5195 43.1055 18.5195 44.2305 Z">
              </path>
            </g>
          </svg>
        </span>
        <div>
          <h3>Info</h3>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
          stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M9 6l6 6l-6 6"></path>
        </svg>
      </li>
    </button>
    <?php if (isset($myProfile) && $myProfile == true): ?>
      <!-- edit -->
      <a id="edit-link" href="#">
        <li class="meta-data text-sm">
          <span>
            <svg fill="currentColor" viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path
                  d="M 24.3320 13.2461 C 24.3320 15.1211 25.8320 16.6211 27.7070 16.6211 C 29.6055 16.6211 31.0820 15.1211 31.0586 13.2461 C 31.0586 11.3477 29.6055 9.8477 27.7070 9.8477 C 25.8320 9.8477 24.3320 11.3477 24.3320 13.2461 Z M 18.5195 44.2305 C 18.5195 45.3789 19.3399 46.1523 20.5820 46.1523 L 35.4179 46.1523 C 36.6601 46.1523 37.4805 45.3789 37.4805 44.2305 C 37.4805 43.1055 36.6601 42.3320 35.4179 42.3320 L 30.7070 42.3320 L 30.7070 24.4492 C 30.7070 23.1836 29.8867 22.3399 28.6680 22.3399 L 21.2383 22.3399 C 20.0195 22.3399 19.1992 23.0899 19.1992 24.2148 C 19.1992 25.3867 20.0195 26.1602 21.2383 26.1602 L 26.3711 26.1602 L 26.3711 42.3320 L 20.5820 42.3320 C 19.3399 42.3320 18.5195 43.1055 18.5195 44.2305 Z">
                </path>
              </g>
            </svg>
          </span>
          <div>
            <h3>Edit</h3>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M9 6l6 6l-6 6"></path>
          </svg>
        </li>
      </a>
      <!-- delete -->
      <button id="delete-button">
        <li>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor" fill-rule="evenodd"
                d="M5 1.25a.75.75 0 0 1 .75.75v1.085l1.574-.315a9.427 9.427 0 0 1 5.35.492l.413.165a6.55 6.55 0 0 0 4.021.273c1.28-.32 2.307 1.067 1.628 2.197l-1.278 2.131c-.377.627-.437.757-.452.875a.754.754 0 0 0 0 .194c.015.118.075.248.452.875l1.56 2.601c.57.95.06 2.18-1.014 2.45l-.1.024a9.427 9.427 0 0 1-5.788-.393a7.927 7.927 0 0 0-4.498-.413l-1.868.374V22a.75.75 0 0 1-1.5 0V2A.75.75 0 0 1 5 1.25m.75 11.835l1.574-.315a9.428 9.428 0 0 1 5.35.492a7.927 7.927 0 0 0 4.866.33l.1-.025a.15.15 0 0 0 .092-.222l-1.56-2.601l-.06-.098c-.282-.47-.532-.885-.594-1.354a2.253 2.253 0 0 1 0-.584c.062-.469.311-.884.595-1.353l.059-.099l1.253-2.09a8.05 8.05 0 0 1-4.895-.346l-.414-.166a7.927 7.927 0 0 0-4.498-.413l-1.868.374z"
                clip-rule="evenodd" />
            </svg>
          </span>
          <div>
            <h3 class="danger">Delete</h3>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M9 6l6 6l-6 6"></path>
          </svg>
        </li>
      </button>
    <?php else: ?>
      <!-- report -->
      <a id="report-link" href="#">
        <li>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor" fill-rule="evenodd"
                d="M5 1.25a.75.75 0 0 1 .75.75v1.085l1.574-.315a9.427 9.427 0 0 1 5.35.492l.413.165a6.55 6.55 0 0 0 4.021.273c1.28-.32 2.307 1.067 1.628 2.197l-1.278 2.131c-.377.627-.437.757-.452.875a.754.754 0 0 0 0 .194c.015.118.075.248.452.875l1.56 2.601c.57.95.06 2.18-1.014 2.45l-.1.024a9.427 9.427 0 0 1-5.788-.393a7.927 7.927 0 0 0-4.498-.413l-1.868.374V22a.75.75 0 0 1-1.5 0V2A.75.75 0 0 1 5 1.25m.75 11.835l1.574-.315a9.428 9.428 0 0 1 5.35.492a7.927 7.927 0 0 0 4.866.33l.1-.025a.15.15 0 0 0 .092-.222l-1.56-2.601l-.06-.098c-.282-.47-.532-.885-.594-1.354a2.253 2.253 0 0 1 0-.584c.062-.469.311-.884.595-1.353l.059-.099l1.253-2.09a8.05 8.05 0 0 1-4.895-.346l-.414-.166a7.927 7.927 0 0 0-4.498-.413l-1.868.374z"
                clip-rule="evenodd" />
            </svg>
          </span>
          <div>
            <h3 class="danger">Report</h3>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M9 6l6 6l-6 6"></path>
          </svg>
        </li>
      </a>
    <?php endif; ?>
    <!-- cancel -->
    <button onclick="closeThreeDotMenu()">
      <li>
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
          </svg>
        </span>
        <div>
          <h3>Cancel</h3>
        </div>
      </li>
    </button>
  </ul>
</div>