<?php

namespace Core\Http\Controller;

use Core\Application;

class Controller
{
	public function request()
	{
		return Application::getRequest();
	}
}