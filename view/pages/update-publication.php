<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/controller/PublicationsController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPublicacao = $_POST['id_publicacao'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    if ($idPublicacao && $descricao) {
        $resultado = PublicationsController::updatePublication($idPublicacao, $descricao, null);

        if ($resultado) {
            header("Location: profiles.php?message=Publicação atualizada com sucesso!");
        } else {
            header("Location: profiles.php?message=Erro ao atualizar publicação.");
        }
    } else {
        header("Location: profiles.php?message=Dados inválidos.");
    }
    exit;
}
