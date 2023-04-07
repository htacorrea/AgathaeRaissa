<?php
include 'functionsr.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM revistas WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $revista = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$revista) {
        exit('Não existem revistas com esse ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM revistas WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Você deletou a revista!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: revistas/readr.php');
            exit;
        }
    }
} else {
    exit('Nenhum ID especificado!');
}

?>

<?=template_header('Delete')?>

<div class="Conteúdo deletado">
	<h2>Deletar revista número <?=$revista['id']?>?</h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Tem certeza que quer deletar a revista #<?=$revista['id']?>?</p>
    <div class="yesno">
        <a href="deleter.php?id=<?=$revista['id']?>&confirm=yes" class="btn btn-outline-danger">Sim</a>
        <a href="readr.php?id=<?=$revista['id']?>&confirm=no" class="delete">Não</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>