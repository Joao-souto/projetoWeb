<?php
require_once '/xampp/htdocs/projetoWeb/util/Conexao.php';
require_once '/xampp/htdocs/projetoWeb/model/entidades/Usuarios.php';

class UsuariosDAO {
    // Método para criar um novo usuário
    public static function cadastrarUsuario(Usuarios $usuario) {
        $conn = Conexao::getConexao(); // Obtemos a conexão
        if ($conn === null) {
            return false;
        }
        
        $sql = "INSERT INTO usuarios (nome, email, senha, foto_perfil) VALUES (?, ?, ?, ?)";
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $usuario->getNome(),
                $usuario->getEmail(),
                $usuario->getSenha(),
                $usuario->getFotoPerfil()
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao criar usuário: " . $e->getMessage());
            return false;
        }
    }

    // Método para consultar ID de usuário
    public static function consultarIdUsuario(Usuarios $usuario) {
        $conn = Conexao::getConexao();
        if ($conn === null) {
            return null;
        }
    
        $sql = "SELECT id_usuario FROM usuarios WHERE email = ?";
    
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$usuario->getEmail()]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ? $resultado['id_usuario'] : null;
        } catch (PDOException $e) {
            error_log("Erro ao obter ID de usuário: " . $e->getMessage());
            return null;
        }
    }

    // Método para consultar um usuário
    public static function consultarUsuario(Usuarios $usuario) {
        if ($usuario->getIdUsuario() == 0) {
            $usuario->setIdUsuario(self::consultarIdUsuario($usuario));
        }

        $conn = Conexao::getConexao();
        if ($conn === null) {
            return null;
        }
    
        $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
    
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$usuario->getIdUsuario()]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($resultado) {
                $usuario = new Usuarios($resultado['nome'], $resultado['email'], $resultado['senha']);
                $usuario->setIdUsuario($resultado['id_usuario']);
                $usuario->setDataCriacao($resultado['data_criacao']);
                $usuario->setFotoPerfil($resultado['foto_perfil']);
                return $usuario;
            } else {
                return null; // Usuário não encontrado
            }
        } catch (PDOException $e) {
            error_log("Erro ao obter usuário: " . $e->getMessage());
            return null;
        }
    }
    
    // Método para atualizar um usuário
    public static function atualizarUsuario(Usuarios $usuario) {
        if ($usuario->getIdUsuario() == 0) {
            $usuario->setIdUsuario(self::consultarIdUsuario($usuario));
        }

        $conn = Conexao::getConexao();
        if ($conn === null) {
            return false;
        }

        $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ?, foto_perfil = ? WHERE id_usuario = ?";
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $usuario->getNome(),
                $usuario->getEmail(),
                $usuario->getSenha(),
                $usuario->getFotoPerfil(),
                $usuario->getIdUsuario()
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao atualizar usuário: " . $e->getMessage());
            return false;
        }
    }

    // Método para excluir um usuário
    public static function excluirUsuario(Usuarios $usuario) {
        if ($usuario->getIdUsuario() == 0) {
            $usuario->setIdUsuario(self::consultarIdUsuario($usuario));
        }

        $conn = Conexao::getConexao();
        if ($conn === null) {
            return false;
        }

        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$usuario->getIdUsuario()]);
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao excluir usuário: " . $e->getMessage());
            return false;
        }
    }

    // Método para listar todos os usuários
    public static function listarUsuarios() {
        $conn = Conexao::getConexao();
        if ($conn === null) {
            return [];
        }

        $sql = "SELECT * FROM usuarios";
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar usuários: " . $e->getMessage());
            return [];
        }
    }

    // Método para verificar login válido
    public static function loginValido($email, $senha) {
        $conn = Conexao::getConexao();
        if ($conn === null) {
            return null;
        }
    
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
        
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email, $senha]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($resultado) {
                $usuario = new Usuarios($resultado['nome'], $resultado['email'], $resultado['senha']);
                $usuario->setIdUsuario($resultado['id_usuario']);
                $usuario->setDataCriacao($resultado['data_criacao']);
                $usuario->setFotoPerfil($resultado['foto_perfil']);
                $usuario->setLoginValido(true);

                return $usuario;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log("Erro ao verificar login: " . $e->getMessage());
            return null;
        }
    }
}
?>
