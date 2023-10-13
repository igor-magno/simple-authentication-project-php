<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Formulário de Cadastro</title>
	<link href="<?= $_ENV['APP_URL'] ?>/assets/css/bootstrap@5.3.2.css" rel="stylesheet">
</head>

<body>
	<div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
		<div style="width: 50rem;">
			<?php require __DIR__ . '/Components/error-alert.php' ?>
			<?php require __DIR__ . '/Components/success-alert.php' ?>
		</div>
		<div class="card" style="width: 50rem;">
			<div class="card-body">
				<div class="mb-3">
					<p>Olá <strong><?= $user->name ?></strong></p>
					<p>E-mail: <?= $user->email ?></p>
					<p>CPF: <?= $user->document ?></p>
					<p>Data de Nascimento: <?= $user->birthDate->format('d/m/Y') ?></p>
				</div>
				<div class="d-flex justify-content-center mb-3">
					<a href="<?= $_ENV['APP_URL'] ?>/user/edit?id=<?= $user->id ?>">Quer atualizar seus dados clique aqui</a>
				</div>
				<div class="d-flex justify-content-center mb-3">
					<a href="<?= $_ENV['APP_URL'] ?>/user/update-password?id=<?= $user->id ?>">Quer atualizar sua senha clique aqui</a>
				</div>
				<div class="d-flex justify-content-center mb-3">
					<a href="<?= $_ENV['APP_URL'] ?>/user/remove">Se deseja excluir seus dados clique aqui</a>
				</div>
				<div class="d-flex justify-content-center mb-3">
					<a href="<?= $_ENV['APP_URL'] ?>/auth/logout">Sair</a>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= $_ENV['APP_URL'] ?>/assets/js/bootstrap@5.3.2.js"></script>
</body>

</html>