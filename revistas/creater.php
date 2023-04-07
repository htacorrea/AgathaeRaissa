<?php
include_once('conexaor.php');
include 'functionsr.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $namer = isset($_POST['namer']) ? $_POST['namer'] : '';
    $ano = isset($_POST['ano']) ? $_POST['ano'] : '';
    $edicao = isset($_POST['edicao']) ? $_POST['edicao'] : '';
    $datacadastro = isset($_POST['datacadastro']) ? $_POST['datacadastro'] : date('D-m-y H:i:s');
    $countfiles = count($_FILES['files']['name']);
    $stmt = $pdo->prepare('INSERT INTO revistas VALUES (?, ?, ?, ?, ?, ?)');

	    for($i = 0; $i < $countfiles; $i++) {
	  
		$filename = $_FILES['files']['name'][$i];
		
		$target_file = './revistas/'.$filename;
		  
		$file_extension = pathinfo(
		$target_file, PATHINFO_EXTENSION);
				 
		$file_extension = strtolower($file_extension);
		  
		$valid_extension = array("png","jpeg","jpg");
		  
			if(in_array($file_extension, $valid_extension)) {
                echo $target_file;
                echo $_FILES['files']['tmp_name'][$i];
				if(move_uploaded_file(
					$_FILES['files']['tmp_name'][$i],
					$target_file)
				) {
					$foto = $filename;
					$stmt->execute([$id, $namer, $ano, $edicao, $datacadastro, $foto]);
                    header('location: read.php');
				}
			}
		}
    
    // Output message
    $msg = 'Criado com sucesso!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Criar revista</h2>
    <form action="creater.php" method="post" enctype="multipart/form-data">
        <label for="id">ID</label>
        <label for="namer">Nome</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id" disabled>
        <input type="text" name="namer" placeholder="People" id="namer" required="required">
        <label for="ano">Ano</label>
        <label for="edicao">Edicao</label>
        <input type="text" name="ano" placeholder="2023" id="ano" required="required">
        <input type="text" name="edicao" placeholder="235321" id="edicao" required="required">
        <label for="datacadastro">Criado em: </label>
        <label for="foto">Foto</label>
        <input type="datetime-local" name="datacadastro" value="<?=date('D-m-y\TH:i')?>" id="datacadastro" required="required">
        <input type="file" class="form-control " placeholder="people.png" name="files[]" id="files">
        <input type="submit" value="Create">
        <a class="inicio" href="readr.php">Voltar</a>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>