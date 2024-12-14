<?php
require_once '../../controller/UsersController.php';

// Variáveis para armazenar os dados do formulário
$nome = '';
$email = '';
$senha = '';
$mensagem = '';

// Processa o formulário caso seja enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega os valores dos inputs e armazena nas variáveis
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

    // Chama o método para cadastrar o usuário
    $mensagem = UsersController::createUser($nome, $email, $senha);

    // Verifica se a mensagem de sucesso foi retornada e redireciona para o login
    if ($mensagem === "Usuário cadastrado com sucesso!") {
        // Redireciona para a página de login
        header('Location: ../../index.php');
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/login-register.css">
    <link rel="icon" href="../IMG/logoIcon.png" type="image/png">
    <title>Register</title>
</head>

<body>
    <div>
        <h1 class="titulo">Sign Up</h1>

        <form action="register.php" method="POST">
            <div>
                <input type="text" id="nome" name="nome" class="input-login" placeholder="Name" value="<?php echo htmlspecialchars($nome); ?>" required>
            </div>
            <div>
                <input type="email" id="email" name="email" class="input-login" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div>
                <input type="password" id="senha" name="senha" class="input-login" placeholder="Password" value="<?php echo htmlspecialchars($senha); ?>" required>
            </div>
            <button type="submit" class="botao-login">Register</button>
        </form>
        <a href="../../index.php" class="link-cadastro">Sign in</a>
        <h3 class="retorno"><?php echo $mensagem ?></h3>
    </div>
</body>

</html>