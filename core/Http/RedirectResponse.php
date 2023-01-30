<?php

namespace Core\Http;

use Core\Application as App;

class RedirectResponse
{
	public function flash(array $data)
	{
		$session = App::getSessionManager();

		$session->set('__.flash', $data);
	}

	public function error(array $errors)
	{
		$session = App::getSessionManager();

		$session->set('__.error', $errors);
	}
}