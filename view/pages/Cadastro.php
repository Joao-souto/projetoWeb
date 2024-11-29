    <?php

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

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
        $mensagem = UsuariosController::cadastrarUsuario($nome, $email, $senha);

        // Verifica se a mensagem de sucesso foi retornada e redireciona para o login
        if ($mensagem === "Usuário cadastrado com sucesso!") {
            // Redireciona para a página de login
            header('Location: ../index.php');
            exit;
        }
    }
    ?>


    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/loginECadastro.css">
        <link rel="icon" href="../IMG/logoIcon.png" type="image/png">
        <title>Cadastro</title>
    </head>

    <body>
        <div>
            <h1 class="titulo">Cadastre-se</h1>

            <form action="Cadastro.php" method="POST">
                <div>
                    <input type="text" id="nome" name="nome" class="inputLogin" placeholder="Nome" value="<?php echo htmlspecialchars($nome); ?>" required>
                </div>
                <div>
                    <input type="email" id="email" name="email" class="inputLogin" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div>
                    <input type="password" id="senha" name="senha" class="inputLogin" placeholder="Senha" value="<?php echo htmlspecialchars($senha); ?>" required>
                </div>
                <button type="submit" class="botaoLogin">Cadastrar</button>
            </form>
            <h3 class="retorno"><?php echo $mensagem ?></h3>
            <a href="../../index.php" class="linkCadastro">Login</a>
        </div>
    </body>

    </html>