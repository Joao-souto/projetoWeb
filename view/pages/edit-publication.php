<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/controller/PublicationsController.php';

$idPublicacao = $_POST['id'] ?? null;

if (empty($idPublicacao)) {
    echo "ID da publicação não fornecido.";
    exit;
}

$publicacao = PublicationsController::getPublicationById($idPublicacao);

if (empty($publicacao['id_publicacao'])) {
    echo "Publicação não encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Publication</title>
    <link rel="stylesheet" href="../CSS/publication.css">
</head>

<body>
    <header>
        <a href="profiles.php" class="botao">Back</a>
    </header>
    <main>  
        <h1 id="edit-h1">Edit Publication</h1>
        <form action="update-publication.php" method="post">
            <input type="hidden" name="id_publicacao" value="<?php echo $publicacao['id_publicacao']; ?>">
            <div class="div-edit">
                <textarea name="descricao" id="descricao"><?php echo htmlspecialchars($publicacao['descricao']); ?></textarea>
            </div>
            <?php if ($publicacao['anexo']): ?>
                <img src="<?php echo htmlspecialchars($publicacao['anexo']); ?>" alt="Imagem atual" width="200" class="img-ampliada">
            <?php endif; ?>
            <button type="submit" name="action" value="atualizar" class="botao">Save Changes</button>
        </form>
    </main>
</body>

</html>