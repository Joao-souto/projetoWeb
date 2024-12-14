<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/controller/PublicationsController.php';

$data = PublicationsController::getPublicationsWithTotal();
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
    <a href="./new-publication.php" id="post-botao">NEW POST</a>
    <main>
        <h1>VSCO — For creators, by creators</h1>
        <?php if (isset($_GET['success'])): ?>
            <p class="mensagem-sucesso">Post deleted successfully!</p>
        <?php elseif (isset($_GET['error'])): ?>
            <p class="mensagem-erro">An error occurred while deleting the post.</p>
        <?php endif; ?>


        <section class="photo-gallery">
            <?php if ($total > 0): ?>
                <?php foreach ($publicacoes as $publicacao): ?>
                    <a href="view-publication.php?id=<?php echo $publicacao['id_publicacao']; ?>" class="photo-item">
                        <img src="<?php echo $publicacao['anexo']; ?>" alt="Descrição da foto">
                        <p class="photo-caption"><?php echo $publicacao['descricao']; ?></p>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p id="no-publications">No publications available at this time.</p>
            <?php endif; ?>
        </section>
    </main>
</body>

</html>