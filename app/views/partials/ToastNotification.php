<!--toast notification-->
<ul class="toast-notification">
  <!-- error -->
  <?php if(Session::exists('errors')):
    foreach(Session::get('errors') as $error): ?>
  <li>
    <span>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36">
        <path fill="#2f7889" d="M13 34s0 2-2 2s-2-2-2-2V2s0-2 2-2s2 2 2 2z" />
        <path fill="#ff262e"
          d="M11 4c0-2.2 1.636-3.25 3.636-2.333l16.727 7.667c2 .917 2 2.417 0 3.333l-16.727 7.667C12.636 21.25 11 20.2 11 18z" />
      </svg>
    </span>
    <div>
      <p class="toast-msg"><?= $error ?></p>
    </div>
  </li>
  <?php endforeach; endif; ?>
  <!-- warning -->
  <?php
  if(Session::exists('warning')): 
    foreach(Session::get('warning') as $warning): ?>
  <li>
    <span>
      <svg style="transform: translateY(-2px);" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--noto"
        preserveAspectRatio="xMidYMid meet" fill="#000000">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
          <path
            d="M57.16 8.42l-52 104c-1.94 4.02-.26 8.85 3.75 10.79c1.08.52 2.25.8 3.45.81h104c4.46-.04 8.05-3.69 8.01-8.15a8.123 8.123 0 0 0-.81-3.45l-52-104a8.067 8.067 0 0 0-14.4 0z"
            fill="#f2a600"> </path>
          <path
            d="M53.56 15.72l-48.8 97.4c-1.83 3.77-.25 8.31 3.52 10.14c.99.48 2.08.74 3.18.76h97.5a7.55 7.55 0 0 0 7.48-7.62a7.605 7.605 0 0 0-.78-3.28l-48.7-97.4a7.443 7.443 0 0 0-9.93-3.47a7.484 7.484 0 0 0-3.47 3.47z"
            fill="#ffcc32"> </path>
          <g opacity=".2" fill="#424242">
            <path
              d="M64.36 34.02c4.6 0 8.3 3.7 8 8l-3.4 48c-.38 2.54-2.74 4.3-5.28 3.92a4.646 4.646 0 0 1-3.92-3.92l-3.4-48c-.3-4.3 3.4-8 8-8">
            </path>
            <path d="M64.36 98.02c3.31 0 6 2.69 6 6s-2.69 6-6 6s-6-2.69-6-6s2.69-6 6-6"> </path>
          </g>
          <linearGradient id="IconifyId17ecdb2904d178eab21432" gradientUnits="userSpaceOnUse" x1="68" y1="-1808.36"
            x2="68" y2="-1887.05" gradientTransform="matrix(1 0 0 -1 -3.64 -1776.09)">
            <stop offset="0" stop-color="#424242"> </stop>
            <stop offset="1" stop-color="#212121"> </stop>
          </linearGradient>
          <path
            d="M64.36 34.02c4.6 0 8.3 3.7 8 8l-3.4 48c-.38 2.54-2.74 4.3-5.28 3.92a4.646 4.646 0 0 1-3.92-3.92l-3.4-48c-.3-4.3 3.4-8 8-8z"
            fill="url(#IconifyId17ecdb2904d178eab21432)"> </path>
          <linearGradient id="IconifyId17ecdb2904d178eab21433" gradientUnits="userSpaceOnUse" x1="64.36" y1="-1808.36"
            x2="64.36" y2="-1887.05" gradientTransform="matrix(1 0 0 -1 0 -1772.11)">
            <stop offset="0" stop-color="#424242"> </stop>
            <stop offset="1" stop-color="#212121"> </stop>
          </linearGradient>
          <circle cx="64.36" cy="104.02" r="6" fill="url(#IconifyId17ecdb2904d178eab21433)"> </circle>
          <path
            d="M53.56 23.02c-1.2 1.5-21.4 41-21.4 41s-1.8 3 .7 4.7c2.3 1.6 4.4-.3 5.3-1.8s19.2-36.9 19.9-38.6c.6-1.87.18-3.91-1.1-5.4c-1.3-1.2-2.6-1-3.4.1z"
            fill="#fff170"> </path>
          <circle cx="31.36" cy="75.33" r="3.3" fill="#fff170"> </circle>
        </g>
      </svg>
    </span>
    <div>
      <p class="toast-msg"><?= $warning ?></p>
    </div>
  </li>
  <?php endforeach; endif; ?>
  <!-- info -->
  <?php
  if(Session::exists('info')): 
    foreach(Session::get('info') as $info):
    ?>
  <li>
    <span>
      <svg viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        aria-hidden="true" role="img" class="iconify iconify--noto" preserveAspectRatio="xMidYMid meet" fill="#000000">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
          <path
            d="M123.39 118.93c-.42-1.99-1.95-2.36-2.84-4.34c0 0-6.58-14.61-9.61-23.71c-2.09-6.28-3.69-12.6-4.44-16.42c-1.67-8.57-5.17-11.04-9.27-13.53c-9.23-5.61-27.62-17.7-38.55-26.91C44.92 22.41 37.23 15 37.23 15L25.77 26.46L14.5 37.73s7.42 7.69 19.02 21.44c9.22 10.93 21.3 29.32 26.91 38.55c2.49 4.1 4.97 7.61 13.53 9.27c3.82.75 10.14 2.35 16.42 4.44c9.1 3.03 23.71 9.61 23.71 9.61c1.98.89 2.35 2.42 4.34 2.84c3.02.64 3.27-1.68 3.27-1.68l-.61-.61l.61.6c0 .01 2.33-.24 1.69-3.26z"
            fill="#84b0c1"> </path>
          <path
            d="M117.92 119.15c2.76 2.18 3.79 3.06 3.79 3.06s-.7-2.15-4.62-6.98s-28.88-28.88-28.88-28.88l-1.93 1.93c.01 0 27.31 27.44 31.64 30.87z"
            fill="#000000"> </path>
          <circle cx="85.27" cy="84.86" r="4.56" fill="#000000"> </circle>
          <path
            d="M75.44 51.36c3.77 1.75 8.71 5.69 17.3 11.4c8.8 5.84 8.1 10.26 9.69 15.9c1.38 4.92 4.09 12.22 6.05 17.31c.37.96-1.52 1.09-2.53-.62C94.6 76.11 74.22 59.92 73.39 56.01c-1.03-4.88 2-4.68 2.05-4.65z"
            fill="#a8e3f0"> </path>
          <path
            d="M56.66 54.56S43.05 65.65 44.28 67.6c5.32 8.43 18.12 28.7 22.68 32.32c2.59 2.05 7.76 3.58 16.8 5.86c3.73.94 6.8 1.55 9.61 2.79c1.1.49 1.94-1.06.94-1.72c-9.02-5.97-24.66-15.26-37-32.99c-7.2-10.34-.65-19.3-.65-19.3z"
            fill="#2f7889"> </path>
          <g>
            <path
              d="M19.63 21C25.21 15.41 32.49 10.04 37 6.9a5.822 5.822 0 0 1 7.59.81c16.53 17.66 24.84 27.18 28.25 31.57a4.11 4.11 0 0 1-.34 5.44l-29.36 28.3a4.11 4.11 0 0 1-5.44.34c-4.37-3.39-13.82-11.38-31.31-27.48a5.834 5.834 0 0 1-.83-7.65C8.71 33.75 14.07 26.56 19.63 21z"
              fill="#424242"> </path>
            <path
              d="M34.26 70.6c3.87-5.49 9.73-13.1 17.16-20.67c6.69-6.81 13.35-11.3 18.59-14.14c0 0 2.74.57 3.7 2.5c1.3 2.61.26 4.95-1.21 6.43l-29.36 28.3c-1.47 1.47-4.6 2.81-6.8 1.21c-2.32-1.69-2.08-3.63-2.08-3.63z"
              fill="#ffc107"> </path>
            <path
              d="M61.11 42.71c-2.6 2.53-5.11 5.95-2.21 8.58c1.87 1.7 5.29-.5 6.58-1.75c2.61-2.5 8.75-6.35 5.14-9.82c-3.42-3.29-7.41.95-9.51 2.99z"
              fill="#ffee58"> </path>
            <path
              d="M52.13 38.89c-6.55-5.75-10.53-9.56-15.08-14.11c-6.79-6.79 2.93-13.83 7.49-9.27c5.03 5.03 12.42 13.73 15.37 19.5c1.47 2.88-3.87 7.31-7.78 3.88z"
              fill="#757575"> </path>
          </g>
        </g>
      </svg>
    </span>
    <div>
      <p class="toast-msg"><?= $info ?></p>
    </div>
  </li>
  <?php endforeach; endif; ?>
  <!-- success -->
  <?php
  if(Session::exists('success')): 
    foreach(Session::get('success') as $success): ?>
  <li>
    <span>
      <svg viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        aria-hidden="true" role="img" class="iconify iconify--noto" preserveAspectRatio="xMidYMid meet" fill="#000000">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
          <path
            d="M64.8 120.71c3.68 0 32.11-24.18 48.7-44.07c15.96-19.14 10.2-41.74 6.69-48.03c-4.15-7.43-56.94 17.01-56.94 17.01S14.07 17.99 10.39 23.99C5.4 32.13-1.59 53.54 12.52 73.45C27.5 94.6 60.85 120.71 64.8 120.71z"
            fill="#db0a28"></path>
          <path
            d="M64.55 114.2s52.26-38.68 56.75-62.3c4.25-22.37-4.45-33.22-15.16-38.45C78.99.19 65.29 26.21 64 26.21S49.95.14 23.7 11.42C9.24 17.63 3.18 34.53 8.91 53.57c8.41 27.94 55.64 60.63 55.64 60.63z"
            fill="#ff262e"></path>
        </g>
      </svg>
    </span>
    <div>
      <p class="toast-msg"><?= $success ?></p>
    </div>
  </li>
  <?php endforeach; endif; ?>
</ul>