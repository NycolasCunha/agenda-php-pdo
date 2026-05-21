<?php
/**
 * Arquivo de Funções Reutilizáveis de Negócio
 * Centralização exigida nos Exercícios 3, 6 e 7
 */

// Busca todos os contatos (Exercício 3)
function obterContatos(PDO $pdo) {
    try {
        $sql = "SELECT * FROM contatos ORDER BY nome ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        die("Erro ao procurar contactos: " . $e->getMessage());
    }
}

// Busca todos os clientes (Exercício 6 / Tarefa 26)
function obterClientes(PDO $pdo) {
    try {
        $sql = "SELECT * FROM clientes ORDER BY nome ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        die("Erro ao buscar clientes: " . $e->getMessage());
    }
}

// Busca todos os produtos (Exercício 7)
function obterProdutos(PDO $pdo) {
    try {
        $sql = "SELECT * FROM produtos ORDER BY nome ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        die("Erro ao buscar produtos: " . $e->getMessage());
    }
}