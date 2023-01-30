<?php

namespace Core\Session;

use Core\Support\Arr;

class SessionManager
{
	public function __construct(?string $cacheExpire = null, ?string $cacheLimiter = null)
	{
		$this->startIfOff($cacheExpire, $cacheLimiter);
	}

	public function startIfOff(?string $cacheExpire = null, ?string $cacheLimiter = null)
	{
		if (session_status() === PHP_SESSION_NONE) {

			if ($cacheLimiter !== null) {
				session_cache_limiter($cacheLimiter);
			}

			if ($cacheExpire !== null) {
				session_cache_expire($cacheExpire);
			}

			session_start();
		}
	}

	public function regenerate()
	{
		session_regenerate_id();

		return $this;
	}

	public function get(string $key, $default = null)
	{
		$this->startIfOff();

		return Arr::get($_SESSION, $key, $default);
	}

	public function pull(string $key, $default = null)
	{
		$value = $this->get($key, $default);
		$this->remove($key);
		return $value;
	}

	public function set(string $key, $value): self
	{
		$this->startIfOff();

		Arr::set($_SESSION, $key, $value);

		return $this;
	}

	public function remove(string $key): void
	{
		$this->startIfOff();

		Arr::remove($_SESSION, $key);
	}

	public function clear(): void
	{
		$this->startIfOff();

		session_unset();
	}

	public function has(string $key): bool
	{
		$this->startIfOff();

		return Arr::has($_SESSION, $key);
	}

	public function flash(string|array $keys, $value = null)
	{
		if (is_string($keys)) {
			$this->set("__flash__.$keys", $value);
		} else {
			foreach ($keys as $key => $value) {
				$this->flash($key, $value);
			}
		}

		return $this;
	}

	public function error(string|array $keys, $value = null)
	{
		if (is_string($keys)) {
			$this->set("__error__.$keys", $value);
		} else {
			foreach ($keys as $key => $value) {
				$this->error($key, $value);
			}
		}

		return $this;
	}

	public function flashExists()
	{
		return Arr::has($_SESSION, '__flash__');
	}

	public function hasFlash(string $key): bool
	{
		$this->startIfOff();

		return $this->flashExists() && Arr::has($_SESSION['__flash__'], $key);
	}

	public function getFlash(string $key, $default = null)
	{
		return $this->pull("__flash__.$key", $default);
	}

	public function errorExists()
	{
		return Arr::has($_SESSION, '__error__');
	}

	public function hasError(string $key): bool
	{
		$this->startIfOff();

		return $this->errorExists() && Arr::has($_SESSION['__error__'], $key);
	}

	public function getError(string $key, $default = null)
	{
		return $this->pull("__error__.$key", $default);
	}

	public function input(string|array $keys, $value = null)
	{
		if (is_string($keys)) {
			$this->set("__old__.$keys", $value);
		} else {
			foreach ($keys as $key => $value) {
				$this->input($key, $value);
			}
		}

		return $this;
	}

	public function old(string $name, $default = null)
	{
		return $this->pull("__old__.$name", $default);
	}

	public function resetInput()
	{
		$this->remove('__old__');

		return $this;
	}
}