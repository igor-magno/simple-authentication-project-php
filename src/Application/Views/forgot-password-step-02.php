<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Formulário de Atualização de Senha</title>
	<link href="<?= $_ENV['APP_URL'] ?>/assets/css/bootstrap@5.3.2.css" rel="stylesheet">
</head>

<body>
	<div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
		<div style="width: 50rem;">
			<?php require __DIR__ . '/Components/error-alert.php' ?>
			<?php require __DIR__ . '/Components/success-alert.php' ?>
		</div>
		<div class="card" style="width: 50rem;">
			<div class="card-header">
				<h5>Formulário de Atualização de Senha</h5>
			</div>
			<form action="<?= $_ENV['APP_URL'] ?>/user/update-password-by-id" method="post">
				<input name="id" value="<?= $user->id ?>" hidden />
				<div class="card-body row ">

					<div class="col-6 mb-3">
						<label for="new_password" class="form-label">Nova Senha: *</label>
						<input type="password" class="form-control" id="new_password" name="new_password" aria-describedby="new_passwordHelp" required>
						<div id="new_passwordHelp" class="form-text"></div>
					</div>

					<div class="col-6 mb-3">
						<label for="confirm_new_password" class="form-label">Confirme a Nova Senha: *</label>
						<input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" aria-describedby="confirm_new_passwordHelp" required>
						<div id="confirm_new_passwordHelp" class="form-text"></div>
					</div>

					<div class="col-12">
						<div class="d-flex justify-content-center mb-3">
							<button class="btn btn-primary">Salvar</button>
						</div>
						<div class="d-flex justify-content-center mb-3">
							<a href="<?= $_ENV['APP_URL'] ?>/home">Cancelar</a>
						</div>
					</div>
			</form>
		</div>
	</div>
	</div>
	<script src="<?= $_ENV['APP_URL'] ?>/assets/js/bootstrap@5.3.2.js"></script>
</body>

</html>