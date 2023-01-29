<?php

use App\Controller\AuthController;
use Core\Application as App;

$route = App::getRouter();

$route->addRoute("GET", "/", function () {
	return view("layouts/main", ['title' => 'Pengaduan Masyarakat'])
		->nest('{% navbar %}', 'components/navbar')
		->nest('{% main %}', 'index')
		->nest('{% footer %}', 'components/footer');
});

$route->addRoute("GET", "/register", function () {
	return view('layouts/auth', ['title' => 'Daftar'])
		->nest('{% main %}', 'register');
});

$route->addRoute("POST", "/register", [AuthController::class, 'store']);