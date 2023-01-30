<?php

$dirs = [
	// Core
	__DIR__ . '\\core',
	__DIR__ . '\\core\\Auth',
	__DIR__ . '\\core\\Config',
	__DIR__ . '\\core\\Database',
	__DIR__ . '\\core\\Http',
	__DIR__ . '\\core\\Routing',
	__DIR__ . '\\core\\Session',
	__DIR__ . '\\core\\Support',
	__DIR__ . '\\core\\View',

	// Controller
	__DIR__ . '\\app\\Controllers',

	// Model
	__DIR__ . '\\app\\Models',
];

foreach ($dirs as $dir) {
	foreach (glob("$dir\\*.php") as $file) {
		require_once $file;
	}
}