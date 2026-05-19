<?php
// 1. Inclui as configurações de banco de dados
require_once 'config.php';

// Criamos uma variável para armazenar mensagens de sucesso ou erro na tela
$mensagem = "";

// 2. VERIFICAÇÃO: O utilizador clicou no botão "Salvar" do formulário?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Captura os dados enviados pelo formulário
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';

    // Validação simples: Garante que os campos obrigatórios não estão vazios
    if (!empty($nome) && !empty($email)) {
        
        try {
            // 3. COMANDO SQL COM PARÂMETROS SUBSTITUTOS (?)
            // Em vez de colocar as variáveis direto no SQL, colocamos interrogações.
            $sql = "INSERT INTO contatos (nome, email, telefone) VALUES (?, ?, ?)";
            
            // 4. PREPARAR A CONSULTA (O MySQL analisa a estrutura do comando antes de receber os dados)
            $stmt = $pdo->prepare($sql);
            
            // 5. EXECUTAR PASSANDO OS DADOS (Os dados são limpos e tratados aqui)
            $stmt->execute([$nome, $email, $telefone]);
            
            // Se chegou aqui, deu certo!
            $mensagem = "<p style='color: green; font-weight: bold;'>✅ Contacto cadastrado com sucesso!</p>";
            
        } catch (PDOException $e) {
            $mensagem = "<p style='color: red;'>❌ Erro ao cadastrar no banco: " . $e->getMessage() . "</p>";
        }
        
    } else {
        $mensagem = "<p style='color: orange;'>⚠️ Por favor, preencha os campos obrigatórios (Nome e E-mail).</p>";
    }
}

// 6. Inclui o cabeçalho visual do site
include 'cabecalho.php';
?>

<div class="container" style="max-width: 500px; margin: 30px auto; font-family: Arial, sans-serif;">
    <h2>➕ Adicionar Novo Contacto</h2>
    
    <a href="index.php" style="text-decoration: none; color: #007BFF;">⬅️ Voltar para a lista</a>
    
    <?php echo $mensagem; ?>

    <form action="cadastrar.php" method="POST" style="margin-top: 20px; display: flex; flex-direction: column; gap: 15px;">
        
        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nome *</label>
            <input type="text" name="nome" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">E-mail *</label>
            <input type="email" name="email" required style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Telefone</label>
            <input type="text" name="telefone" placeholder="(11) 99999-1111" style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <button type="submit" style="background-color: #28a745; color: white; border: none; padding: 10px; cursor: pointer; font-size: 16px; border-radius: 4px;">
            💾 Salvar Contacto
        </button>
    </form>
</div>