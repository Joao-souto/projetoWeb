<?php
include("../../util/Protect.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSCO2</title>
    <link rel="icon" href="../IMG/logoIcon.png" type="image/png">
    <link rel="stylesheet" href="../CSS/post.css">
</head>

<body>
    <header>
    <a href="home.php" class="botao">FEED</a>            
    <a href="profiles.php" class="botao">Cancelar</a>    
    </header> 
    <main>
        <img src="../IMG/user.jpg" alt="">
        <input type="text" placeholder="Título">
        <input type="text" placeholder="Descrição">
        <button class="botao">SALVAR</button>
    </main>
</body>

</html>