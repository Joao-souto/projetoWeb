<?php
require_once '../model/DAO/UsuariosDAO.php';
require_once '../model/entidades/Usuarios.php';

class UsuariosController {
    // Método para criar um novo usuário
    public static function cadastrarUsuario($nome, $email, $senha) {
        // Verifica se os campos não estão vazios
        if (empty($nome) || empty($email) || empty($senha)) {
            return "Por favor, preencha todos os campos.";
        }

        // Verifica o formato do e-mail
        if (!filter_var(  $email, FILTER_VALIDATE_EMAIL)) {
            return "E-mail inválido.";
        }

        // Cria o usuário utilizando o DAO
        try {
            $usuario = new Usuarios($nome, $email, $senha);
            $resultado = UsuariosDAO::cadastrarUsuario($usuario);
            if ($resultado) {
                return "Usuário cadastrado com sucesso!";
            } else {
                return "Erro ao cadastrar o usuário.";
            }
        } catch (Exception $e) {
            error_log("Erro no cadastro de usuário: " . $e->getMessage());
            return "Ocorreu um erro inesperado.";
        }
    }

    // Método para realizar o login
    public static function realizarLogin($email, $senha) {
        // Verifica se os campos não estão vazios
        if (empty($email) || empty($senha)) {
            return "Por favor, preencha todos os campos.";
        }

        // Cria usuario
        $usuarioLogin = new Usuarios("", $email, $senha);

        // Busca o usuário utilizando o DAO
        $usuario = UsuariosDAO::loginValido($email, $senha);
        if ($usuario) {
            return $usuario; // Retorna o objeto usuário consultado no banco, Login válido
        } else {
            return $usuarioLogin; // Retorna o objeto usuário com login inválido
        }
    }

    // Método para listar todos os usuários
    public static function listarUsuarios() {
        try {
            $usuarios = UsuariosDAO::listarUsuarios();
            return $usuarios;
        } catch (Exception $e) {
            error_log("Erro ao listar usuários: " . $e->getMessage());
            return [];
        }
    }
}
?>
