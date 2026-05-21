<?php
require_once 'config.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? 0;
    $estoque = $_POST['estoque'] ?? 0;
    $imagemNome = ''; 

    // Lógica para upload de imagem (Tarefas 33 e 39)
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagemNome = uniqid() . "." . $extensao; // Evita arquivos duplicados com o mesmo nome
        
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $imagemNome);
    }

    if (!empty($nome) && $preco > 0) {
        try {
            $sql = "INSERT INTO produtos (nome, descricao, preco, estoque, imagem) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $descricao, $preco, $estoque, $imagemNome]);
            
            $mensagem = "<p style='color: green; font-weight: bold;'>✅ Produto cadastrado com sucesso!</p>";
        } catch (PDOException $e) {
            $mensagem = "<p style='color: red; font-weight: bold;'>❌ Erro ao salvar produto: " . $e->getMessage() . "</p>";
        }
    } else {
        $mensagem = "<p style='color: orange; font-weight: bold;'>⚠️ Insira um nome e preço válidos.</p>";
    }
}

include 'cabecalho.php';
?>

<div class="container" style="max-width: 600px;">
    <h2>➕ Cadastrar Novo Produto</h2>
    <a href="produtos.php" style="color: #007BFF; text-decoration: none; font-weight: bold;">⬅️ Voltar para Produtos</a>
    
    <?php echo $mensagem; ?>

    <form action="produtos-cadastrar.php" method="POST" enctype="multipart/form-data" style="margin-top: 20px; display: flex; flex-direction: column; gap: 15px;">
        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nome do Produto *</label>
            <input type="text" name="nome" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Descrição</label>
            <textarea name="descricao" rows="3" style="width: 100%; padding: 8px; box-sizing: border-box;"></textarea>
        </div>

        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Preço (R$) *</label>
            <input type="number" step="0.01" name="preco" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Quantidade em Estoque *</label>
            <input type="number" name="estoque" value="0" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Imagem do Produto</label>
            <input type="file" name="imagem" accept="image/*">
        </div>

        <button type="submit" style="background-color: #3498db; color: white; border: none; padding: 10px 20px; font-weight: bold; border-radius: 4px; cursor: pointer; width: fit-content;">💾 Salvar Produto</button>
    </form>
</div>