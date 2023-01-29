<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="<?= asset('css\\bootstrap\\bootstrap.min.css') ?>" rel="stylesheet" />

	<title><?= $title ?? 'Document' ?></title>
</head>

<body>
	{% main %}

	<script src="<?= asset('js\\bootstrap\\bootstrap.bundle.min.js') ?>"></script>
</body>

</html>