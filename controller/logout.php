<?php
if (!isset($_SESSION)) {
    session_start();
}
// Remove todas as variáveis da sessão
session_unset();

// Destroi a sessão
session_destroy();

// Redireciona para a página de login ou inicial
header("Location: ../index.php");
exit;
?>