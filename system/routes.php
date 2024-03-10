<?php

//routes for login page
$router->get('/login', 'AuthController@login')->only('guest');
$router->post('/login', 'AuthController@loginProcess')->only('guest');
$router->delete('/login', 'AuthController@logout')->only('auth');

//routes for signup page
$router->get('/signup', 'AuthController@signup')->only('guest');
$router->post('/signup', 'AuthController@sihnupProcess')->only('guest');

//routes for notes page
$router->get('/', 'HomeController@index');
$router->get('/notes', 'HomeController@index');

//routes for question page
$router->get('/question', 'HomeController@question');

//routes for lab report page
$router->get('/labreport', 'HomeController@labreport');

//routes for view page
$router->get('/material/view', 'HomeController@view');

//routes for request page
$router->get('/request', 'RequestController@index');
$router->post('/request/category/api', 'RequestController@category');
$router->get('/request/create', 'RequestController@create')->only('auth');
$router->post('/request/store', 'RequestController@store')->only('auth');

//routes for upload page
$router->get('/upload', 'UploadController@index')->only('auth');
$router->post('/upload/store', 'UploadController@store')->only('auth');
$router->post('/upload/respond', 'UploadController@index')->only('auth'); //coming from request page

//routes for profile page
$router->get('/profile', 'ProfileController@index')->only('auth');
$router->post('/follow', 'ProfileController@follow')->only('auth');
$router->delete('/unfollow', 'ProfileController@unfollow')->only('auth');
$router->post('/profile/category/api', 'ProfileController@category');

//routes for like page
$router->post('/like', 'LikeController@store')->only('auth');

//routes for bookmark page
$router->post('/bookmark', 'BookmarkController@store')->only('auth');



