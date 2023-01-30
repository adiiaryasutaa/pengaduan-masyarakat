<?php

namespace Core\Session;

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

	public function get(string $key)
	{
		$this->startIfOff();

		if ($this->has($key)) {
			return $_SESSION[$key];
		}

		return null;
	}

	public function pull(string $key)
	{
		$value = $this->get($key);
		$this->remove($key);
		return $value;
	}

	public function set(string $key, $value): self
	{
		$this->startIfOff();

		$_SESSION[$key] = $value;

		return $this;
	}

	public function remove(string $key): void
	{
		$this->startIfOff();

		if ($this->has($key)) {
			unset($_SESSION[$key]);
		}
	}

	public function clear(): void
	{
		$this->startIfOff();

		session_unset();
	}

	public function has(string $key): bool
	{
		$this->startIfOff();

		return array_key_exists($key, $_SESSION);
	}
}