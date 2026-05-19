<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); 
define('DB_NAME', 'agenda'); 

// bloco de segurança "try" (tentar)
try {
    
    //  a DSN (Data Source Name), que é o endereço do banco de dados
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    
    // Criamos a conexão propriamente dita instanciando o PDO
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    
    // Configuração : Ativo o modo de erros para lançar Exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Configuração extra muito útil: define que o banco sempre nos retorne dados como Array Associativo
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Linha temporária apenas para testarmos no navegador se funcionou:
    echo "Conexão efetuada com sucesso!";

} 
//  Se algo der errado no bloco "try", o "catch" (capturar) entra em ação imediatamente
catch (PDOException $e) {
    
    // Interrompe o site e mostra uma mensagem limpa e controlada do erro
    die("Erro ao ligar ao banco de dados: " . $e->getMessage());
}