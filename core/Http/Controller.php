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
}