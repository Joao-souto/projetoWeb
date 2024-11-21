<?php

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/style.css">
    <title>Login</title>
</head>

<body>

    <div>
        <h1 class="titulo">LOGIN</h1>

        <form action="" method="POST">

            <div>
                <input type="text" name="email" placeholder="email" class="inputLogin">
            </div>

            <div>
                <input type="password" name="senha" placeholder="senha" class="inputLogin">
            </div>

            <button type="submit" class="botaoLogin">Entrar</button>
        </form>

        <a href="view/Cadastro.php" class="linkCadastro">Cadastre-se</a>
    </div>

</body>

</html>