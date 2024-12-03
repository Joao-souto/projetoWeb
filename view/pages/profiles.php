<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/controller/PublicacoesController.php'; // Inclusão do controller

$idUsuario = $_SESSION["id"]; // Obtendo o ID do usuário da sessão

// Chama o método para listar as publicações de um usuário específico
$publicacoes = PublicacoesController::listarPublicacoesPorUsuario($idUsuario);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiles</title>
    <link rel="icon" href="../IMG/logoIcon.png" type="image/png">
    <link rel="stylesheet" href="../CSS/profiles.css">
    <script>
        function confirmDelete(id) {
            if (confirm("Tem certeza de que deseja excluir esta publicação?")) {
                // Redireciona para o script de exclusão com o ID da publicação
                window.location.href = `delete-post.php?id=${id}`;
            }
        }
    </script>
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
    <a href="./new-post.php" id="postBotao">NEW POST</a>
    <main>
        <div class="search-container">
            <input type="text" placeholder="Pesquisar usuários..." class="search-input">
            <button class="search-button">
                🔍
            </button>
        </div>

        <div id="perfil">
            <img src="<?php echo $_SESSION['foto-perfil'] ?>" alt="Descrição da foto 1" id="fotoPerfil">
            <div id="userEmail">
                <h1><?php echo $_SESSION['nome'] ?></h1>
                <h2><?php echo $_SESSION['email'] ?></h2>
            </div>
        </div>
        <section class="photo-gallery">
            <?php foreach ($publicacoes as $publicacao): ?>
                <div class="photo-item">
                    <!-- Adicionando o link para redirecionar ao view-post -->
                    <a href="view-post.php?id=<?php echo $publicacao['id_publicacao']; ?>">
                        <?php if ($publicacao['anexo']): ?>
                            <img src="../IMG/<?php echo htmlspecialchars($publicacao['anexo']); ?>" alt="Imagem da publicação">
                        <?php else: ?>
                            <img src="../IMG/user.jpg" alt="Imagem padrão">
                        <?php endif; ?>
                    </a>
                    <div class="divEdit">
                        <p class="photo-caption"><?php echo htmlspecialchars($publicacao['descricao']); ?></p>

                        <div>
                            <a href="edit-post.php?id=<?php echo $publicacao['id_publicacao']; ?>" class="edit-link" title="Editar publicação">
                                ✏️
                            </a>
                            <button class="delete-button" title="Excluir" onclick="confirmDelete(<?php echo $publicacao['id_publicacao']; ?>)">
                                🗑️
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
</body>

</html>
