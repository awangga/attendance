<?php

if (App::runningInConsole()) {
	return;
}



//route by domain
foreach (Domain::all() as $dcp) {
	Route::group(array(
		'domain' => $dcp['domain'] 
	), function () use($dcp) {
		if (!Cookie::get('domain_hash')) {
			Route::get('/', 'PanelController@dcp');
		}
	});
}



Route::get('test', 'TestController@showWelcome');

Route::controller('login', 'LoginController');
Route::get('logout', 'LoginController@getLogout');

Route::controller('register', 'RegisterController');

Route::controller('password', 'PasswordController');

// Start of private routes protected with auth

Route::resource('profile', 'ProfileController', array(
	'only' => array(
		'index',
		'update' 
	) 
));

Route::resource('user', 'UserController', array(
	'only' => array(
		'index',
		'update' 
	) 
));

Route::controller('dashboard', 'DashboardController');

Route::controller('attendance','AttendanceController');

Route::controller('about', 'AboutController');

Route::controller('/', 'HomeController');
