<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/model/DAO/UsersDAO.php';
require_once '/xampp/htdocs/projetoWeb/model/entidades/Users.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $idUser = intval($_GET['id']);
    $user = new Users(null,null,null);
    $user->setIdUsuario($idUser);


    if (UsersDAO::deleteUser($user)) {
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
