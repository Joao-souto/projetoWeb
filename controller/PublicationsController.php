    <?php
    require_once '/xampp/htdocs/projetoWeb/model/DAO/PublicationsDAO.php';
    require_once '/xampp/htdocs/projetoWeb/model/entidades/Publications.php';

    class PublicationsController
    {
        // Método para criar publicação
        public static function createPublication()
        {
            session_start();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idUsuario = $_SESSION['id'] ?? null; // ID do usuário logado
                $descricao = $_POST['descricao'] ?? null;
                $anexo = null;

                if (!$idUsuario || !$descricao) {
                    echo "Dados incompletos!";
                    exit;
                }

                // Obtém o próximo ID da tabela de publicações
                $proximoId = PublicationsDAO::getNextPublicationId();

                if ($proximoId === null) {
                    echo "Erro ao obter o próximo ID para a publicação.";
                    exit;
                }

                // Verifica se há um arquivo enviado
                if (isset($_FILES['anexo']) && $_FILES['anexo']['error'] === UPLOAD_ERR_OK) {
                    $extensao = pathinfo($_FILES['anexo']['name'], PATHINFO_EXTENSION); // Obtém a extensão do arquivo
                    $nomeArquivo = "publicacao_{$proximoId}." . $extensao; // Define o nome do arquivo
                    $caminhoDestino = "../view/IMG/posts/" . $nomeArquivo;

                    // Tenta mover o arquivo para o caminho de destino
                    if (move_uploaded_file($_FILES['anexo']['tmp_name'], $caminhoDestino)) {
                        $anexo = "../IMG/posts/" . $nomeArquivo; // Caminho relativo para salvar no banco
                    } else {
                        echo "Erro ao salvar o arquivo.";
                        exit;
                    }
                } else {
                    echo "Erro no upload da imagem.";
                    exit;
                }

                // Chama o método do DAO para salvar a publicação
                $resultado = PublicationsDAO::createPublication($idUsuario, $descricao, $anexo);

                if ($resultado) {
                    header("Location: ../view/pages/home.php"); // Redireciona para a página principal
                    exit;
                } else {
                    echo "Erro ao cadastrar a publicação.";
                    exit;
                }
            }
        }

        // Método para listar todas as publicações e o total
        public static function getPublicationsWithTotal()
        {
            try {
                $publicacoes = PublicationsDAO::getAllPublications();
                $total = count($publicacoes); // Contando o total de publicações
                return [
                    'publicacoes' => $publicacoes,
                    'total' => $total,
                ];
            } catch (Exception $e) {
                error_log("Erro ao listar publicações: " . $e->getMessage());
                return [
                    'publicacoes' => [],
                    'total' => 0,
                ];
            }
        }

        // Método para listar as publicações de um usuário específico
        public static function getPublicationsByUser($id_usuario)
        {
            try {
                // Chama o método do DAO para obter as publicações de um usuário específico
                $publicacoes = PublicationsDAO::getPublicationsByUser($id_usuario);
                return $publicacoes;
            } catch (Exception $e) {
                error_log("Erro ao listar publicações do usuário: " . $e->getMessage());
                return [];
            }
        }

        // Método para consultar uma publicação pelo id
        public static function getPublicationById($id_publicacao)
        {
            try {
                // Chama o método do DAO para obter a publicação
                return PublicationsDAO::getPublicationById($id_publicacao);
            } catch (Exception $e) {
                error_log("Erro ao consultar publicação: " . $e->getMessage());
                return null;
            }
        }

        // Método para consultar publicação com os dados do usuário
        public static function getPublicationAndUser($id_publicacao)
        {
            try {
                // Chama o método do DAO para obter a publicação
                return PublicationsDAO::getPublicationAndUser($id_publicacao);
            } catch (Exception $e) {
                error_log("Erro ao consultar publicação: " . $e->getMessage());
                return null;
            }
        }

        // Método para atualizar uma publicação
        public static function updatePublication($idPublicacao, $descricao, $file = null)
        {
            if (!$idPublicacao || !$descricao) {
                return false;
            }

            $anexo = null;

            // Verifica se há um arquivo enviado
            if ($file && isset($file['anexo']) && $file['anexo']['error'] === UPLOAD_ERR_OK) {
                $extensao = pathinfo($file['anexo']['name'], PATHINFO_EXTENSION);
                $nomeArquivo = "publicacao_{$idPublicacao}." . $extensao;
                $caminhoDestino = "../view/IMG/" . $nomeArquivo;

                if (move_uploaded_file($file['anexo']['tmp_name'], $caminhoDestino)) {
                    $anexo = "../IMG/" . $nomeArquivo;
                }
            } else {
                // Caso nenhum arquivo seja enviado, mantém o anexo existente
                $publicacao = PublicationsDAO::getPublicationById($idPublicacao);
                $anexo = $publicacao['anexo'] ?? null;
            }

            return PublicationsDAO::updatePublication($idPublicacao, $descricao, $anexo);
        }


        // Método para deletar publicação
        public static function deletePublication($idPublicacao)
        {
            return PublicationsDAO::deletePublication($idPublicacao);
        }
    }

    // Verifica qual ação será executada
    if (isset($_POST['action']) && $_POST['action'] === 'cadastrar') {
        PublicationsController::createPublication();
    }
