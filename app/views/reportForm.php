<?php
View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Report',
  'stylesheets' => [
    'ReportForm'
  ],
  'scripts' => [
    'script',
    'searchOverlay',
    'toastTimer',
    'confirmModal',
    'timeAgo',
    'authFormValidation',
  ]
]);

$flashOld = Session::get('old');

View::renderPartial('SideNav');

View::renderPartial('MenuHeader');

?>
<!-- New Request title -->
<div class="title-label">

  <div>
    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
      <g id="SVGRepo_iconCarrier">
        <path fill-rule="evenodd" clip-rule="evenodd"
          d="M6.5 1.75C6.5 1.33579 6.16421 1 5.75 1C5.33579 1 5 1.33579 5 1.75V21.75C5 22.1642 5.33579 22.5 5.75 22.5C6.16421 22.5 6.5 22.1642 6.5 21.75V13.6V3.6V1.75Z"
          fill="currentColor"></path>
        <path opacity="0.3"
          d="M13.5582 3.87333L13.1449 3.70801C11.5821 3.08288 9.8712 2.9258 8.22067 3.25591L6.5 3.60004V13.6L8.22067 13.2559C9.8712 12.9258 11.5821 13.0829 13.1449 13.708C14.8385 14.3854 16.7024 14.5119 18.472 14.0695L18.5721 14.0445C19.1582 13.898 19.4361 13.2269 19.1253 12.7089L17.5647 10.1078C17.2232 9.53867 17.0524 9.25409 17.0119 8.94455C16.9951 8.81543 16.9951 8.68466 17.0119 8.55553C17.0524 8.24599 17.2232 7.96141 17.5647 7.39225L18.8432 5.26136C19.1778 4.70364 18.6711 4.01976 18.0401 4.17751C16.5513 4.54971 14.9831 4.44328 13.5582 3.87333Z"
          fill="currentColor"></path>
      </g>
    </svg>
  </div>

  <h2 class="title">
    Initiate Report
  </h2>

  <p class="message">
    Inappropriate, non-credit, or irrelevant content?
  </p>

</div>

<!-- .form-section  -->
<div class="form-section">
  <h2 class="form-heading">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
      <path fill="currentColor" fill-rule="evenodd"
        d="M12.238 3.64a1.854 1.854 0 0 0-1.629-1.628l-.8.8a3.367 3.367 0 0 1 1.63 1.628zM4.74 7.88l3.87-3.868a1.854 1.854 0 0 1 1.628 1.629L6.369 9.51a1.5 1.5 0 0 1-.814.418l-1.48.247l.247-1.48a1.5 1.5 0 0 1 .418-.814ZM9.72.78l-2 2l-4.04 4.04a3 3 0 0 0-.838 1.628L2.48 10.62a1 1 0 0 0 1.151 1.15l2.17-.36a3 3 0 0 0 1.629-.839l4.04-4.04l2-2c.18-.18.28-.423.28-.677A3.353 3.353 0 0 0 10.397.5c-.254 0-.498.1-.678.28ZM2.75 13a.75.75 0 0 0 0 1.5h10.5a.75.75 0 0 0 0-1.5z"
        clip-rule="evenodd" />
    </svg>
    Report Details
  </h2>
  <p class="form-info">
    If false report is made from your side, you will be suspended / banned from the platform.
  </p>
  <!-- form -->
  <form action="/report/store/<?= $targetType ?>/<?= $targetId ?>" id="reportForm" method="post">

    <?php if ($targetType == "material" || $targetType == "project"):  //material and project have thumbnail so we can show it
        $link = "";
        $src = "";
        if ($targetType == "material") {
          $link = "/material/view/" . $reportDetails['material_id'];
          $src = '/' . $reportDetails['thumbnail_path'];
        } else if ($targetType == "project") {
          $link = $reportDetails['repo_link'];
          $repo_info = str_replace("https://github.com/", "", $reportDetails['repo_link']);
          //explode the repo_info to get the owner and repo name
          $owner = explode("/", $repo_info)[0];
          $repo = explode("/", $repo_info)[1];
          $src = "https://opengraph.githubassets.com/".SITE_NAME."/" . $repo_info;
        }
        ?>

      <!-- thumbnail element  -->
      <div class="card project-card">
        <a href="<?= $link ?>" class="thumbnail">
          <img src="<?= $src ?>" alt="thumbnail">
          <div>
            <?php if ($reportDetails['status'] === 'suspend'): ?>
              <div class="suspended-svg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <g fill="none" stroke="currentColor" stroke-width="1.7">
                    <path stroke-linecap="round" d="M16 12H8" />
                    <circle cx="12" cy="12" r="10" />
                  </g>
                </svg> Suspended
              </div>
            <?php endif; ?>

            <?php if ($targetType == 'material'): ?>
              <?php if ($reportDetails['responded_to'] ?? false): ?>
                <!-- is responded post to request ?  -->
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
                </div>
                <!-- document formay (handwritten, typed, photo) -->
              <?php endif; ?>

              <div class="document-format">
                <?php if ($reportDetails['format'] === 'handwritten'): ?>
                  <!-- handwritten svg  -->
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
                  </svg>
                <?php elseif ($reportDetails['format'] === 'typed'): ?>
                  <!-- typed svg  -->
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
                  </svg>
                <?php elseif ($reportDetails['format'] === 'photo'): ?>
                  <!-- photo svg  -->
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
                  </svg>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>
        </a>
      </div>

    <?php endif; ?>

    <!-- details of the post/ user that is being reported  -->
    <?php if (!empty($reportDetails)): ?>
      <div class="post-details">

        <?php if ($targetType == "material" || $targetType == "request" || $targetType == "project"): ?>
          <p class="post-subject">
            <?= $targetType == 'project' ? 'Github / '.$owner : $reportDetails['subject'] ?>
          </p>
          <h3 class="post-title">
            <?= $targetType == 'project' ? $repo : $reportDetails['title'] ?>
          </h3>
        <?php endif; ?>
          <?php if ($targetType == "material" || $targetType == "request"): ?>
          <p class="post-description">
            <?= $reportDetails['description'] ?>
          </p>
        <?php endif; ?>

        <div class="post-meta-datas">
          <a href="/profile/<?= $reportDetails['user_id'] ?>" class="username">
            <svg xmlns="http://www.w3.org/2000/svg" height="14" width="14" fill="currentColor" style="flex-shrink: 0"
              viewBox="0 0 512 512">
              <path
                d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256v32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32v80 32c0 17.7 14.3 32 32 32s32-14.3 32-32V256c0-106-86-192-192-192zm64 192a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z">
              </path>
            </svg>
            <h3>
              <?= $reportDetails['username'] ?>
            </h3>
            <?php if ($targetType != "user"): ?>
            <span>·</span>
              <p class="time-ago" data-datetime="<?= $reportDetails['created_at'] ?>">
              </p>
            <?php endif; ?>
          </a>

          <?php if ($targetType == "user"): ?>
            <p>FullName :
              <?= $reportDetails['full_name'] ?>
            </p>
            <p>Joined :
              <?= date('jS M Y', strtotime($reportDetails['created_at'])) ?>
            </p>
            <p>Email :
              <?= $reportDetails['email'] ?>
            </p>
            <p>Posts :
            <?= $reportDetails['materials_count'] + $reportDetails['requests_count'] + $reportDetails['project_count'] ?>
            </p>
            <span>Materials:
              <?= $reportDetails['materials_count'] ?>
            </span>
            <span>Requests:
              <?= $reportDetails['requests_count'] ?>
            </span>
            <span>Projects:
              <?= $reportDetails['project_count'] ?>
            </span>
            <span>Follower :
              <?= $reportDetails['followers_count'] ?>
            </span>
            <span>Following :
              <?= $reportDetails['following_count'] ?>
            </span>
          <?php endif; ?>

          <?php if ($targetType == "request"): ?>
            <p class="no-of-responses">Responds :
              <?= $reportDetails['no_of_materials'] ?>
            </p>
          <?php endif; ?>

          <?php if ($targetType == "material"): ?>
            <p>
              Views :
              <?= $reportDetails['views_count'] ?>
            </p>
            <p class="no-of-responses">Likes :
              <?= $reportDetails['likes_count'] ?>
            </p>
            <p>
              Comments :
              <?= $reportDetails['comments_count'] ?>
            </p>
          <?php endif; ?>

          <?php if ($targetType == "material" || $targetType == "request"): ?>
          <p class="document-type">Document <?= $targetType == 'request' ? 'Need' : 'Type' ?> :
            <?php if ($reportDetails['document_type'] === 'labreport'): ?>
              Lab Report
            <?php else:
              echo $reportDetails['document_type'];
            endif; ?>
          </p>
          <?php endif; ?>

          <?php if ($targetType == "material" || $targetType == "request"): ?>
            <span>#
              <?= $reportDetails['class_faculty'] ?>
            </span>
            <span>#
              <?= $reportDetails['education_level'] ?>
            </span>
            <?php if (!empty($reportDetails['semester'])): ?>
              <span>#
                <?= $reportDetails['semester'] ?> Sem
              </span>
            <?php endif; ?>

          <?php endif; ?>

          <?php if ($reportDetails['status'] === 'suspend'): ?>
            <span class="suspended-svg">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g fill="none" stroke="currentColor" stroke-width="3">
                  <path stroke-linecap="round" d="M16 12H8" />
                  <circle cx="12" cy="12" r="10" />
                </g>
              </svg> Suspended</span>
          <?php endif; ?>

        </div>
      </div>
    <?php endif; ?>

    <!-- title (required)-->
    <div class="title">
      <label for="title">Title</label>
      <input type="text" placeholder="Inappropriate Post" required name="title" id="title"
        value="<?= $flashOld['title'] ?? '' ?>">
    </div>

    <!-- description (required)-->
    <div class="description">
      <label for="description">Description</label>
      <textarea required id="description" name="description" rows="3"><?= $flashOld['description'] ?? '' ?></textarea>

      <p class="mt-2 text-sm text-gray-600">
        Describe why you think this post is inappropriate.
      </p>
    </div>

    <!-- save button -->
    <button type="submit" name="submitBtn">
      Report
    </button>
  </form>
</div>

</main>
<?php

View::renderPartial('SearchOverlay');

View::renderPartial('ToastNotification');

View::renderPartial('ConfirmModal');

View::renderPartial('EndOfHTMLDocument');

?>