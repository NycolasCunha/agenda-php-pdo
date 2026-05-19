<?php
// 1. Inclui a conexão com o banco
require_once 'config.php';

// 2. Consulta simples para puxar os clientes
try {
    $stmt = $pdo->query("SELECT * FROM clientes ORDER BY nome ASC");
    $clientes = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erro ao buscar clientes: " . $e->getMessage());
}

// 3. Inclui o visual do topo
include 'cabecalho.php';
?>

<div class="container" style="padding: 20px; font-family: Arial, sans-serif;">
    <h2>👥 Gerenciamento de Clientes</h2>
    
    <p>
        <a href="index.php" style="text-decoration: none; color: #007BFF; margin-right: 15px;">📇 Ver Contatos</a>
        <a href="clientes-cadastrar.php" style="background-color: #28a745; color: white; padding: 7px 12px; text-decoration: none; border-radius: 4px;">➕ Novo Cliente</a>
    </p>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Endereço</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($clientes) > 0): ?>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente['id']; ?></td>
                        <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['endereco']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Nenhum cliente cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>