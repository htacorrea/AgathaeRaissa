<?php
include 'functionsr.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $namer = isset($_POST['namer']) ? $_POST['namer'] : '';
        $ano = isset($_POST['ano']) ? $_POST['ano'] : '';
        $edicao = isset($_POST['edicao']) ? $_POST['edicao'] : '';
        $datacadastro = isset($_POST['datacadastro']) ? $_POST['datacadastro'] : date('Y-m-d H:i:s');
        $foto = isset($_POST['foto']) ? $_POST['foto'] : '';
       
        // Update the record
        $stmt = $pdo->prepare('UPDATE revistas SET namer = ?, ano = ?, edicao = ?, foto = ? WHERE id = ?');
        $stmt->execute([ $namer, $ano, $edicao, $foto, $_GET['id']]);
        $msg = 'Updated bem sucedido!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM revistas WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $revista = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$revista) {
        exit('Não existe revista com esse ID!');
    }
} else {
    exit('Nenhum ID especificado!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update revista #<?=$revista['id']?></h2>
    <form action="updater.php?id=<?=$revista['id']?>" method="post">
        <label for="id">ID</label>
        <label for="namer">Nome</label>
        <input type="text" name="id" placeholder="1" value="<?=$revista['id']?>" id="id" disabled>
        <input type="text" name="namer" placeholder="People" value="<?=$revista['namer']?>" id="namer">
        <label for="ano">Ano</label>
        <label for="edicao">edicao</label>
        <input type="text" name="ano" placeholder="2023" value="<?=$revista['ano']?>" id="ano">
        <input type="text" name="edicao" placeholder="235321" value="<?=$revista['edicao']?>" id="edicao">
        <label for="datacadastro">Criado em: </label>
        <label for="foto">Foto</label>
        <input type="datetime-local" name="datacadastro" value="<?=date('D-m-y\TH:i', strtotime($revista['datacadastro']))?>" id="datacadastro" disabled>
        <input type="file" name="foto" placeholder="people.jpeg" value="<?=$revista['foto']?>" id="foto">
        <input type="submit" value="Update">
        <a class="inicio" href="readr.php">Voltar</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>