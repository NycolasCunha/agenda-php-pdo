<?php
require_once 'config.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega os dados vindos do formulário
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? 0;
    $estoque = $_POST['estoque'] ?? 0;

    // Validação simples: Nome, Preço e Estoque são obrigatórios
    if (!empty($nome) && $preco !== '' && $estoque !== '') {
        try {
            // Prepared Statement padrão e seguro
            $sql = "INSERT INTO produtos (nome, descricao, preco, estoque) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $descricao, $preco, $estoque]);

            $mensagem = "<p style='color: green; font-weight: bold;'>✅ Produto cadastrado com sucesso!</p>";
        } catch (PDOException $e) {
            $mensagem = "<p style='color: red;'>❌ Erro ao salvar produto: " . $e->getMessage() . "</p>";
        }
    } else {
        $mensagem = "<p style='color: orange;'>⚠️ Por favor, preencha todos os campos obrigatórios (*).</p>";
    }
}

include 'cabecalho.php';
?>

<div class="container" style="max-width: 500px; margin: 30px auto; font-family: Arial, sans-serif;">
    <h2>➕ Cadastrar Novo Produto</h2>
    <a href="produtos.php" style="text-decoration: none; color: #007BFF;">⬅️ Voltar para a lista de produtos</a>
    
    <?php echo $mensagem; ?>

    <form action="produtos-cadastrar.php" method="POST" style="margin-top: 20px; display: flex; flex-direction: column; gap: 12px;">
        <div>
            <label style="display: block; margin-bottom: 3px; font-weight: bold;">Nome do Produto *</label>
            <input type="text" name="nome" required style="width: 100%; padding: 8px;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 3px; font-weight: bold;">Descrição</label>
            <textarea name="descricao" rows="3" style="width: 100%; padding: 8px; box-sizing: border-box;"></textarea>
        </div>

        <div>
            <label style="display: block; margin-bottom: 3px; font-weight: bold;">Preço (Ex: 99.90) *</label>
            <input type="number" name="preco" step="0.01" min="0" required style="width: 100%; padding: 8px;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 3px; font-weight: bold;">Quantidade em Estoque *</label>
            <input type="number" name="estoque" min="0" required style="width: 100%; padding: 8px;">
        </div>

        <button type="submit" style="background-color: #28a745; color: white; border: none; padding: 10px; cursor: pointer; font-size: 16px; border-radius: 4px; margin-top: 10px;">
            💾 Salvar Produto
        </button>
    </form>
</div>