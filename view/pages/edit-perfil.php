<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/controller/UsuariosController.php';
require_once '/xampp/htdocs/projetoWeb/model/entidades/Usuarios.php';

$idUsuario = $_SESSION["id"];

// Tratamento de envio do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];

    // Trata o upload da nova foto, se enviada
    $nomeArquivoFoto = null;
    if ($fotoPerfil && $fotoPerfil['tmp_name']) {
        $nomeArquivoFoto = uniqid() . "_" . basename($fotoPerfil['name']);
        $destino = "../IMG/" . $nomeArquivoFoto;

        if (!move_uploaded_file($fotoPerfil['tmp_name'], $destino)) {
            echo "Erro ao fazer upload da imagem.";
            exit;
        }
    }

    // Chama o Controller para atualizar o perfil
    $mensagem = UsuariosController::atualizarUsuario($idUsuario, $nome, $email, $senha, $nomeArquivoFoto);

    echo "<p>$mensagem</p>";
}

// Obtém os dados atuais do usuário
$usuarioAtual = UsuariosDAO::consultarUsuarioId($idUsuario);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/edit-perfil.css">
    <title>Editar Perfil</title>
</head>
<body>
    <h1>Editar Perfil</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuarioAtual->getNome()) ?>" placeholder="Nome" required><br>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
