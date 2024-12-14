<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/controller/PublicationsController.php';

// Verifica se o ID foi enviado via GET
$id_publicacao = $_GET['id'] ?? null;

if (!$id_publicacao) {
    echo "ID da publicação não foi fornecido.";
    exit;
}

// Busca os dados da publicação
$publicacao = PublicationsController::getPublicationAndUser($id_publicacao);

if (!$publicacao) {
    echo "Publicação não encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSCO2 - Publication</title>
    <link rel="icon" href="../IMG/logoIcon.png" type="image/png">
    <link rel="stylesheet" href="../CSS/publication.css">
</head>

<body>
    <header>
        <a href="home.php" class="botao">FEED</a>
        <a href="new-publication.php" class="botao">NEW POST</a>
        <a href="<?php echo $_SERVER['HTTP_REFERER'] ?? '#'; ?>" class="botao">BACK</a>
    </header>
    <main>
        <img src="<?php echo $publicacao['anexo']; ?>" alt="Imagem da Publicação" class="img-ampliada">
        <p><?php echo htmlspecialchars($publicacao['descricao']); ?></p>
        <div id="div-foto-perfil">
            <img src="<?php echo $publicacao['foto_user']; ?>" id="foto-perfil"></img>
            <h4>@<?php echo htmlspecialchars($publicacao['nome_usuario']); ?></h4>
        </div>
    </main>
</body>

</html>