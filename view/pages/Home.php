<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/controller/PublicacoesController.php';

$data = PublicacoesController::listarPublicacoesComTotal();
$publicacoes = $data['publicacoes'];
$total = $data['total'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" href="../IMG/logoIcon.png" type="image/png">
    <link rel="stylesheet" href="../CSS/home.css">
</head>

<body>
    <header>
        <img src="../IMG/vsco2.png" alt="Logo da página" id="vsco2">

        <a href="home.php" class="link-menu">
            <div class="div-link-menu">
                <img src="../IMG/feedIcon.png" alt="Icon do feed">
                <h3>FEED</h3>
            </div>
        </a>

        <a href="profiles.php" class="link-menu">
            <div class="div-link-menu">
                <img src="../IMG/profileIcon.png" alt="Icon do feed">
                <h3>PROFILES</h3>
            </div>
        </a>
        <a href="../../controller/logout.php" class="botao">EXIT</a>
    </header>
    <a href="./new-post.php" id="post-botao">NEW POST</a>
    <main>
        <h1>VSCO — For creators, by creators</h1>
        <?php if (isset($_GET['success'])): ?>
            <p class="mensagem-sucesso">Publicação deletada com sucesso!</p>
        <?php elseif (isset($_GET['error'])): ?>
            <p class="mensagem-erro">Ocorreu um erro ao deletar a publicação.</p>
        <?php endif; ?>


        <section class="photo-gallery">
            <?php if ($total > 0): ?>
                <?php foreach ($publicacoes as $publicacao): ?>
                    <a href="view-post.php?id=<?php echo $publicacao['id_publicacao']; ?>" class="photo-item">
                        <img src="<?php echo $publicacao['anexo']; ?>" alt="Descrição da foto">
                        <p class="photo-caption"><?php echo $publicacao['descricao']; ?></p>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhuma publicação disponível no momento.</p>
            <?php endif; ?>
        </section>
    </main>
</body>

</html>