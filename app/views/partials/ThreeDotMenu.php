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
    <!-- info/ description -->
    <button onclick="toggleSideInfo()">
      <li class="meta-data">
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
      <form id="edit-form" action="/material/edit/<?= $material['material_id'] ?>" method="post">
        <button>
          <li class="meta-data">
            <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                    <path
                      d="M9.533 11.15A1.823 1.823 0 0 0 9 12.438V15h2.578c.483 0 .947-.192 1.289-.534l7.6-7.604a1.822 1.822 0 0 0 0-2.577l-.751-.751a1.822 1.822 0 0 0-2.578 0z" />
                    <path
                      d="M21 12c0 4.243 0 6.364-1.318 7.682C18.364 21 16.242 21 12 21c-4.243 0-6.364 0-7.682-1.318C3 18.364 3 16.242 3 12c0-4.243 0-6.364 1.318-7.682C5.636 3 7.758 3 12 3" />
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
        </button>
      </form>
      <!-- delete -->
      <button id="delete-button" onclick="deleteMaterial(this)">
        <li class="meta-data danger">
          <span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path fill="currentColor" fill-rule="evenodd"
                    d="M10.31 2.25h3.38c.217 0 .406 0 .584.028a2.25 2.25 0 0 1 1.64 1.183c.084.16.143.339.212.544l.111.335a1.25 1.25 0 0 0 1.263.91h3a.75.75 0 0 1 0 1.5h-17a.75.75 0 0 1 0-1.5h3.09a1.25 1.25 0 0 0 1.173-.91l.112-.335c.068-.205.127-.384.21-.544a2.25 2.25 0 0 1 1.641-1.183c.178-.028.367-.028.583-.028m-1.302 3a2.757 2.757 0 0 0 .175-.428l.1-.3c.091-.273.112-.328.133-.368a.75.75 0 0 1 .547-.395a3.2 3.2 0 0 1 .392-.009h3.29c.288 0 .348.002.392.01a.75.75 0 0 1 .547.394c.021.04.042.095.133.369l.1.3l.039.112c.039.11.085.214.136.315z"
                    clip-rule="evenodd" />
                  <path fill="currentColor"
                    d="M5.915 8.45a.75.75 0 1 0-1.497.1l.464 6.952c.085 1.282.154 2.318.316 3.132c.169.845.455 1.551 1.047 2.104c.591.554 1.315.793 2.17.904c.822.108 1.86.108 3.146.108h.879c1.285 0 2.324 0 3.146-.108c.854-.111 1.578-.35 2.17-.904c.591-.553.877-1.26 1.046-2.104c.162-.813.23-1.85.316-3.132l.464-6.952a.75.75 0 0 0-1.497-.1l-.46 6.9c-.09 1.347-.154 2.285-.294 2.99c-.137.685-.327 1.047-.6 1.303c-.274.256-.648.422-1.34.512c-.713.093-1.653.095-3.004.095h-.774c-1.35 0-2.29-.002-3.004-.095c-.692-.09-1.066-.256-1.34-.512c-.273-.256-.463-.618-.6-1.302c-.14-.706-.204-1.644-.294-2.992z" />
                  <path fill="currentColor"
                    d="M9.425 10.254a.75.75 0 0 1 .821.671l.5 5a.75.75 0 0 1-1.492.15l-.5-5a.75.75 0 0 1 .671-.821m5.15 0a.75.75 0 0 1 .671.82l-.5 5a.75.75 0 0 1-1.492-.149l.5-5a.75.75 0 0 1 .82-.671" />
                </svg>
          </span>
          <div>
            <h3>Delete</h3>
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
        <li class="meta-data danger">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path fill="currentColor" fill-rule="evenodd" stroke-width="2"
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
      <li class="meta-data danger">
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
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