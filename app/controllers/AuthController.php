<?php

namespace App\Controller;

use App\Model\User;
use Core\Application;
use Core\Http\Controller;

class AuthController extends Controller
{
	public function register()
	{
		if ($this->auth()->authed()) {
			$this->redirect('/');
		}

		return view('layouts/auth', ['title' => 'Daftar'])
			->nest('{% main %}', 'register');
	}

	public function store()
	{
		if ($this->auth()->authed()) {
			$this->redirect('/');
		}

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
			$this->back();
		}

		$inputs['password'] = password_hash($inputs['password'], PASSWORD_BCRYPT);

		if (User::store($inputs)) {
			$this->flash('register-success', 'Proses pendaftaran sukses, silakan masuk');
			$this->redirect('/login');
		}

		$this->back();
	}

	public function login()
	{
		if ($this->auth()->authed()) {
			$this->redirect('/');
		}

		return view('layouts/auth', ['title', 'Masuk'])
			->nest('{% main %}', 'login');
	}

	public function authenticate()
	{
		if ($this->auth()->authed()) {
			$this->redirect('/');
		}

		$credentials = [
			'username' => $this->request()->string('username'),
			'password' => $this->request()->string('password'),
		];

		if ($this->auth()->attempt($credentials)) {
			// regenerate session
			Application::getSessionManager()->regenerate();
			$this->redirect('/');
		}

		$this->back();
	}

	public function logout()
	{
		$this->auth()->logout();
		$this->back();
	}
}