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

Route::controller('/', 'HomeController');

Route::get('test', 'TestController@showWelcome');

Route::controller('login', 'LoginController');
Route::get('logout', 'LoginController@getLogout');

Route::controller('register', 'RegisterController');

Route::controller('password', 'PasswordController');

// Start of private routes protected with auth


Route::controller('dashboard', 'DashboardController');

Route::controller('about', 'AboutController');
