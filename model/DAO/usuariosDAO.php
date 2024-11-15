<?php

class UsuarioDAO {
    // Método para criar um novo usuário
    public function criarUsuario($nome, $email, $senha) {
        $conn = Conexao::getConexao(); // Obtemos a conexão
        if ($conn === null) {
            return false;
        }
        
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nome, $email, $senha]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao criar usuário: " . $e->getMessage());
            return false;
        }
    }

    // Método para obter um usuário pelo ID
    public function obterUsuario($id_usuario) {
        $conn = Conexao::getConexao();
        if ($conn === null) {
            return null;
        }

        $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_usuario]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao obter usuário: " . $e->getMessage());
            return null;
        }
    }

    // Método para atualizar um usuário
    public function atualizarUsuario($id_usuario, $nome, $email, $senha) {
        $conn = Conexao::getConexao();
        if ($conn === null) {
            return false;
        }

        $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id_usuario = ?";
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nome, $email, $senha, $id_usuario]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao atualizar usuário: " . $e->getMessage());
            return false;
        }
    }

    // Método para excluir um usuário
    public function excluirUsuario($id_usuario) {
        $conn = Conexao::getConexao();
        if ($conn === null) {
            return false;
        }

        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_usuario]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao excluir usuário: " . $e->getMessage());
            return false;
        }
    }

    // Método para listar todos os usuários
    public function listarUsuarios() {
        $conn = Conexao::getConexao();
        if ($conn === null) {
            return [];
        }

        $sql = "SELECT * FROM usuarios";
        
        try {
            $stmt = $conn->prepare($sql); // Usando prepare() para segurança
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar usuários: " . $e->getMessage());
            return [];
        }
    }
}
?>
