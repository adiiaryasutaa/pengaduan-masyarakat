<?php

namespace App\Model;

use Core\Application as App;

class User extends Model
{
	protected string $name;
	protected string $email;
	protected string $username;

	public static function valueExists(string $column, $value)
	{
		return Model::exists('users', $column, $value);
	}

	public static function store(array $data)
	{
		$connection = App::getConnection();
	}
}