<?php
require_once '/xampp/htdocs/projetoWeb/model/DAO/UsuariosDAO.php';
require_once '/xampp/htdocs/projetoWeb/model/entidades/Usuarios.php';

class UsuariosController {
    // Método para criar um novo usuário
    public static function cadastrarUsuario($nome, $email, $senha) {
        // Verifica o formato do e-mail
        if (!filter_var(  $email, FILTER_VALIDATE_EMAIL)) {
            return "E-mail inválido.";
        }
        // Cria o usuário utilizando o DAO
        try {
            $usuario = new Usuarios($nome, $email, $senha);
            $resultado = UsuariosDAO::cadastrarUsuario($usuario);
            if ($resultado == true) {
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
    public static function realizarLogin($email, $senha): string|Usuarios {

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
            return UsuariosDAO::listarUsuarios();
        } catch (Exception $e) {
            error_log("Erro ao listar usuários: " . $e->getMessage());
            return [];
        }
    }

    // Método para atualizar os dados do usuário
    public static function atualizarUsuario($idUsuario, $nome, $email, $senha = null, $fotoPerfil = null) {
        try {
            // Verifica o formato do e-mail
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "E-mail inválido.";
            }
    
            // Busca o usuário atual pelo ID
            $usuarioAtual = UsuariosDAO::consultarUsuarioId($idUsuario);
    
            if (!$usuarioAtual) {
                return "Usuário não encontrado.";
            }
    
            // Atualiza os dados do usuário
            $usuarioAtual->setNome($nome);
            $usuarioAtual->setEmail($email);
            $usuarioAtual->setSenha($senha);
    
            // Atualiza a foto de perfil, se fornecida
            if ($fotoPerfil !== null) {
                $usuarioAtual->setFotoPerfil($fotoPerfil);
            }
    
            // Atualiza o usuário no banco de dados
            $resultado = UsuariosDAO::atualizarUsuario($usuarioAtual);
    
            if ($resultado) {
                return "Perfil atualizado com sucesso!";
            } else {
                return "Erro ao atualizar o perfil.";
            }
        } catch (Exception $e) {
            error_log("Erro na atualização de perfil: " . $e->getMessage());
            return "Ocorreu um erro inesperado.";
        }
    }

}
?>
