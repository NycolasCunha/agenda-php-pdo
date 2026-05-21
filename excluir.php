<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

// Busca o nome do contato apenas para exibir na tela antes de deletar
try {
    $stmt = $pdo->prepare("SELECT nome FROM contatos WHERE id = ?");
    $stmt->execute([$id]);
    $contato = $stmt->fetch();
    if (!$contato) {
        die("Contato não encontrado.");
    }
} catch (PDOException $e) {
    die("Erro ao buscar registro: " . $e->getMessage());
}

// Segurança Exigida no Exercício 5: A remoção só ocorre caso venha via POST confirmando
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("DELETE FROM contatos WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        die("Erro ao excluir registro: " . $e->getMessage());
    }
}

include 'cabecalho.php';
?>

<div class="container" style="max-width: 500px; text-align: center; margin-top: 50px;">
    <h2 style="color: #DC3545;">⚠️ Confirmar Exclusão</h2>
    <p>Tem certeza que deseja excluir permanentemente o contato <strong><?php echo htmlspecialchars($contato['nome']); ?></strong>?</p>
    
    <form action="excluir.php?id=<?php echo $id; ?>" method="POST" style="margin-top: 20px; display: flex; gap: 15px; justify-content: center;">
        <a href="index.php" style="padding: 10px 20px; background: #ccc; color: #333; text-decoration: none; border-radius: 4px; font-weight: bold;">Cancelar</a>
        <button type="submit" style="padding: 10px 20px; background: #DC3545; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Sim, Excluir</button>
    </form>
</div>