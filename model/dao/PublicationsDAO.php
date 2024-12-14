<?php
require_once '/xampp/htdocs/projetoWeb/util/Connection.php';
require_once '/xampp/htdocs/projetoWeb/model/entidades/Publications.php';
class PublicationsDAO
{
    // Constantes para status
    const STATUS_ATIVO = 'ativo';
    const STATUS_EXCLUIDO = 'excluido';
    const STATUS_PENDENTE = 'pendente';

    // Método para criar uma nova publicação
    public static function createPublication($id_usuario, $descricao, $anexo = null, $status = self::STATUS_ATIVO)
    {
        $conn = Connection::getConnection(); // Obtemos a conexão
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
    public static function getPublicationById($id_publicacao)
    {
        $conn = Connection::getConnection();
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

    // Método que retorna o id da próxima publicação
    public static function getNextPublicationId()
    {
        $conn = Connection::getConnection();
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

    // Método para listar todas as publicações
    public static function getAllPublications()
    {
        $conn = Connection::getConnection();
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
    public static function getPublicationsByUser($id_usuario)
    {
        $conn = Connection::getConnection();
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

    // Método para obter dados da publicação e usuário
    public static function getPublicationAndUser($id_publicacao)
    {
        $conn = Connection::getConnection();
        if ($conn === null) {
            return null;
        }

        // Adicionar um JOIN para obter o nome do usuário associado à publicação
        $sql = "SELECT p.*, u.nome AS nome_usuario, u.foto_perfil AS foto_user
            FROM publicacoes p
            JOIN usuarios u ON p.id_usuario = u.id_usuario
            WHERE p.id_publicacao = ?";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_publicacao]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao obter publicação: " . $e->getMessage());
            return null;
        }
    }

    // Método para atualizar uma publicação
    public static function updatePublication($id_publicacao, $descricao, $anexo = null)
    {
        $conn = Connection::getConnection();
        if ($conn === null) {
            return false;
        }

        // Ajusta o SQL dinamicamente para evitar alterações desnecessárias
        $sql = "UPDATE publicacoes SET descricao = ?";
        $params = [$descricao];

        if ($anexo !== null) {
            $sql .= ", anexo = ?";
            $params[] = $anexo;
        }

        $sql .= " WHERE id_publicacao = ?";
        $params[] = $id_publicacao;

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao atualizar publicação: " . $e->getMessage());
            return false;
        }
    }

    // Método para excluir uma publicação
    public static function deletePublication($id_publicacao)
    {
        $conn = Connection::getConnection();
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
}
