<?php

use App\Controller\AuthController;
use App\Controller\LaporController;
use Core\Application as App;

$route = App::getRouter();

$route->addRoute("GET", "/", function () {
	return view("layouts/main", ['title' => 'Pengaduan Masyarakat'])
		->nest('{% navbar %}', 'components/navbar')
		->nest('{% main %}', 'index')
		->nest('{% footer %}', 'components/footer');
});

$route->addRoute("POST", "/lapor", [LaporController::class, 'store']);

$route->addRoute("GET", "/register", [AuthController::class, 'register']);
$route->addRoute("POST", "/register", [AuthController::class, 'store']);
$route->addRoute("GET", "/login", [AuthController::class, 'login']);
$route->addRoute("POST", "/login", [AuthController::class, 'authenticate']);
$route->addRoute("POST", "/logout", [AuthController::class, 'logout']);