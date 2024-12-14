<?php
class Connection {
    public static function getConnection() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        
        try {
            // Conexão ao banco de dados
            $conn = new PDO("mysql:host=$servername;dbname=projeto_web", $username, $password);
            // Configura o modo de erro para exceção
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            error_log("Connection failed: " . $e->getMessage()); 
            return null;
        }
    }
}
?>
