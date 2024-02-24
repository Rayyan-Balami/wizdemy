<?php

//routes for login page
$router->get('/login', 'LogController@index')->only('guest');
$router->post('/login', 'LogController@store')->only('guest');
$router->delete('/login', 'LogController@destroy')->only('auth');

//routes for logout page
$router->delete('/logout', 'LogController@destroy')->only('auth');

//routes for register page
$router->get('/register', 'RegisterController@index')->only('guest');
$router->post('/register', 'RegisterController@store')->only('guest');

//routes for notes page
$router->get('/', 'HomeController@index');
$router->get('/notes', 'HomeController@index');

//routes for question page
$router->get('/question', 'HomeController@question');

//routes for lab report page
$router->get('/labreport', 'HomeController@labreport');

//routes for request page
$router->get('/request', 'RequestController@index');
$router->post('/request/api', 'RequestController@category');
$router->get('/request/create', 'RequestController@create')->only('auth');
$router->post('/request/store', 'RequestController@store')->only('auth');

//routes for upload page
$router->get('/upload', 'UploadController@index')->only('auth');
$router->post('/upload/store', 'UploadController@store')->only('auth');
$router->post('/upload/respond', 'UploadController@index')->only('auth'); //coming from request page

//routes for profile page
$router->get('/profile', 'ProfileController@index')->only('auth'); //for logged in user
$router->get('/profile/user', 'ProfileController@show'); //for other users
$router->post('/follow', 'ProfileController@follow')->only('auth');
$router->delete('/unfollow', 'ProfileController@unfollow')->only('auth');

//routes for like page
$router->post('/like', 'LikeController@store')->only('auth');

//routes for bookmark page
$router->post('/bookmark', 'BookmarkController@store')->only('auth');



