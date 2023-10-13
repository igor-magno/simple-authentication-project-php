<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Exclusão de Dados</title>
	<link href="<?= $_ENV['APP_URL'] ?>/assets/css/bootstrap@5.3.2.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
        <div style="width: 50rem;">
            <?php require __DIR__ . '/Components/error-alert.php' ?>
            <?php require __DIR__ . '/Components/success-alert.php' ?>
        </div>
        <div class="card border border-danger" style="width: 50rem;">
            <div class="card-header border-bottom border-danger">
                <h5 class="text-danger">Solicitar Exclusão de Dados</h5>
            </div>
            <form action="<?= $_ENV['APP_URL'] ?>/user/delete" method="post">
                <input name="id" value="<?= $user->id ?>" hidden />
                <div class="card-body row ">
                    <div class="col-12 mb-3">
                        <p class="text-danger">Após confirmar a exclusão não será possível recuperar os seus dados!</p>
                        <p class="text-danger">Prossiga por conta risco.</p>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-center mb-3">
                            <button class="btn btn-danger">Confirmar Exclusão</button>
                        </div>
                        <div class="d-flex justify-content-center mb-3">
                            <a href="<?= $_ENV['APP_URL'] ?>/home">Voltar</a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    </div>
	<script src="<?= $_ENV['APP_URL'] ?>/assets/js/bootstrap@5.3.2.js"></script>
</body>

</html>