<?php

namespace Core\Auth;

use App\Model\User;
use Core\Application;
use PDO;

class Auth
{
	public function attempt(array $credentials)
	{
		$connection = Application::getConnection();

		$username = $credentials['username'];
		$password = $credentials['password'];

		$preparedStatement = $connection->prepare("SELECT password FROM users WHERE username = :username");
		$preparedStatement->bindParam(':username', $username);

		if (!$preparedStatement->execute()) {
			return false;
		}

		$user = $preparedStatement->fetch(PDO::FETCH_ASSOC);

		if ($user && password_verify($password, $user['password'])) {
			session()->set('__auth__.user', $username);
			return true;
		}

		return false;
	}

	public function authed()
	{
		return session()->has('__auth__.user');
	}

	public function user()
	{
		if (!$this->authed()) {
			return null;
		}

		$connection = Application::getConnection();

		$username = session()->get('__auth__.user');

		$preparedStatement = $connection->prepare("SELECT name, email, username FROM users WHERE username = :username");
		$preparedStatement->bindParam(':username', $username);
		$preparedStatement->execute();

		$data = $preparedStatement->fetch(PDO::FETCH_ASSOC);

		$user = new User();

		$user->email = $data['email'];
		$user->name = $data['name'];
		$user->username = $data['username'];

		return $user;
	}

	public function logout()
	{
		session()->remove('__auth__.user');
	}
}