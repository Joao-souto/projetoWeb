<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/controller/UsuariosController.php';
require_once '/xampp/htdocs/projetoWeb/model/DAO/UsuariosDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = $_SESSION['id'] ?? null;
    $nome = $_POST['nome'] ?? null;
    $email = $_SESSION['email'] ?? null;

    if ($idUsuario && $nome && $email) {
        $fotoPerfil = null;

        // Verifica se há um arquivo enviado
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $nomeArquivo = "perfil_{$idUsuario}." . $extensao;
            $caminhoDestino = "../IMG/profiles/" . $nomeArquivo;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoDestino)) {
                $fotoPerfil = "../IMG/profiles/" . $nomeArquivo;
            }
        }

        $resultado = UsuariosController::atualizarUsuario($idUsuario, $nome, $email, $_SESSION["senha"], $fotoPerfil);

        if ($resultado) {
            $usuario = UsuariosDAO::consultarUsuarioId($_SESSION["id"]);
            $_SESSION["foto-perfil"] = $usuario->getFotoPerfil();
            $_SESSION["nome"] = $nome;
            header("Location: profiles.php?message=Perfil atualizado com sucesso!");
        } else {
            header("Location: profiles.php?message=Erro ao atualizar o perfil.");
        }
    } else {
        header("Location: profiles.php?message=Dados inválidos.");
    }
    exit;
}
