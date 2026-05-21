<?php
require_once 'config.php';
include_once 'funcoes.php';

// Chamada utilizando a função centralizada
$produtos = obterProdutos($pdo);

include 'cabecalho.php';
?>

<div class="container" style="padding: 20px; font-family: Arial, sans-serif;">
    <h2>📦 Gerenciamento de Produtos</h2>
    
    <p>
        <a href="produtos-cadastrar.php" class="btn-novo" style="background-color: #28a745;">➕ Novo Produto</a>
    </p>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>ID</th>
                <th>Imagem</th> <th>Nome</th>
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
                        <td>
                            <?php if(!empty($produto['imagem'])): ?>
                                <img src="uploads/<?php echo $produto['imagem']; ?>" width="50" height="50" style="object-fit: cover; border-radius: 4px;">
                            <?php else: ?>
                                <span style="color: #999; font-size: 12px;">Sem foto</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                        <td><?php echo htmlspecialchars($produto['descricao']); ?></td>
                        <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $produto['estoque']; ?> unidades</td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Nenhum produto cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>