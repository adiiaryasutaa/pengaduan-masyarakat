<?php

namespace Core\Support;

class Arr
{
	public static function get($array, string|int $key, mixed $default = null)
	{
		if (self::exists($array, $key)) {
			return $array[$key];
		}

		if (!str_contains($key, '.')) {
			return $array[$key] ?? $default;
		}

		foreach (explode('.', $key) as $segment) {
			if (is_array($array) && self::exists($array, $segment)) {
				$array = $array[$segment];
			} else {
				return $default;
			}
		}

		return $array;
	}

	public static function has($array, string|array $keys)
	{
		$keys = (array) $keys;

		if (!$array || $keys === []) {
			return false;
		}

		foreach ($keys as $key) {
			$subKeyArray = $array;

			if (static::exists($array, $key)) {
				continue;
			}

			foreach (explode('.', $key) as $segment) {
				if (is_array($array) && static::exists($subKeyArray, $segment)) {
					$subKeyArray = $subKeyArray[$segment];
				} else {
					return false;
				}
			}
		}

		return true;
	}

	public static function set(&$array, $key, $value)
	{
		if (is_null($key)) {
			return $array = $value;
		}

		$keys = explode('.', $key);

		foreach ($keys as $i => $key) {
			if (count($keys) === 1) {
				break;
			}

			unset($keys[$i]);

			// If the key doesn't exist at this depth, we will just create an empty array
			// to hold the next value, allowing us to create the arrays to hold final
			// values at the correct depth. Then we'll keep digging into the array.
			if (!isset($array[$key]) || !is_array($array[$key])) {
				$array[$key] = [];
			}

			$array = & $array[$key];
		}

		$array[array_shift($keys)] = $value;

		return $array;
	}

	public static function remove(&$array, $keys)
	{
		$original = & $array;

		$keys = (array) $keys;

		if (count($keys) === 0) {
			return;
		}

		foreach ($keys as $key) {
			// if the exact key exists in the top-level, remove it
			if (static::exists($array, $key)) {
				unset($array[$key]);

				continue;
			}

			$parts = explode('.', $key);

			// clean up before each pass
			$array = & $original;

			while (count($parts) > 1) {
				$part = array_shift($parts);

				if (isset($array[$part]) && is_array($array[$part])) {
					$array = & $array[$part];
				} else {
					continue 2;
				}
			}

			unset($array[array_shift($parts)]);
		}
	}

	public static function exists($array, string|int $key): bool
	{
		if (is_float($key)) {
			$key = (string) $key;
		}

		return array_key_exists($key, $array);
	}
}