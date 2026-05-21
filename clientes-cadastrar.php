<?php
// 1. Inclui as configurações de ligação ao banco de dados
require_once 'config.php';

$mensagem = "";

// 2. Processa o formulário quando enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $endereco = $_POST['endereco'] ?? '';

    // Validação simples dos campos obrigatórios
    if (!empty($nome) && !empty($cpf) && !empty($email)) {
        try {
            $sql = "INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $cpf, $email, $telefone, $endereco]);
            
            $mensagem = "<p style='color: green; font-weight: bold;'>✅ Cliente cadastrado com sucesso!</p>";
        } catch (PDOException $e) {
            $mensagem = "<p style='color: red; font-weight: bold;'>❌ Erro ao cadastrar cliente: " . $e->getMessage() . "</p>";
        }
    } else {
        $mensagem = "<p style='color: orange; font-weight: bold;'>⚠️ Por favor, preencha os campos obrigatórios (Nome, CPF e E-mail).</p>";
    }
}

// 3. Inclui o cabeçalho visual
include 'cabecalho.php';
?>

<div class="container" style="max-width: 600px; margin: 30px auto; font-family: Arial, sans-serif;">
    <h2>➕ Cadastrar Novo Cliente</h2>
    <a href="clientes.php" style="text-decoration: none; color: #007BFF; font-weight: bold;">⬅️ Voltar para Clientes</a>
    
    <?php echo $mensagem; ?>

    <form action="clientes-cadastrar.php" method="POST" style="margin-top: 20px; display: flex; flex-direction: column; gap: 15px;">
        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nome Completo *</label>
            <input type="text" name="nome" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">CPF *</label>
            <input type="text" name="cpf" required placeholder="000.000.000-00" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">E-mail *</label>
            <input type="email" name="email" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Telefone</label>
            <input type="text" name="telefone" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Endereço Residencial</label>
            <input type="text" name="endereco" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <button type="submit" style="background-color: #28a745; color: white; border: none; padding: 10px 20px; font-weight: bold; border-radius: 4px; cursor: pointer; width: fit-content;">💾 Salvar Cliente</button>
    </form>
</div>