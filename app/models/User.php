<?php

namespace App\Model;

use Core\Application as App;
use Core\Database\Model;
use PDO;

class User extends Model
{
	public string $name;
	public string $email;
	public string $username;

	public static function valueExists(string $column, $value)
	{
		return Model::exists('users', $column, $value);
	}

	public static function store(array $data)
	{
		$connection = App::getConnection();

		$preparedStatement = $connection->prepare("INSERT INTO users (name, email, username, password) VALUES (:name, :email, :username, :password)");

		$preparedStatement->bindValue(':name', $data['name']);
		$preparedStatement->bindValue(':email', $data['email']);
		$preparedStatement->bindValue(':username', $data['username']);
		$preparedStatement->bindValue(':password', $data['password']);

		return $preparedStatement->execute();
	}

	public function id()
	{
		$connection = App::getConnection();

		$preparedStatement = $connection->prepare("SELECT id FROM users WHERE username = :username");
		$preparedStatement->bindParam(':username', $this->username);
		$preparedStatement->execute();

		return $preparedStatement->fetch(PDO::FETCH_ASSOC)['id'];
	}
}