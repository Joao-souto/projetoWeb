<?php
class Conexao {
    public static function getConexao() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        
        try {
            // Conexão ao banco de dados
            $conn = new PDO("mysql:host=$servername;dbname=projeto_web", $username, $password);
            // Configura o modo de erro para exceção
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Em ambiente de produção, não exiba mensagens de sucesso
            // echo "Conectado com sucesso"; 

            return $conn;
        } catch(PDOException $e) {
            // Em um ambiente de produção, logue os erros em vez de exibir
            error_log("Connection failed: " . $e->getMessage()); 
            return null; // Retorna null se a conexão falhar
        }
    }
}
?>
