<?php
include 'functionsr.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM revistas ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$revista = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_revista = $pdo->query('SELECT COUNT(*) FROM revistas')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Read Revistas</h2>
	<a href="creater.php" class="create-contact">Criar revista</a>
    
    <form name="produto" action="filtrarr.php" method="post">
				<!--<div class="form-floating mb-3 mt-3">-->
				<p><div class="preto">
					Filtrar por
					<select name = "filtrarpor">
						<option class="preto" value="2">Nome</option>
						<option class="preto" value="3">Ano</option>
						<option class="preto" value="4">Edição</option>
						<option class="preto" value="5">Data de criação</option>
					</select>
					Que
					<select name = "ordem">
						<option class="preto" value="cmc">Começa com</option>
						<option class="preto" value="cont">Contém</option>
						<option class="preto" value="term">Termina com</option>
					</select>
					Valor:  
					<input type="text" name="filtrar">
					<input type="submit" class="btn btn-dark" value = "Enviar">
				</div></p>
			</form>
            
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nome</td>
                <td>Ano</td>
                <td>Edição</td>
                <td>Criado em:</td>
                <td>Foto</td>
                <td></td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($revista as $revista): ?>
            <tr>
                <td><?=$revista['id']?></td>
                <td><?=$revista['namer']?></td>
                <td><?=$revista['ano']?></td>
                <td><?=$revista['edicao']?></td>
                <td><?=$revista['datacadastro']?></td>
                <td><?=$revista['foto']?></td>
                <td class="actions">
                    <a href="updater.php?id=<?=$revista['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="deleter.php?id=<?=$revista['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="readr.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_revista): ?>
		<a href="readr.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>