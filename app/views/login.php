<section style="margin-top: 4rem">
	<div class="container d-flex flex-column align-items-center">
		<div class="w-50">
			<a href="/" type="button" class="btn text-danger mb-4">Kembali ke halaman utama</a>

			<?php if (Core\Application::getSessionManager()->has('__.flash.register-success')): ?>
				<div class="alert alert-success" role="alert">
					<?= flash('register-success') ?>
				</div>
			<?php endif; ?>

			<div class="border rounded p-4">
				<div class="bg-danger px-3 py-2 fs-5 fw-semibold text-light rounded mb-4">
					Masuk
				</div>

				<form action="/login" method="post">

					<div class="mb-3">
						<label for="username" class="form-label">Username</label>
						<input name="username" type="text" class="form-control" id="username">
					</div>

					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input name="password" type="password" class="form-control" id="password">
					</div>

					<button type="submit" class="btn btn-danger">Masuk</button>
				</form>
			</div>
		</div>
	</div>
</section>