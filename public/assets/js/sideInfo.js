async function toggleSideInfo(element) {
  const sideInfo = document.getElementById('sideInfo')
  sideInfo.classList.toggle('open');
  document.body.classList.toggle("sideInfo-open");
  const infoLink = element.getAttribute("data-info-link");
  console.log(infoLink);

  try {
  const response = await fetch('/api/info/material/1');
  const data = await response.json();
  console.log(data);
  }catch (error) {
    console.error(error);
  }
  
}

const infoTypeSvg = {
  'uploader': `<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" style="flex-shrink: 0" viewBox="0 0 512 512">
  <path d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256v32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32v80 32c0 17.7 14.3 32 32 32s32-14.3 32-32V256c0-106-86-192-192-192zm64 192a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z">
  </path>
</svg>`,
  'author': ` <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
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
  'responded': `<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
  <g id="SVGRepo_iconCarrier">
    <path d="M12.9839 22.4946L13.521 21.5879C13.9375 20.8846 14.1458 20.5329 14.4804 20.3384C14.815 20.144 15.2362 20.1367 16.0786 20.1222C17.3224 20.1008 18.1024 20.0247 18.7566 19.7539C19.9704 19.2515 20.9348 18.2878 21.4375 17.0748C21.6226 16.6283 21.7169 16.123 21.7648 15.4515C21.7903 15.0958 21.803 14.9179 21.708 14.7756C21.6131 14.6332 21.4329 14.5728 21.0723 14.452C19.5606 13.9454 16.0584 12.6565 14.1 11.0008C11.8925 9.13444 9.91782 5.3404 9.21118 3.88615C9.0707 3.59705 9.00047 3.4525 8.87715 3.37622C8.75383 3.29994 8.59743 3.30159 8.28463 3.3049C6.25036 3.32638 5.32915 3.43899 4.36537 4.02919C3.69883 4.43737 3.13843 4.9974 2.72997 5.66349C2 6.85388 2 8.47432 2 11.7152V12.7053C2 15.0118 2 16.1651 2.37707 17.0748C2.87984 18.2878 3.84419 19.2515 5.05797 19.7539C5.71215 20.0247 6.49219 20.1008 7.73591 20.1222C8.57837 20.1367 8.9996 20.144 9.33417 20.3384C9.66874 20.5329 9.87702 20.8846 10.2936 21.5879L10.8307 22.4946C11.3094 23.3028 12.5052 23.3028 12.9839 22.4946Z" fill="currentColor"></path>
    <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M14.8719 0.239228C15.2073 0.55542 15.2039 1.06491 14.8643 1.3772L13.7622 2.39066C14.721 2.39968 15.6433 2.42144 16.4756 2.47388C17.1913 2.51898 17.8616 2.5879 18.4457 2.69609C19.0178 2.80206 19.569 2.95641 20.0069 3.20311C20.8206 3.66166 21.5058 4.29141 22.0058 5.04157C22.4867 5.76328 22.6986 6.57904 22.8003 7.56276C22.8998 8.52518 22.8998 9.72792 22.8998 11.253V11.2953C22.8998 11.7397 22.5129 12.1 22.0355 12.1C21.5582 12.1 21.1712 11.7397 21.1712 11.2953C21.1712 9.7186 21.1703 8.59328 21.0797 7.71697C20.9904 6.85308 20.8201 6.31502 20.5369 5.89005C20.1817 5.35695 19.6936 4.90776 19.1118 4.57993C18.9261 4.47529 18.6031 4.36615 18.1084 4.27451C17.6257 4.18509 17.0367 4.12228 16.3589 4.07957C15.5758 4.03023 14.7025 4.00921 13.7763 4.00026L14.8643 5.00068C15.2039 5.31298 15.2073 5.82246 14.8719 6.13865C14.5364 6.45485 13.9892 6.45801 13.6496 6.14572L11.0568 3.76146C10.8923 3.61027 10.7998 3.40409 10.7998 3.18894C10.7998 2.97379 10.8923 2.76761 11.0568 2.61642L13.6496 0.232165C13.9892 -0.0801259 14.5364 -0.0769636 14.8719 0.239228Z" fill="currentColor"></path>
  </g>
</svg>`,
  'time': `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4c-4.42 0-8 3.58-8 8s3.58 8 8 8s8-3.58 8-8s-3.58-8-8-8m4.25 12.15L11 13V7h1.5v5.25l4.5 2.67z" opacity="0.3"/><path fill="currentColor" d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2M12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8s8 3.58 8 8s-3.58 8-8 8m.5-13H11v6l5.25 3.15l.75-1.23l-4.5-2.67z"/></svg>`,
}

function infoLi(type, text, label={}) {
  return ` <li>
  <span>
    <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
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
    </svg>
  </span>
  <div>
    <h3>
      Uploader
    </h3>
    <div>
      <span>Uploaded by</span>
    </div>
  </div>
</li>`;
}