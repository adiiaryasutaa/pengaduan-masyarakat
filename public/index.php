<?php

require_once(__DIR__ . "\\..\\loader.php");

use Core\Application as App;

$app = new App([
	'paths' => [
		'base' => __DIR__ . "\\..",
		'route' => __DIR__ . "\\..\\app\\routes\\index.php",
	],
]);

$app->start();