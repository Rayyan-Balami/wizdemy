<?php

//routes for login page
$router->get('/login', 'AuthController@login')->only('guest');
$router->post('/login', 'AuthController@loginProcess')->only('guest');
$router->delete('/logout', 'AuthController@logout')->only('auth');

//auth status api to use in javascript
$router->post('/api/authStatus', 'AuthController@authStatusAPI');

//routes for signup page
$router->get('/signup', 'AuthController@signup')->only('guest');
$router->post('/signup', 'AuthController@signupProcess')->only('guest');

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
$router->post('/api/request/category', 'RequestController@category');
$router->get('/request/create', 'RequestController@create')->only('auth');
$router->post('/request/store', 'RequestController@store')->only('auth');

//routes for upload page
$router->get('/material/create', 'UploadController@index')->only('auth');
$router->post('/material/store', 'UploadController@store')->only('auth');
$router->post('/material/respond', 'UploadController@index')->only('auth'); //coming from request page

//routes for add project page
$router->get('/project', 'ProjectController@index');
$router->get('/project/create', 'ProjectController@create')->only('auth');
$router->post('/project/store', 'ProjectController@store')->only('auth');

//routes for profile page
$router->get('/profile', 'ProfileController@index')->only('auth');
$router->post('/follow', 'ProfileController@follow')->only('auth');
$router->delete('/unfollow', 'ProfileController@unfollow')->only('auth');
$router->post('/api/profile/category', 'ProfileController@category');
$router->post('/api/profile/myRequests', 'ProfileController@myRequests');


//routes for like page
$router->post('/like', 'LikeController@store')->only('auth');

//routes for bookmark page
$router->post('/bookmark', 'BookmarkController@store')->only('auth');

//routes for settings page (myInformation, accountSecurity)
$router->get('/myInformation', 'SettingsController@myInformation')->only('auth');
$router->put('/myInformation/profile', 'SettingsController@profile')->only('auth');
$router->put('/myInformation/personal', 'SettingsController@personal')->only('auth');

$router->get('/accountSecurity', 'SettingsController@accountSecurity')->only('auth');
$router->put('/accountSecurity/password', 'SettingsController@password')->only('auth');
$router->put('/accountSecurity/preferences', 'SettingsController@preferences')->only('auth');



