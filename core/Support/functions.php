<?php

use Core\Application as App;
use Core\Routing\Redirector;
use core\View\View;

function fromBasePath(string $path)
{
	return App::getBasePath() . "\\$path";
}

function asset(string $path)
{
	return "http://pen-mas.test\\$path";
}

function view(string $name, array $data = [], array $nests = []): View
{
	return new View($name, $data, $nests);
}

function dd(...$vars)
{
	echo "<pre>";
	var_dump(...$vars);
	echo "</pre>";
	exit();
}

function flash(string $key, $default = null)
{
	$session = App::getSessionManager();

	return $session->pull("__.flash.$key") ?? $default;
}

function redirect(string $to)
{
	return Redirector::to($to);
}

function back()
{
	return Redirector::back();
}