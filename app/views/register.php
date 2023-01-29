<section style="margin-top: 4rem">
	<div class="container d-flex flex-column align-items-center">
		<div class="w-50">
			<a href="/" type="button" class="btn text-danger mb-4">Kembali ke halaman utama</a>

			<div class="border rounded p-4">
				<div class="bg-danger px-3 py-2 fs-5 fw-semibold text-light rounded mb-4">
					Daftar
				</div>

				<form action="/register" method="post">
					<div class="mb-3">
						<label for="nama" class="form-label">Nama</label>
						<input name="nama" type="text" class="form-control" id="nama">
					</div>

					<div class="mb-3">
						<label for="username" class="form-label">Username</label>
						<input name="username" type="text" class="form-control" id="username">
					</div>

					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input name="email" type="email" class="form-control" id="email">
					</div>

					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input name="password" type="password" class="form-control" id="password">
					</div>

					<div class="mb-4">
						<label for="verifikasi-password" class="form-label">Verifikasi password</label>
						<input name="verifikasi-password" type="password" class="form-control" id="verifikasi-password">
					</div>

					<button type="submit" class="btn btn-danger">Daftar</button>
				</form>
			</div>
		</div>
	</div>
</section>