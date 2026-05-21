<?php
require_once 'config.php';

// 1. Pega o ID vindo da URL
$id = $_GET['id'] ?? null;

if ($id) {
    try {
        // 2. Executa o comando DELETE usando Prepared Statements por segurança
        $stmt = $pdo->prepare("DELETE FROM contatos WHERE id = ?");
        $stmt->execute([$id]);
        
    } catch (PDOException $e) {
        die("Erro ao excluir registro: " . $e->getMessage());
    }
}

// 3. Redireciona de volta para a página principal atualizada
header("Location: index.php");
exit;