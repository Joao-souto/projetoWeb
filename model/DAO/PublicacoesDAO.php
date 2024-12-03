<?php
require_once '/xampp/htdocs/projetoWeb/util/Conexao.php';
require_once '/xampp/htdocs/projetoWeb/model/entidades/Publicacoes.php';
class PublicacoesDAO
{
    // Constantes para status
    const STATUS_ATIVO = 'ativo';
    const STATUS_EXCLUIDO = 'excluido';
    const STATUS_PENDENTE = 'pendente';

    // Método para criar uma nova publicação
    public static function cadastrarPublicacao($id_usuario, $descricao, $anexo = null, $status = self::STATUS_ATIVO)
    {
        $conn = Conexao::getConexao(); // Obtemos a conexão
        if ($conn === null) {
            return false;
        }

        $sql = "INSERT INTO publicacoes (id_usuario, descricao, anexo, status) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_usuario, $descricao, $anexo, $status]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao criar publicação: " . $e->getMessage());
            return false;
        }
    }

    // Método para obter uma publicação pelo ID
    public static function consultarPublicacao($id_publicacao)
    {
        $conn = Conexao::getConexao();
        if ($conn === null) {
            return null;
        }

        $sql = "SELECT * FROM publicacoes WHERE id_publicacao = ?";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_publicacao]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao obter publicação: " . $e->getMessage());
            return null;
        }
    }

    public static function obterProximoIdPublicacao()
    {
        $conn = Conexao::getConexao();
        if ($conn === null) {
            return null;
        }

        $sql = "SHOW TABLE STATUS LIKE 'publicacoes'";

        try {
            $stmt = $conn->query($sql);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['Auto_increment'] ?? null;
        } catch (PDOException $e) {
            error_log("Erro ao obter próximo ID: " . $e->getMessage());
            return null;
        }
    }

    // Método para atualizar uma publicação
    public static function atualizarPublicacao($id_publicacao, $descricao, $anexo = null, $status = self::STATUS_ATIVO)
    {
        $conn = Conexao::getConexao();
        if ($conn === null) {
            return false;
        }

        $sql = "UPDATE publicacoes SET descricao = ?, anexo = ?, status = ? WHERE id_publicacao = ?";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$descricao, $anexo, $status, $id_publicacao]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao atualizar publicação: " . $e->getMessage());
            return false;
        }
    }

    // Método para excluir uma publicação
    public static function deletarPublicacao($id_publicacao)
    {
        $conn = Conexao::getConexao();
        if ($conn === null) {
            return false;
        }

        $sql = "DELETE FROM publicacoes WHERE id_publicacao = ?";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_publicacao]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao excluir publicação: " . $e->getMessage());
            return false;
        }
    }

    // Método para listar todas as publicações
    public static function listarPublicacoes()
    {
        $conn = Conexao::getConexao();
        if ($conn === null) {
            return [];
        }

        $sql = "SELECT * FROM publicacoes ORDER BY data_publicacao DESC";

        try {
            $stmt = $conn->prepare($sql); // Usando prepare() para segurança
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar publicações: " . $e->getMessage());
            return [];
        }
    }

    // Método para listar publicações de um usuário específico
    public static function listarPublicacoesPorUsuario($id_usuario)
    {
        $conn = Conexao::getConexao();
        if ($conn === null) {
            return [];
        }

        $sql = "SELECT * FROM publicacoes WHERE id_usuario = ? ORDER BY data_publicacao DESC";

        try {
            $stmt = $conn->prepare($sql); // Usando prepare() para segurança
            $stmt->execute([$id_usuario]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar publicações do usuário: " . $e->getMessage());
            return [];
        }
    }
}
