<?php

namespace App\Controller;

use App\Model\User;
use Core\Http\Controller\Controller;

class AuthController extends Controller
{
	public function store()
	{
		$inputs = [
			'name' => $this->request()->string('nama'),
			'email' => $this->request()->string('email'),
			'username' => $this->request()->string('username'),
			'password' => $this->request()->string('password'),
			'verify-password' => $this->request()->string('verifikasi-password'),
		];

		$errors = [];

		if (User::valueExists('email', $inputs['email'])) {
			$errors['email'] = 'Email sudah terdaftar';
		}

		if (User::valueExists('username', $inputs['username'])) {
			$errors['username'] = 'Username sudah terdaftar';
		}

		if ($inputs['password'] !== $inputs['verify-password']) {
			$errors['password'] = 'Password dan verifikasi password harus sama';
			$errors['verify-password'] = 'Password dan verifikasi password harus sama';
		}

		if (count($errors)) {
			// Redirect back with errors
		}


	}
}