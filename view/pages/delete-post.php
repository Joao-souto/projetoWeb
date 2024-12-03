<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/controller/PublicacoesController.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $idPublicacao = intval($_GET['id']);

    if (PublicacoesController::deletarPublicacao($idPublicacao)) {
        // Redireciona para a home com a mensagem de sucesso
        header("Location: home.php?success=1");
    } else {
        // Redireciona para a home com a mensagem de erro
        header("Location: home.php?error=1");
    }
    exit;
} else {
    // Caso não encontre o ID ou o método seja errado
    header("Location: home.php?error=1");
    exit;
}
?>
