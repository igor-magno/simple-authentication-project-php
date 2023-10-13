<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	<link href="<?= $_ENV['APP_URL'] ?>/assets/css/bootstrap@5.3.2.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
        <div style="width: 25rem;">
            <?php require __DIR__ . '/Components/error-alert.php' ?>
            <?php require __DIR__ . '/Components/success-alert.php' ?>
        </div>
        <div class="card" style="width: 25rem;">
            <div class="card-header">
                <h5>Login</h5>
            </div>
            <form action="<?= $_ENV['APP_URL'] ?>/auth/login" method="post">
                <div class="card-body row ">

                    <div class="col-12 mb-3">
                        <label for="email" class="form-label">Email: *</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">Esse deve ser o e-mail informado no cadastro.</div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="password" class="form-label">Senha: *</label>
                        <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" required>
                        <div id="passwordHelp" class="form-text"></div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-center mb-3">
                            <button class="btn btn-primary">Entrar</button>
                        </div>
                        <div class="d-flex justify-content-center mb-3">
                            <a href="<?= $_ENV['APP_URL'] ?>/user/register">Cadastre-se</a>
                        </div>
                        <div class="d-flex justify-content-center mb-3">
                            <a href="<?= $_ENV['APP_URL'] ?>/user/forgot-password-step-01">Esqueceu sua senha?</a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    </div>
	<script src="<?= $_ENV['APP_URL'] ?>/assets/js/bootstrap@5.3.2.js"></script>
</body>

</html>