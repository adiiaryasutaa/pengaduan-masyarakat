<?php

namespace Core\Http;

use Core\Application;
use Core\Routing\Redirector;

class Controller
{
	public function request()
	{
		return Application::getRequest();
	}

	public function redirect(string $to)
	{
		Redirector::to($to);
	}

	public function back()
	{
		Redirector::back();
	}

	public function auth()
	{
		return Application::getAuth();
	}

	public function flash(string $key, $value)
	{
		$session = Application::getSessionManager();

		$session->set("__.flash.$key", $value);
	}
}