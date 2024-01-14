<?php 
    require_once './assets/php/functions.php';

    if(isset($_GET['signup'])) {
    showPage('signupForm', ['page_title' => 'Sign Up']);
    } 