<?php
// validate p2 as phone number
$router->get('/test/{p1}/{p2}', 'TestController@test');
$router->put('/test/{p1}/{p2}', 'TestController@testPut');

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
$router->get('/', 'HomeController@index')->only('auth');
$router->get('/note', 'HomeController@index')->only('auth');

//routes for question page
$router->get('/question', 'HomeController@question')->only('auth');

//routes for lab report page
$router->get('/labreport', 'HomeController@labreport')->only('auth');

//routes for view page
$router->get('/material/view/{material_id}', 'HomeController@view')->only('auth');

//routes for request page
$router->get('/request', 'RequestController@index')->only('auth');
$router->post('/api/request/category', 'RequestController@category');

//routes for create of request
$router->get('/request/create', 'RequestController@create')->only('auth');
$router->post('/request/store', 'RequestController@store')->only('auth');

//routes for upload of material
$router->get('/material/create', 'UploadController@index')->only('auth');
$router->post('/material/store', 'UploadController@store')->only('auth');

//routes for upload of material (comming from request)
$router->post('/material/respond/{request_id}', 'UploadController@index')->only('auth'); 
$router->post('/material/respond/store/{request_id}', 'UploadController@store')->only('auth');

//routes for edit of material
$router->get('/material/edit', 'UploadController@edit')->only('auth');
$router->post('/material/edit/{material_id}', 'UploadController@edit')->only('auth');
$router->put('/material/update/{material_id}', 'UploadController@update')->only('auth');

//routes for delete material
$router->delete('/api/material/delete/{material_id}', 'UploadController@delete')->only('apiAuth');


//routes for edit of request
$router->get('/request/edit', 'RequestController@edit')->only('auth');
$router->post('/request/edit/{request_id}', 'RequestController@edit')->only('auth');
$router->put('/request/update/{material_id}', 'RequestController@update')->only('auth');

//routes for delete request
$router->delete('/api/request/delete/{request_id}', 'RequestController@delete')->only('apiAuth');

//routes for project page
$router->get('/project', 'ProjectController@index')->only('auth');

//routes for create of project
$router->get('/project/create', 'ProjectController@create')->only('auth');
$router->post('/project/store', 'ProjectController@store')->only('auth');

//routes for edit of project
$router->get('/project/edit', 'ProjectController@edit')->only('auth');
$router->post('/project/edit/{project_id}', 'ProjectController@edit')->only('auth');
$router->put('/project/update/{project_id}', 'ProjectController@update')->only('auth');

//routes for delete project
$router->delete('/api/project/delete/{project_id}', 'ProjectController@delete')->only('apiAuth');

//routes for profile page
$router->get('/profile', 'ProfileController@index')->only('auth');
$router->get('/profile/{user_id}', 'ProfileController@index')->only('auth');
$router->post('/follow/{user_id}', 'FollowController@follow')->only('auth');
$router->delete('/unfollow/{user_id}', 'FollowController@unfollow')->only('auth');
$router->post('/api/profile/myMaterials', 'ProfileController@myMaterials')->only('apiAuth');
$router->post('/api/profile/myRequests', 'ProfileController@myRequests')->only('apiAuth');
$router->post('/api/profile/myProjects', 'ProfileController@myProjects')->only('apiAuth');


//routes for like study material
$router->get('/like', 'LikeController@index')->only('auth');
$router->post('/api/material/like/{material_id}', 'LikeController@like')->only('apiAuth');
$router->delete('/api/material/unlike/{material_id}', 'LikeController@unlike')->only('apiAuth');

//routes for bookmark page
$router->get('/bookmark', 'BookmarkController@index')->only('auth');
$router->post('/api/material/bookmark/{material_id}', 'BookmarkController@bookmark')->only('apiAuth');
$router->delete('/api/material/unbookmark/{material_id}', 'BookmarkController@unbookmark')->only('apiAuth');


//routes for settings page (myInformation, accountSecurity)
$router->get('/myInformation', 'SettingsController@myInformation')->only('auth');
$router->put('/myInformation/profile', 'SettingsController@profile')->only('auth');
$router->put('/myInformation/personal', 'SettingsController@personal')->only('auth');

$router->get('/accountSecurity', 'SettingsController@accountSecurity')->only('auth');
$router->put('/accountSecurity/password', 'SettingsController@password')->only('auth');
$router->put('/accountSecurity/preferences', 'SettingsController@preferences')->only('auth');


//routes for admin auth page
$router->get('/admin/login', 'AdminAuthController@loginPage')->only('guest');
$router->post('/admin/login', 'AdminAuthController@loginProcess')->only('guest');
$router->delete('/admin/logout', 'AdminAuthController@logout')->only('admin');
//routes for admin dashboard
$router->get('/admin/dashboard', 'AdminDashboardController@index')->only('admin');


//routes for admin users management
$router->get('/admin/manage/users', 'AdminManageUserController@index')->only('admin');
$router->post('/api/admin/update/users/status', 'AdminManageUserController@updateUserStatus')->only('apiAdmin');
$router->delete('/api/admin/delete/user/{user_id}', 'AdminManageUserController@delete')->only('apiAdmin');
$router->get('/admin/edit/user', 'AdminManageUserController@edit')->only('admin');
$router->post('/admin/edit/user/{user_id}', 'AdminManageUserController@edit')->only('admin');
$router->put('/admin/update/user/profile/{user_id}', 'AdminManageUserController@updateUserProfile')->only('admin');
$router->put('/admin/update/user/info/{user_id}', 'AdminManageUserController@updateUserInfo')->only('admin');
$router->put('/admin/update/user/password/{user_id}', 'AdminManageUserController@updatePassword')->only('admin');


//routes for admin project management
$router->get('/admin/manage/projects', 'AdminManageProjectController@index')->only('admin');

//routes for admin requests management
$router->get('/admin/manage/material', 'AdminManageRequestController@index')->only('admin');

//routes for admin materials management
$router->get('/admin/manage/requests', 'AdminManageMaterialController@index')->only('admin');


// routes for admin manage admin
$router->get('/admin/manage/admin', 'AdminManageAdminController@index')->only('admin');
$router->post('/api/admin/update/admin/status', 'AdminManageAdminController@updateAdminStatus')->only('apiAdmin');
$router->delete('/api/admin/delete/admin/{admin_id}', 'AdminManageAdminController@delete')->only('apiAdmin');
