<?php
require_once '/xampp/htdocs/projetoWeb/model/DAO/PublicacoesDAO.php';

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
}
?>
