<?php

namespace Core\Routing;

class Redirector
{
	public static function to(string $to)
	{
		header("Location: $to", 301);
		exit();
	}

	public static function back()
	{
		if (isset($_SERVER['HTTP_REFERER'])) {
			return self::to($_SERVER['HTTP_REFERER']);
		}
	}
}