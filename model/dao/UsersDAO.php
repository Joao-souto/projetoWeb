<?php
require_once '/xampp/htdocs/projetoWeb/util/Connection.php';
require_once '/xampp/htdocs/projetoWeb/model/entidades/Users.php';

class UsersDAO
{
    // Método para criar um novo usuário
    public static function createUser(Users $usuario)
    {
        $conn = Connection::getConnection(); // Obtemos a conexão
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

    // Método para verificar login válido
    public static function isValidLogin($email, $senha)
    {
        $conn = Connection::getConnection();
        if ($conn === null) {
            return null;
        }

        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email, $senha]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                $usuario = new Users($resultado['nome'], $resultado['email'], $resultado['senha']);
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

    // Método para consultar ID de usuário
    public static function getIdUser(Users $usuario)
    {
        $conn = Connection::getConnection();
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
    public static function getUser(Users $usuario)
    {
        if ($usuario->getIdUsuario() == 0) {
            $usuario->setIdUsuario(self::getIdUser($usuario));
        }

        $conn = Connection::getConnection();
        if ($conn === null) {
            return null;
        }

        $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$usuario->getIdUsuario()]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                $usuario = new Users($resultado['nome'], $resultado['email'], $resultado['senha']);
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

    // Método para consultar um usuário pelo id
    public static function getUserById(int $idUsuario)
    {

        $conn = Connection::getConnection();
        if ($conn === null) {
            return null;
        }

        $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute([$idUsuario]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                $usuario = new Users($resultado['nome'], $resultado['email'], $resultado['senha']);
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

    // Método para listar todos os usuários
    public static function getAllUsers()
    {
        $conn = Connection::getConnection();
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

    // Método para atualizar um usuário
    public static function updateUser(Users $usuario)
    {
        if ($usuario->getIdUsuario() == 0) {
            $usuario->setIdUsuario(self::getIdUser($usuario));
        }

        $conn = Connection::getConnection();
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
    public static function deleteUser(Users $usuario)
    {
        if ($usuario->getIdUsuario() == 0) {
            $usuario->setIdUsuario(self::getIdUser($usuario));
        }

        $conn = Connection::getConnection();
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
}
