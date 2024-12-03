<?php
include("../../util/Protect.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSCO2 - Nova Publicação</title>
    <link rel="icon" href="../IMG/logoIcon.png" type="image/png">
    <link rel="stylesheet" href="../CSS/post.css">
</head>

<body>
    <header>
        <a href="home.php" class="botao">FEED</a>
        <a href="home.php" class="botao">Cancelar</a>
    </header>
    <main>
        <form action="../../controller/PublicacoesController.php" method="POST" enctype="multipart/form-data">
            <div>
                <input type="text" name="titulo" placeholder="Título" required>
                <input type="text" name="descricao" placeholder="Descrição" required>
                <input type="file" name="anexo" accept="image/*" required>
                <button type="submit" name="action" value="cadastrar" class="botao botao-new-post">ADD NEW POST</button>
            </div>
        </form>
    </main>
</body>

</html>
