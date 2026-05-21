<?php 
require_once 'config.php';
include_once 'funcoes.php'; 

// Chamada utilizando a função centralizada do arquivo de funções
$contatos = obterContatos($pdo);

include 'cabecalho.php';
?>

<div class="container">
    <h2>📋 Lista de Contactos</h2>
    
    <a href="cadastrar.php" class="btn-novo">➕ Adicionar Novo Contacto</a>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Criado em</th>
                <th>Ações</th> 
            </tr>
        </thead>
        <tbody>
            <?php if (count($contatos) > 0): ?>
                <?php foreach ($contatos as $contato): ?>
                    <tr>
                        <td><?php echo $contato['id']; ?></td>
                        <td><?php echo htmlspecialchars($contato['nome']); ?></td>
                        <td><?php echo htmlspecialchars($contato['email']); ?></td>
                        <td><?php echo htmlspecialchars($contato['telefone']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($contato['created_at'])); ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $contato['id']; ?>" style="color: #007BFF; text-decoration: none; margin-right: 10px;">✏️ Editar</a>
                            <a href="excluir.php?id=<?php echo $contato['id']; ?>" style="color: #DC3545; text-decoration: none;">❌ Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Nenhum contacto encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>