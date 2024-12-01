<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Variáveis para armazenar os dados do formulário
$email = '';
$senha = '';
$mensagem = '';

// Processa o formulário caso seja enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once dirname(__DIR__) . '/controller/UsuariosController.php';

    // Pega os valores dos inputs e armazena nas variáveis
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

    // Chama o método para validar o login do usuário
    $usuario = UsuariosController::realizarLogin($email,  $senha);

    // Verifica se o login foi autorizado
    if ($usuario->getLoginValido()) {
        // Redireciona para a página home
        header('Location: view/Home.php');
        exit;
    } else if ($usuario === "Por favor, preencha todos os campos.") {
        $mensagem = "Por favor, preencha todos os campos.";
    } else {
        $mensagem = "Email ou senha inválidos!.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/CSS/login-cadastro.css">
    <link rel="icon" href="view/IMG/logoIcon.png" type="image/png">
    <title>Login</title>
</head>

<body>

    <div>
        <h1 class="titulo">LOGIN</h1>

        <form action="index.php" method="POST">

            <div>
                <input type="text" name="email" placeholder="email" class="input-login">
            </div>

            <div>
                <input type="password" name="senha" placeholder="senha" class="input-login">
            </div>

            <button type="submit" class="botao-login">Entrar</button>
        </form>
        <h3 class="retorno"><?php echo $mensagem ?></h3>
        <a href="view/pages/cadastro.php" class="link-cadastro">Cadastre-se</a>
    </div>

</body>

</html>