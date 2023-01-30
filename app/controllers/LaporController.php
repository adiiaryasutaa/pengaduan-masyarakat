<?php

namespace App\Controller;

use App\Model\Laporan;
use Core\Http\Controller;

class LaporController extends Controller
{
	public function store()
	{
		if (!$this->auth()->authed()) {
			$this->flash('user-not-authed', 'Anda perlu masuk untuk dapat membuat laporan');
			$this->back();
		}

		$inputs = [
			'user_id' => $this->auth()->user()->id(),
			'title' => $this->request()->string('judul-laporan'),
			'content' => $this->request()->string('isi-laporan'),
			'date' => $this->request()->date('tangal-kejadian'),
			'location' => $this->request()->string('lokasi-kejadian'),
		];

		if (Laporan::store($inputs)) {
			$this->flash('laporan-created-successfully', 'Laporan berhasil dikirim');
		} else {
			$this->flash('failed-create-laporan', 'Laporan gagal dikirim, mohon coba lagi');
		}


		$this->back();
	}
}