<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/controller/UsersController.php';
require_once '/xampp/htdocs/projetoWeb/model/entidades/Users.php';

$idUsuario = $_SESSION["id"];

// Obtém os dados atuais do usuário
$usuarioAtual = UsersDAO::getUserById($idUsuario);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/edit-profile.css">
    <title>Edit Profile</title>
</head>

<body>
    <h1>Edit Profile</h1>
    <form action="update-profile.php" method="POST" enctype="multipart/form-data">

        <div class="edit-perfil">
        <?php
            // Check if the second input (file input) has a value
            if (!empty($_POST['foto'])) {
                // Use the uploaded image
                $fotoPerfil = $_POST['foto'];
            } else {
                // Use the existing profile picture
                $fotoPerfil = $_SESSION['foto-perfil'];
            }
            ?>
            <img src="<?php echo $_SESSION['foto-perfil'] ?>" id="fotoPerfil">
            <div id="nome-foto">
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuarioAtual->getNome()) ?>" placeholder="Nome" required><br>
                <input type="file" name="foto" accept="image/*">
            </div>
        </div>

        <button type="submit">Save Changes</button>
    </form>
</body>

</html>