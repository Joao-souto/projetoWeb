<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/controller/PublicacoesController.php';

// Verifica se o ID foi enviado via GET
$id_publicacao = $_GET['id'] ?? null;

if (!$id_publicacao) {
    echo "ID da publicação não foi fornecido.";
    exit;
}

// Busca os dados da publicação
$publicacao = PublicacoesController::consultarPublicacaoComDadosUsuario($id_publicacao);

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
    <title>VSCO2 - Publicação</title>
    <link rel="icon" href="../IMG/logoIcon.png" type="image/png">
    <link rel="stylesheet" href="../CSS/post.css">
</head>

<body>
    <header>
        <a href="home.php" class="botao">FEED</a>
        <a href="new-post.php" class="botao">NEW POST</a>
    </header>
    <main>
        <img src="<?php echo $publicacao['anexo']; ?>" alt="Imagem da Publicação" class="img-ampliada">
        <h3>@<?php echo htmlspecialchars($publicacao['nome_usuario']); ?></h3>
        <p><?php echo htmlspecialchars($publicacao['descricao']); ?></p>
    </main>
</body>

</html>
