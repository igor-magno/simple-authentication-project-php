<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Formulário de Atualização dos Dados</title>
	<link href="<?= $_ENV['APP_URL'] ?>/assets/css/bootstrap@5.3.2.css" rel="stylesheet">
	<script src="<?= $_ENV['APP_URL'] ?>/assets/js/jquery@3.7.1.js"></script>
	<script src="<?= $_ENV['APP_URL'] ?>/assets/js/mask@1.14.16.js"></script>
</head>

<body>
	<div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
		<div style="width: 50rem;">
			<?php require __DIR__ . '/Components/error-alert.php' ?>
            <?php require __DIR__ . '/Components/success-alert.php' ?>
		</div>
		<div class="card" style="width: 50rem;">
			<div class="card-header">
				<h5>Formulário de Atualização dos Dados</h5>
			</div>
			<form action="<?= $_ENV['APP_URL'] ?>/user/update?id=<?= $user->id ?>" method="post">
				<div class="card-body row ">

					<div class="col-6 mb-3">
						<label for="name" class="form-label">Nome: *</label>
						<input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" required value="<?= $user->name ?>">
						<div id="nameHelp" class="form-text"></div>
					</div>

					<div class="col-6 mb-3">
						<label for="document" class="form-label">CPF: *</label>
						<input type="text" class="form-control cpf" id="document" name="document" aria-describedby="documentHelp" required value="<?= $user->document ?>">
						<div id="documentHelp" class="form-text"></div>
					</div>

					<div class="col-6 mb-3">
						<label for="birth-date" class="form-label">Data de Nascimento: *</label>
						<input type="date" class="form-control" id="birth-date" name="birth-date" aria-describedby="birth-dateHelp" required value="<?= $user->birthDate->format('Y-m-d') ?>">
						<div id="birth-dateHelp" class="form-text"></div>
					</div>

					<div class="col-6 mb-3">
						<label for="email" class="form-label">Email: *</label>
						<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required value="<?= $user->email ?>">
						<div id="emailHelp" class="form-text">Informe o seu melhor e-mail</div>
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
	<script>
		$(document).ready(function() {
			$('.cpf').mask('000.000.000-00', {
				reverse: true
			});
		})
	</script>
</body>

</html>