<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

$msg = null;
if (!empty($_POST)) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if ($nome && $email) {
        $msg = <<<MSG
            <div class="alert alert-success">Seu nome é $nome e seu e-mail é $email.</div>
        MSG;
        unset($nome, $email);
    } else {
        $msg = <<<MSG
            <div class="alert alert-danger">Você não preencheu os dados corretamente!</div>
        MSG;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulários em PHP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
</head>
<body class="container">
    <p>Preencha o formulário de cadastro abaixo:</p>
    <form action="" method="POST">
        <?= $msg ?>
        <p>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" class="form-control" value="<?= $nome ?? "" ?>" />
        </p>
        <p>
            <label for="email">E-mail:</label>
            <input type="email" name="email" class="form-control" value="<?= $email ?? "" ?>" />
        </p>
        <p>
            <button class="btn btn-primary">Enviar</button>
        </p>
    </form>
</body>
</html>