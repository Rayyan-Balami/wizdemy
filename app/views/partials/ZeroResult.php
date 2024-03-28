<?php

$message = [
  'default' => 'No Results Found',
  'profile' => 'Ouch! No uploads',
  'ghostProfile' => 'Looking for a ghost?',
  'search' => 'No results found for your search'
];

?>
<div class="zeroResult-container">
  <!-- Error Container -->
  <div class="error-container ">


    <div class="svg-icon">
      <?php if (isset ($page) && $page === 'profile'): ?>
        <!-- profile svg -->
        <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
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
        </svg>
      <?php elseif (isset ($page) && $page === 'ghostProfile'): ?>
        <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <path
              d="M113 307.118C159.034 249.855 113.914 175.413 149.893 103.552C167.081 69.2199 223.733 61.2364 250.421 87.8935C299.182 136.588 270.126 209.971 277.169 259.22C279.214 273.504 298.646 302.352 279.936 313.564C250.334 331.304 250.058 284.2 231.055 280.404C219.134 278.023 224.418 329.471 198.774 320.933C188.725 317.589 198.029 291.772 184.017 287.774C170.496 283.915 168.149 347.454 142.515 321.856"
              stroke="#000000" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
            </path>
            <path d="M221.475 170.81C220.85 174.399 220.636 178.072 220.004 181.524" stroke="#000000" stroke-opacity="0.9"
              stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M196.928 180.334C196.928 177.556 196.928 174.778 196.928 172" stroke="#000000" stroke-opacity="0.9"
              stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
          </g>
        </svg>
      <?php elseif (isset ($page) && $page === 'search'): ?>
        <!-- search svg -->
        <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
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
        </svg>
      <?php else: ?>
        <!-- default svg  -->
        <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
          <g id="SVGRepo_iconCarrier">
            <path
              d="M215.835 236.523C230.615 231.916 324.859 219.284 329.748 226.618C334.971 234.451 321.015 256.19 317.642 262.938"
              stroke="currentColor" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
            </path>
            <path
              d="M200.43 255.233C193.052 270.139 138.403 369.463 140.997 374.65C184.626 369.677 267.828 372.737 277.473 363.093C283.205 357.361 284.422 345.24 289.029 338.33"
              stroke="currentColor" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
            </path>
            <path d="M264.26 253.033C263.823 251.417 265.394 250.388 265.911 249.181" stroke="currentColor"
              stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
            <path
              d="M83.7379 96.0933C118.308 -5.87526 268.629 41.5108 238.84 147.353C222.69 204.731 112.861 231.738 88.9965 140.507"
              stroke="currentColor" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
            </path>
            <path d="M202.97 130.113C202.266 124.677 202.005 121.366 200.834 116.492" stroke="currentColor"
              stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M171.583 131.136C171.322 126.558 170.176 123.198 168.959 118.776" stroke="currentColor"
              stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
            <path
              d="M305.535 279.447C299.282 280.768 293.481 283.147 288.475 287.151C243.516 323.118 311.573 335.609 332.5 293.755C336.586 285.581 335.535 276.637 330.298 270.092"
              stroke="currentColor" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
            </path>
            <path
              d="M88.9297 248.328C101.082 196.886 176.995 234.502 167.073 274.192C161.18 297.761 139.925 269.243 136.806 259.884"
              stroke="currentColor" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round">
            </path>
            <path d="M137.356 268.919C135.606 293.004 109.681 282.343 100.485 269.469" stroke="currentColor"
              stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
          </g>
        </svg>
      <?php endif; ?>
    </div>

    <div class="status-msg-top">
      <?php if (isset ($page)): ?>
        <h3>
          <?= $message[$page] ?>
        </h3>
      <?php else: ?>
        <h3>
          <?= $message['default'] ?>
        </h3>
      <?php endif; ?>
    </div>
  </div>

  <!-- Continue With -->
  <div class="continue-with flex flex-col mt-48">
    <h3 class="text-gray-400 font-bold uppercase">
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
                <?= SITE_NAME ?>
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
  </div>
</div>