<?php

namespace App\Controller;

use App\Model\Laporan;
use Core\Http\Controller;

class LaporController extends Controller
{
	public function store()
	{
		if (!auth()->authed()) {
			return back()->with('user-not-authed', 'Anda perlu masuk untuk dapat membuat laporan');
		}

		$inputs = [
			'user_id' => auth()->user()->id(),
			'title' => $this->request()->string('judul-laporan'),
			'content' => $this->request()->string('isi-laporan'),
			'date' => $this->request()->date('tangal-kejadian'),
			'location' => $this->request()->string('lokasi-kejadian'),
		];

		return Laporan::store($inputs) ? 
			back()->with('laporan-created-successfully', 'Laporan berhasil dikirim') :
			back()->with('failed-create-laporan', 'Laporan gagal dikirim, mohon coba lagi');
	}
}