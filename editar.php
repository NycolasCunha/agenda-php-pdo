<?php
require_once 'config.php';

$mensagem = "";

// 1. VERIFICAÇÃO: O ID do contato veio na URL?
$id = $_GET['id'] ?? null;

if (!$id) {
    // Se não tem ID, manda de volta para a lista
    header('Location: index.php');
    exit;
}

// 2. BUSCAR OS DADOS ATUAIS DO CONTATO PARA COLOCAR NO FORMULÁRIO
try {
    $stmt = $pdo->prepare("SELECT * FROM contatos WHERE id = ?");
    $stmt->execute([$id]);
    $contato = $stmt->fetch();

    if (!$contato) {
        die("Contato não encontrado!");
    }
} catch (PDOException $e) {
    die("Erro ao buscar dados: " . $e->getMessage());
}

// 3. PROCESSAR A ATUALIZAÇÃO (Caso o formulário seja enviado)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';

    if (!empty($nome) && !empty($email)) {
        try {
            // Prepared Statement para o UPDATE seguro
            $sql = "UPDATE contatos SET nome = ?, email = ?, telefone = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $email, $telefone, $id]);

            $mensagem = "<p style='color: green; font-weight: bold;'>✅ Contato atualizado com sucesso!</p>";
            
            // Recarrega os dados novos para atualizar os campos do formulário na tela
            $contato['nome'] = $nome;
            $contato['email'] = $email;
            $contato['telefone'] = $telefone;

        } catch (PDOException $e) {
            $mensagem = "<p style='color: red;'>❌ Erro ao atualizar: " . $e->getMessage() . "</p>";
        }
    } else {
        $mensagem = "<p style='color: orange;'>⚠️ Preencha os campos obrigatórios.</p>";
    }
}

include 'cabecalho.php';
?>

<div class="container" style="max-width: 500px; margin: 30px auto; font-family: Arial, sans-serif;">
    <h2>✏️ Editar Contato</h2>
    <a href="index.php" style="text-decoration: none; color: #007BFF;">⬅️ Voltar para a lista</a>
    
    <?php echo $mensagem; ?>

    <form action="editar.php?id=<?php echo $id; ?>" method="POST" style="margin-top: 20px; display: flex; flex-direction: column; gap: 15px;">
        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nome *</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($contato['nome']); ?>" required style="width: 100%; padding: 8px;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">E-mail *</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($contato['email']); ?>" required style="width: 100%; padding: 8px;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Telefone</label>
            <input type="text" name="telefone" value="<?php echo htmlspecialchars($contato['telefone']); ?>" style="width: 100%; padding: 8px;">
        </div>

        <button type="submit" style="background-color: #007BFF; color: white; border: none; padding: 10px; cursor: pointer; font-size: 16px; border-radius: 4px;">
            💾 Salvar Alterações
        </button>
    </form>
</div>