<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/controller/PublicationsController.php'; // Inclusão do controller

$idUsuario = $_SESSION["id"]; // Obtendo o ID do usuário da sessão

// Chama o método para listar as publicações de um usuário específico
$publicacoes = PublicationsController::getPublicationsByUser($idUsuario);

// Verifica se há uma mensagem na URL
$message = $_GET['message'] ?? null;
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
                window.location.href = `delete-publication.php?id=${id}`;
            }
        }

        function confirmDeleteUser(id) {
            if (confirm("Tem certeza de que deseja excluir seu perfil?")) {
                // Redireciona para o script de exclusão com o ID do usuário
                window.location.href = `delete-profile.php?id=${id}`;
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
    <a href="./new-publication.php" id="postBotao">NEW POST</a>
    <main>

        <?php if ($message): ?>
            <div class="message-box">
                <p><?php echo htmlspecialchars($message); ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <p class="mensagem-sucesso">Post deleted successfully!</p>
        <?php elseif (isset($_GET['error'])): ?>
            <p class="mensagem-erro">An error occurred while deleting the post.</p>
        <?php endif; ?>

        <div id="perfil">
            <img src="<?php echo $_SESSION['foto-perfil'] ?>" id="fotoPerfil">
            <div id="userEmail">
                <h1><?php echo $_SESSION['nome'] ?></h1>
                <h2><?php echo $_SESSION['email'] ?></h2>
            </div>
            <a href="edit-profile.php" class="botao">✏️</a>
            <button class="delete-button" title="Excluir" onclick="confirmDeleteUser(<?php echo $_SESSION['id']; ?>)">
                🗑️
            </button>
        </div>
        <section class="photo-gallery">
            <?php foreach ($publicacoes as $publicacao): ?>
                <div class="photo-item">
                    <a href="view-publication.php?id=<?php echo $publicacao['id_publicacao']; ?>">
                        <?php if ($publicacao['anexo']): ?>
                            <img src="<?php echo htmlspecialchars($publicacao['anexo']); ?>" alt="Imagem da publicação">
                        <?php else: ?>
                            <img src="../IMG/user.jpg" alt="Imagem padrão">
                        <?php endif; ?>
                    </a>
                    <div class="divEdit">
                        <p class="photo-caption"><?php echo htmlspecialchars($publicacao['descricao']); ?></p>

                        <div>
                            <a href="edit-publication.php" class="edit-link" title="Editar publicação" data-id=<?php echo $publicacao['id_publicacao']; ?>>
                                ✏️
                            </a>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const editLinks = document.querySelectorAll('.edit-link');

                                    editLinks.forEach(link => {
                                        link.addEventListener('click', function(event) {
                                            event.preventDefault(); // Impede o comportamento padrão do link

                                            // Obtém o ID da publicação do atributo data-id
                                            const idPublicacao = this.getAttribute('data-id');
                                            const href = this.getAttribute('href');

                                            // Cria um formulário dinâmico
                                            const form = document.createElement('form');
                                            form.method = 'POST';
                                            form.action = href;

                                            // Adiciona um campo oculto com o ID da publicação
                                            const input = document.createElement('input');
                                            input.type = 'hidden';
                                            input.name = 'id';
                                            input.value = idPublicacao;

                                            form.appendChild(input);

                                            // Adiciona o formulário ao corpo e o submete
                                            document.body.appendChild(form);
                                            form.submit();
                                        });
                                    });
                                });
                            </script>

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