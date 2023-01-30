<?php

namespace App\Controller;

use App\Model\User;
use Core\Http\Controller;

class AuthController extends Controller
{
	public function register()
	{
		if (auth()->authed()) {
			return redirect('/');
		}

		return view('layouts/auth', ['title' => 'Daftar'])
			->nest('{% main %}', 'register');
	}

	public function store()
	{
		//dd(session()->old('nama'));

		if (auth()->authed()) {
			return redirect('/');
		}

		$inputs = [
			'name' => $this->request()->string('nama'),
			'email' => $this->request()->string('email'),
			'username' => $this->request()->string('username'),
			'password' => $this->request()->string('password'),
			'verify-password' => $this->request()->string('verifikasi-password'),
		];

		$errors = [];

		if (!strlen($inputs['name'])) {
			$errors['nama'] = 'Nama Anda dibutuhkan';
		}

		if (User::valueExists('email', $inputs['email'])) {
			$errors['email'] = 'Email sudah terdaftar';
		}

		if (User::valueExists('username', $inputs['username'])) {
			$errors['username'] = 'Username sudah terdaftar';
		}

		if ($inputs['password'] !== $inputs['verify-password']) {
			$errors['password'] = 'Password dan verifikasi password harus sama';
			$errors['verifikasi-password'] = 'Password dan verifikasi password harus sama';
		}

		if (count($errors)) {
			// Redirect back with errors
			return back()->error($errors);
		}

		$inputs['password'] = password_hash($inputs['password'], PASSWORD_BCRYPT);

		if (User::store($inputs)) {
			return redirect('/login')->with('register-success', 'Proses pendaftaran sukses, silakan masuk');
		}

		return back();
	}

	public function login()
	{
		if (auth()->authed()) {
			return redirect('/');
		}

		return view('layouts/auth', ['title', 'Masuk'])
			->nest('{% main %}', 'login');
	}

	public function authenticate()
	{
		if (auth()->authed()) {
			return redirect('/');
		}

		$credentials = [
			'username' => $this->request()->string('username'),
			'password' => $this->request()->string('password'),
		];

		if (auth()->attempt($credentials)) {
			// regenerate session
			session()->regenerate();
			return redirect('/');
		}

		return back()->error('login-failed', 'Login gagal, silakan coba lagi');
	}

	public function logout()
	{
		auth()->logout();
		return back();
	}
}