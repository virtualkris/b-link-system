<?php

$router->get('login', 'AuthController@login');
$router->post('login', 'AuthController@authenticate');
$router->get('logout', 'AuthController@logout');

$router->get('dashboard', 'DashboardController@index');

$router->get('residents', 'ResidentController@index');
$router->get('residents/create', 'ResidentController@create');
$router->post('residents/store', 'ResidentController@store');
$router->get('residents/{id}/edit', 'ResidentController@edit');
$router->post('residents/{id}/update', 'ResidentController@update');
$router->post('residents/{id}/archive', 'ResidentController@archive');
$router->get('residents/{id}', 'ResidentController@show');

$router->get('documents', 'DocumentController@index');
$router->get('documents/create', 'DocumentController@create');
$router->post('documents/store', 'DocumentController@store');
$router->get('documents/{id}/print', 'DocumentController@print');

$router->get('disaster', 'DisasterController@index');
$router->post('disaster/reports/store', 'DisasterController@storeReport');
$router->post('disaster/reports/{id}/status', 'DisasterController@updateReportStatus');

$router->get('users', 'UserController@index');
$router->get('users/create', 'UserController@create');
$router->post('users/store', 'UserController@store');

$router->get('households', 'HouseholdController@index');
$router->get('households/create', 'HouseholdController@create');
$router->post('households/store', 'HouseholdController@store');
$router->get('households/{id}/edit', 'HouseholdController@edit');
$router->get('households/{id}', 'HouseholdController@show');
$router->post('households/{id}/update', 'HouseholdController@update');
