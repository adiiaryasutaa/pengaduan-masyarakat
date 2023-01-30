<?php

use Core\Application;
use Core\Session\SessionManager;

function session(string $key = null, $default = null)
{
	$session = Application::getSessionManager();

	if (is_null($key)) {
		return $session;
	}

	return $session->get($key, $default);
}

function auth()
{
	return Application::getAuth();
}