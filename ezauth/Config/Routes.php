<?php

$routes->group('/', ['namespace' => 'EZAuth\Controllers'], function($routes) {

	$routes->get('register', 'RegisterController::index');
	$routes->post('register', 'RegisterController::save');
	$routes->get('login', 'LoginController::showForm', ['as' => 'login']);

});
