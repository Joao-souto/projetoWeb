<?php
include("../../util/Protect.php");

$idPublicacao = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$idPublicacao) {
    die("Publicação inválida.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Exclusão</title>
    <link rel="stylesheet" href="../CSS/confirm-delete.css">
</head>

<body>
    <main>
        <h1>Você realmente deseja deletar esta publicação?</h1>
        <form method="post" action="delete-handler.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($idPublicacao); ?>">
            <button type="submit" class="botao botao-confirmar">Sim</button>
            <a href="home.php" class="botao botao-cancelar">Cancelar</a>
        </form>
    </main>
</body>

</html>
