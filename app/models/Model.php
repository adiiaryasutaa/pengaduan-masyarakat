<?php

namespace App\Model;

use Core\Application as App;
use PDO;

class Model
{
	public static function exists(string $table, string $column, $value)
	{
		$connection = App::getConnection();

		$preparedStatement = $connection->prepare("SELECT $column FROM $table WHERE $column = :$column");

		$preparedStatement->bindParam(":$column", $value, match (gettype($value)) {
			'boolean' => PDO::PARAM_BOOL,
			'integer' => PDO::PARAM_INT,
			'string' => PDO::PARAM_STR,
			'null' => PDO::PARAM_NULL,
			default => PDO::PARAM_STR
		});

		$preparedStatement->execute();

		return (bool) $preparedStatement->fetch(PDO::FETCH_ASSOC);
	}
}