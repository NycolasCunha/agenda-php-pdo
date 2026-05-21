<?php
// Função exigida pelo Exercício 3 para buscar todos os contatos
function obterContatos(PDO $pdo) {
    try {
        $sql = "SELECT * FROM contatos ORDER BY nome ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        die("Erro ao procurar contactos: " . $e->getMessage());
    }
}