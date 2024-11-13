<?php
    // Configurações do banco de dados
    $dsn = 'mysql:host=localhost;dbname=projeto_web';
    $username = 'root';
    $password = '';

    // try {
    //     // Conexão com o banco de dados usando PDO
    //     $pdo = new PDO($dsn, $username, $password);
        
    //     // Configura para lançar exceções em caso de erros
    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    //     // Verifica se o formulário foi submetido
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         // Obtém os dados do formulário
    //         $nome = $_POST['nome'];
    //         $data_nascimento = $_POST['data_nascimento'];
    //         $cidade = $_POST['cidade'];
    //         $bairro = $_POST['bairro'];
            
    //         // Prepara a consulta SQL
    //         $sql = "INSERT INTO lista (nome, data_nascimento, cidade, bairro) VALUES (:nome, :data_nascimento, :cidade, :bairro)";
            
    //         // Prepara a declaração
    //         $stmt = $pdo->prepare($sql);
            
    //         // Associa os parâmetros com os valores
    //         $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
    //         $stmt->bindValue(':data_nascimento', $data_nascimento, PDO::PARAM_STR);
    //         $stmt->bindValue(':cidade', $cidade, PDO::PARAM_STR);
    //         $stmt->bindValue(':bairro', $bairro, PDO::PARAM_STR);
            
    //         // Executa a consulta
    //         $stmt->execute();
            
    //         echo "Dados inseridos com sucesso!";
    //     }
    // } catch(PDOException $e) {
    //     // Em caso de erro, exibe a mensagem de erro
    //     echo "Erro: " . $e->getMessage();
    // }
?>