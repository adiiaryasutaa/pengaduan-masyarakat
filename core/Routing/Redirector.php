<?php

namespace Core\Routing;

use Core\Http\RedirectResponse;

class Redirector
{
	public static function to(string $to): RedirectResponse
	{
		return new RedirectResponse($to);
	}

	public static function back(): RedirectResponse
	{
		return self::to($_SERVER['HTTP_REFERER'] ?? '/');
	}
}