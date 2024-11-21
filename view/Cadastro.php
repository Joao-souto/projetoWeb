<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro</title>
</head>

<body>
    <div>
        <h1 class="titulo">Cadastre-se</h1>
        <form action="cadastro.php" method="POST">
            <div>
                <input type="text" id="nome" name="nome" class="inputLogin" placeholder="Nome">
            </div>
            <div>
                <input type="email" id="email" name="email" class="inputLogin" placeholder="Email">
            </div>
            <div>
                <input type="password" id="senha" name="senha" class="inputLogin" placeholder="Senha">
            </div>

            <button type="submit" class="botaoLogin">Cadastrar</button>
        </form>
        <a href="../index.php" class="linkCadastro">Login</a>
    </div>
</body>

</html>