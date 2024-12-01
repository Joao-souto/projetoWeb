<?php
include("../../util/Protect.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" href="../IMG/logoIcon.png" type="image/png">
    <link rel="stylesheet" href="../CSS/profiles.css">
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
            <img src="../IMG/user.jpg" alt="Descrição da foto 1" id="fotoPerfil">
            <div id="userEmail">
                <h1><?php echo $_SESSION['nome']?></h1>
                <h2><?php echo $_SESSION['email'] ?></h2>
            </div>
        </div>
        <section class="photo-gallery">
            <div class="photo-item">
                <img src="../IMG/user.jpg" alt="Descrição da foto 1">
                <div class="divEdit">
                    <p class="photo-caption">Descrição da Foto 1</p>

                    <div>
                        <a href="edit-post.php" class="edit-link" title="Editar publicação">
                            ✏️
                        </a>
                        <button class="delete-button" title="Excluir">
                            🗑️
                        </button>
                    </div>

                </div>
            </div>

            <div class="photo-item">
                <img src="../IMG/user.jpg" alt="Descrição da foto 1">
                <div class="divEdit">
                    <p class="photo-caption">Descrição da Foto 1</p>

                    <div>
                        <a href="edit-post.php" class="edit-link" title="Editar publicação">
                            ✏️
                        </a>
                        <button class="delete-button" title="Excluir">
                            🗑️
                        </button>
                    </div>

                </div>
            </div>

            <div class="photo-item">
                <img src="../IMG/user.jpg" alt="Descrição da foto 1">
                <div class="divEdit">
                    <p class="photo-caption">Descrição da Foto 1</p>

                    <div>
                        <a href="edit-post.php" class="edit-link" title="Editar publicação">
                            ✏️
                        </a>
                        <button class="delete-button" title="Excluir">
                            🗑️
                        </button>
                    </div>

                </div>
            </div>

            <div class="photo-item">
                <img src="../IMG/user.jpg" alt="Descrição da foto 1">
                <div class="divEdit">
                    <p class="photo-caption">Descrição da Foto 1</p>

                    <div>
                        <a href="edit-post.php" class="edit-link" title="Editar publicação">
                            ✏️
                        </a>
                        <button class="delete-button" title="Excluir">
                            🗑️
                        </button>
                    </div>

                </div>
            </div>

            <div class="photo-item">
                <img src="../IMG/user.jpg" alt="Descrição da foto 1">
                <div class="divEdit">
                    <p class="photo-caption">Descrição da Foto 1</p>

                    <div>
                        <a href="edit-post.php" class="edit-link" title="Editar publicação">
                            ✏️
                        </a>
                        <button class="delete-button" title="Excluir">
                            🗑️
                        </button>
                    </div>

                </div>
            </div>

            <div class="photo-item">
                <img src="../IMG/user.jpg" alt="Descrição da foto 1">
                <div class="divEdit">
                    <p class="photo-caption">Descrição da Foto 1</p>

                    <div>
                        <a href="edit-post.php" class="edit-link" title="Editar publicação">
                            ✏️
                        </a>
                        <button class="delete-button" title="Excluir">
                            🗑️
                        </button>
                    </div>

                </div>
            </div>
        </section>
    </main>
</body>

</html>