<?php

namespace core\Http;

class Request
{
	public function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	public function uri()
	{
		return trim($_SERVER['REQUEST_URI'], '/');
	}

	public function post(string $key)
	{
		return $_POST[$key];
	}

	public function string(string $name)
	{
		return (string) $this->post($name);
	}
}