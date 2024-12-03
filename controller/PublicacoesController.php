    <?php
    require_once '/xampp/htdocs/projetoWeb/model/DAO/PublicacoesDAO.php';
    require_once '/xampp/htdocs/projetoWeb/model/entidades/Publicacoes.php';

    class PublicacoesController
    {
        // Método para listar todas as publicações com total
        public static function listarPublicacoesComTotal()
        {
            try {
                $publicacoes = PublicacoesDAO::listarPublicacoes();
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
        public static function listarPublicacoesPorUsuario($id_usuario)
        {
            try {
                // Chama o método do DAO para obter as publicações de um usuário específico
                $publicacoes = PublicacoesDAO::listarPublicacoesPorUsuario($id_usuario);
                return $publicacoes;
            } catch (Exception $e) {
                error_log("Erro ao listar publicações do usuário: " . $e->getMessage());
                return [];
            }
        }
        public static function cadastrarPublicacao()
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
                $proximoId = PublicacoesDAO::obterProximoIdPublicacao();

                if ($proximoId === null) {
                    echo "Erro ao obter o próximo ID para a publicação.";
                    exit;
                }

                // Verifica se há um arquivo enviado
                if (isset($_FILES['anexo']) && $_FILES['anexo']['error'] === UPLOAD_ERR_OK) {
                    $extensao = pathinfo($_FILES['anexo']['name'], PATHINFO_EXTENSION); // Obtém a extensão do arquivo
                    $nomeArquivo = "publicacao_{$proximoId}." . $extensao; // Define o nome do arquivo
                    $caminhoDestino = "../view/IMG/" . $nomeArquivo;

                    // Tenta mover o arquivo para o caminho de destino
                    if (move_uploaded_file($_FILES['anexo']['tmp_name'], $caminhoDestino)) {
                        $anexo = "../IMG/" . $nomeArquivo; // Caminho relativo para salvar no banco
                    } else {
                        echo "Erro ao salvar o arquivo.";
                        exit;
                    }
                } else {
                    echo "Erro no upload da imagem.";
                    exit;
                }

                // Chama o método do DAO para salvar a publicação
                $resultado = PublicacoesDAO::cadastrarPublicacao($idUsuario, $descricao, $anexo);

                if ($resultado) {
                    header("Location: ../view/pages/home.php"); // Redireciona para a página principal
                    exit;
                } else {
                    echo "Erro ao cadastrar a publicação.";
                    exit;
                }
            }
        }

        public static function consultarPublicacao($id_publicacao)
        {
            try {
                // Chama o método do DAO para obter a publicação
                return PublicacoesDAO::consultarPublicacao($id_publicacao);
            } catch (Exception $e) {
                error_log("Erro ao consultar publicação: " . $e->getMessage());
                return null;
            }
        }

        public static function consultarPublicacaoComDadosUsuario($id_publicacao)
        {
            try {
                // Chama o método do DAO para obter a publicação
                return PublicacoesDAO::consultarPublicacaoComDadosUsuario($id_publicacao);
            } catch (Exception $e) {
                error_log("Erro ao consultar publicação: " . $e->getMessage());
                return null;
            }
        }

        public static function atualizarPublicacao($idPublicacao, $descricao, $file = null)
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
                $publicacao = PublicacoesDAO::consultarPublicacao($idPublicacao);
                $anexo = $publicacao['anexo'] ?? null;
            }
        
            return PublicacoesDAO::atualizarPublicacao($idPublicacao, $descricao, $anexo);
        }
        


        public static function deletarPublicacao($idPublicacao)
        {
            return PublicacoesDAO::deletarPublicacao($idPublicacao);
        }
    }

    // Verifica qual ação será executada
    if (isset($_POST['action']) && $_POST['action'] === 'cadastrar') {
        PublicacoesController::cadastrarPublicacao();
    }
