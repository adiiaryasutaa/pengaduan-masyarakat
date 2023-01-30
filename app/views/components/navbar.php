<nav class="navbar navbar-dark navbar-expand-lg py-2 fixed-top bg-danger">
	<div class="container">
		<a class="navbar-brand fw-semibold fs-3" href="#">PENMAS</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
			aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-link active" aria-current="page" href="#">Lapor</a>
				<a class="nav-link" href="#">Tentang</a>
			</div>
		</div>
		<?php if (!Core\Application::getAuth()->authed()): ?>
			<a href="/login" class="btn text-light me-4" type="button">Masuk</a>
			<a href="/register" class="btn btn-light text-danger" type="button">Daftar</a>
		<?php else: ?>
			<div class="text-light me-4">
				<?= Core\Application::getAuth()->user()->name ?>
			</div>
			<form action="/logout" method="post">
				<button class="btn btn-light text-danger" type="submit">Logout</button>
			</form>
		<?php endif; ?>
	</div>
</nav>