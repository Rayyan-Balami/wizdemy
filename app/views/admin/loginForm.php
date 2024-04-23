<?php

View::renderPartial('Header', [
  'pageTitle' => SITE_NAME . ' | Admin Log In',
  'stylesheets' => [
    'authForm',
    'adminAuthForm'
  ],
  'scripts' => [
    'toastTimer',
    'authFormValidation',
  ]
]);

$flashOld = Session::get('old');

?>
<main>
  <section class="form-section">

    <div>
    <form action="/admin/login" method="post">
    <h2>
      Admin Login
        </h2>
        <!-- email -->
        <div class="email">
          <label for="$email_username">Email or Username</label>
          <input type="text" placeholder="WizDemy@gmail.com" required name="email_username" id="email_username"
            value="<?= $flashOld['email_username'] ?? ''; ?>" />
        </div>
        <!-- password -->
        <div class="password">
          <label for="password">Password</label>
          <input type="password" placeholder="••••••••" required name="password" id="password" />
        </div>
        <!-- login button -->

        <button type="submit" value="submit" name="submitBtn">
          Log In
        </button>

      </form>

    </div>

    <div class="text-infos">
      <div class="logo">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <g fill="none" fill-rule="evenodd">
            <path
              d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
            <path fill="currentColor"
              d="M5.708 13.35c.625-1.92 1.75-4.379 3.757-6.386c3.934-3.934 9.652-4.515 9.797-4.53a1.005 1.005 0 0 1 .944.454c.208.313 1.38 2.283-.191 4.663a2.63 2.63 0 0 1-.276.344a.996.996 0 0 1-.03.37c-.19.689-.434 1.412-.75 2.135c-.551 1.263-1.328 2.54-2.423 3.636c-2.05 2.05-4.742 2.991-6.844 3.43a19.357 19.357 0 0 1-2.883.378C6.778 18.09 6.5 20.57 6.5 21a1 1 0 1 1-2 0c0-.571.116-1.67.221-2.56c.205-1.732.446-3.427.987-5.09m12.637-6.9c.527-.8.52-1.48.415-1.92c-1.527.275-5.219 1.186-7.881 3.849c-1.704 1.703-2.7 3.84-3.269 5.59a17.75 17.75 0 0 0-.494 1.85a17.417 17.417 0 0 0 2.167-.31c1.92-.402 4.179-1.228 5.838-2.888c.85-.85 1.484-1.857 1.954-2.905c-.976.52-2.018.986-2.759 1.233a1 1 0 1 1-.632-1.898c.674-.225 1.758-.713 2.754-1.265c.494-.274.946-.553 1.301-.808c.384-.276.56-.46.606-.529Z" />
          </g>
        </svg>
      </div>
      <h3>Rock the Future: WizDemy</h3>
      <p> the classroom is wherever you are, and the possibilities are limitless. Join the movement, join WizDemy !</p>
      <a href="#">Read more about our app
        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 5h12m0 0L9 1m4 4L9 9" />
        </svg>
      </a>
    </div>

  </section>
</main>

<?php

View::renderPartial('ToastNotification');

View::renderPartial('EndOfHTMLDocument');

?>