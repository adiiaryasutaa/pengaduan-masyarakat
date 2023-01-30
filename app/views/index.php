<!-- HERO SECTION -->
<section class="bg-danger" style="padding-top: 12rem; padding-bottom: 12rem">
	<div class="container d-flex flex-column justify-content-center align-items-center text-light">
		<h1>Pengaduan Online Masyarakat</h1>
		<p class="fs-4 pt-2">Sampaikan laporan Anda ke pemerintah agar dapat segera ditindak lanjuti</p>
		<a class="btn btn-light text-danger fw-semibold text-uppercase fs-5 mt-4" href="#form-lapor" role="button">Buat
			laporan</a>
	</div>
</section>
<!-- HERO SECTION -->

<!-- FORM LAPOR -->
<section class="py-5" id="form-lapor">
	<div class="container d-flex justify-content-center">
		<div class="w-50">

			<?php if (session()->hasFlash('user-not-authed')): ?>
				<div class="alert alert-danger" role="alert">
					<?= session()->getFlash('user-not-authed') ?>
				</div>
			<?php endif; ?>

			<?php if (session()->hasFlash('failed-create-laporan')): ?>
				<div class="alert alert-danger" role="alert">
					<?= session()->getFlash('failed-create-laporan') ?>
				</div>
			<?php endif; ?>

			<?php if (session()->hasFlash('laporan-created-successfully')): ?>
				<div class="alert alert-success" role="alert">
					<?= session()->getFlash('laporan-created-successfully') ?>
				</div>
			<?php endif; ?>

			<div class="border rounded p-4">
				<div class="bg-danger px-3 py-2 fs-5 fw-semibold text-light rounded mb-3">
					Sampaikan Laporan Anda
				</div>

				<div class="text-danger mb-4">
					*Pastikan Anda telah masuk
				</div>

				<form action="/lapor" method="post">
					<div class="mb-3">
						<label for="judul-laporan" class="form-label">Judul laporan</label>
						<input name="judul-laporan" type="text" class="form-control" id="judul-laporan">
					</div>

					<div class="mb-3">
						<label for="isi-laporan" class="form-label">Isi laporan</label>
						<textarea name="isi-laporan" class="form-control" id="isi-laporan" rows="5"></textarea>
					</div>

					<div class="mb-3">
						<label for="tangal-kejadian" class="form-label">Tanggal kejadian</label>
						<input name="tangal-kejadian" type="date" class="form-control" id="tangal-kejadian">
					</div>

					<div class="mb-3">
						<label for="lokasi-kejadian" class="form-label">Lokasi kejadian</label>
						<textarea name="lokasi-kejadian" class="form-control" id="lokasi-kejadian" rows="2"></textarea>
					</div>

					<button class="btn btn-danger" type="submit">Kirim</button>
				</form>
			</div>
		</div>
	</div>
</section>
<!-- FORM LAPOR -->