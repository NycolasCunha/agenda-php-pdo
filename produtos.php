<?php
// 1. Inclui a ligação com o banco de dados
require_once 'config.php';

// 2. Consulta simples para buscar os produtos
try {
    $stmt = $pdo->query("SELECT * FROM produtos ORDER BY nome ASC");
    $produtos = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erro ao buscar produtos: " . $e->getMessage());
}

// 3. Inclui o cabeçalho visual
include 'cabecalho.php';
?>

<div class="container" style="padding: 20px; font-family: Arial, sans-serif;">
    <h2>📦 Gerenciamento de Produtos</h2>
    
    <p>
        <a href="index.php" style="text-decoration: none; color: #007BFF; margin-right: 15px;">📇 Ver Contatos</a>
        <a href="produtos-cadastrar.php" style="background-color: #28a745; color: white; padding: 7px 12px; text-decoration: none; border-radius: 4px;">➕ Novo Produto</a>
    </p>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Estoque</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($produtos) > 0): ?>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?php echo $produto['id']; ?></td>
                        <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                        <td><?php echo htmlspecialchars($produto['descricao']); ?></td>
                        <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $produto['estoque']; ?> unidades</td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Nenhum produto cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>