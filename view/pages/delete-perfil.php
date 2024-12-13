<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/model/DAO/UsuariosDAO.php';
require_once '/xampp/htdocs/projetoWeb/model/entidades/Usuarios.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $idUser = intval($_GET['id']);
    $user = new Usuarios(null,null,null);
    $user->setIdUsuario($idUser);


    if (UsuariosDAO::excluirUsuario($user)) {
        header("Location: ../../index.php");
    } else {
        header("Location: profiles.php?error=1");
    }
    exit;
} else {
    echo "id não encontrado!";
    exit;
}
?>
