<?php
session_start();
require_once __DIR__ . '/controller/UsersController.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);
$mensagem = "";

// Processa o formulário caso seja enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega os valores dos inputs e armazena nas variáveis
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

    // Verifica se os campos não estão vazios
    if (empty($email) || empty($senha)) {
        $mensagem = "Por favor, preencha todos os campos.";
    }else{
        $usuario = UsersController::isValidLogin($email, $senha);
        if ($usuario->getLoginValido()) {
            $_SESSION["id"] = $usuario->getIdUsuario();
            $_SESSION["nome"] = $usuario->getNome();
            $_SESSION["email"] = $usuario->getEmail();
            $_SESSION["foto-perfil"] = $usuario->getFotoPerfil();
            $_SESSION["senha"] = $senha;
            header("Location: view/pages/home.php");
            exit;
        } else {
            $mensagem = "Usuário ou senha incorretos!";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/CSS/login-register.css">
    <link rel="icon" href="view/IMG/logoIcon.png" type="image/png">
    <title>Login</title>
</head>

<body>

    <div>
        <h1 class="titulo">LOGIN</h1>

        <form action="index.php" method="POST">

            <div>
                <input type="text" name="email" placeholder="Email" class="input-login">
            </div>

            <div>
                <input type="password" name="senha" placeholder="Password" class="input-login">
            </div>

            <button type="submit" class="botao-login">Sign in</button>
        </form>
        <a href="view/pages/register.php" class="link-cadastro">Sign up</a>
        <h3 class="retorno"><?php echo $mensagem ?></h3>
    </div>

</body>

</html>