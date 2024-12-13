<?php
include("../../util/Protect.php");
require_once '/xampp/htdocs/projetoWeb/controller/PublicacoesController.php';

$idPublicacao = $_POST['id'] ?? null;

if (empty($idPublicacao)) {
    echo "ID da publicação não fornecido.";
    exit;
}

$publicacao = PublicacoesController::consultarPublicacao($idPublicacao);

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
    <title>Editar Publicação</title>
    <link rel="stylesheet" href="../CSS/post.css">
</head>

<body>
    <header>
        <a href="profiles.php" class="botao">Voltar</a>
    </header>
    <main>  
        <h1>Editar Publicação</h1>
        <form action="update-post.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_publicacao" value="<?php echo $publicacao['id_publicacao']; ?>">
            <div class="div-edit">
                <textarea name="descricao" id="descricao" rows="5"><?php echo htmlspecialchars($publicacao['descricao']); ?></textarea>
                <input type="file" name="anexo" id="anexo">
            </div>
            <?php if ($publicacao['anexo']): ?>
                <img src="<?php echo htmlspecialchars($publicacao['anexo']); ?>" alt="Imagem atual" width="200" class="img-ampliada">
            <?php endif; ?>
            <button type="submit" name="action" value="atualizar" class="botao">Salvar Alterações</button>
        </form>
    </main>
</body>

</html>