<?php

$files = [
	// core
	__DIR__ . '\\core\\Application.php',
	__DIR__ . '\\core\\Auth\\Auth.php',
	__DIR__ . '\\core\\Database\\Connection.php',
	__DIR__ . '\\core\\Database\\Model.php',
	__DIR__ . '\\core\\Http\\Controller.php',
	__DIR__ . '\\core\\Http\\Request.php',
	__DIR__ . '\\core\\Http\\Response.php',
	__DIR__ . '\\core\\Http\\RedirectResponse.php',
	__DIR__ . '\\core\\Routing\\Router.php',
	__DIR__ . '\\core\\Routing\\Redirector.php',
	__DIR__ . '\\core\\Session\\SessionManager.php',
	__DIR__ . '\\core\\Support\\Arr.php',
	__DIR__ . '\\core\\Support\\app.php',
	__DIR__ . '\\core\\Support\\functions.php',
	__DIR__ . '\\core\\View\\View.php',

	// project
	__DIR__ . '\\app\\models\\Laporan.php',
	__DIR__ . '\\app\\models\\User.php',

	__DIR__ . '\\app\\controllers\\AuthController.php',
	__DIR__ . '\\app\\controllers\\LaporController.php',
];

foreach ($files as $file) {
	require_once($file);
}