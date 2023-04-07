<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="font.css">
		<title> CRUD - PHP com mysqli </title>
	</head>
	<body>
		<?php
		include("indexr2.php")
		?>
		<div class="container mt-3">
            <h1>Filtrar</h1><br>
			<?php
            
                include_once('conexaor.php');
                
                $verifica = 1;
                $verifica2 = 1;
                function convertedata($data){
					$data_vetor = explode('-', $data);
					$novadata = implode('/', array_reverse ($data_vetor));
					return $novadata;
				}

                $filtrarPor = $_POST['filtrarpor'];
                echo "<div class='container mt-3'><h4>";
                switch($filtrarPor){
                    case "2":
                        echo 'Filtrando por nome ';
                        $verifica = 2;
                        break;
                    case "3":
                        echo 'Filtrando por ano ';
                        $verifica = 3;
                        break;
                    case "4":
                        echo 'Filtrando por edição ';
                        $verifica = 4;
                        break;
                    case "5":
                        echo 'Filtrando por data de criação ';
                        $verifica = 5;
                        break;  
                }
                $ordem = $_POST['ordem'];
                switch($ordem){
                    case "cmc":
                        echo 'que começa por';
                        $verifica2 = 2;
                        break;
                    case "cont":
                        echo 'que contém';
                        $verifica2 = 3;
                        break;
                    case "term":
                        echo 'que termina';
                        $verifica2 = 4;
                        break;   
                }

                if($verifica == 2 && $verifica2 == 2){
                    $filtro = $_POST['filtrar']; 
                    $filtrar = mysqli_query($conexao, "select * from revistas where namer like '$filtro%'");
                }
                else if($verifica == 2 && $verifica2 == 3){
                    $filtro = $_POST['filtrar']; 
                    $filtrar = mysqli_query($conexao, "select * from revistas where namer like '%$filtro%'");
                }
                else if($verifica == 2 && $verifica2 == 4){
                    $filtro = $_POST['filtrar']; 
                    $filtrar = mysqli_query($conexao, "select * from revistas where namer like '%$filtro'");
                }
                else if($verifica == 3 && $verifica2 == 2){
                    $filtro = $_POST['filtrar']; 
                    $filtrar = mysqli_query($conexao, "select * from revistas where ano like '$filtro%'");
                }
                else if($verifica == 3 && $verifica2 == 3){
                    $filtro = $_POST['filtrar']; 
                    $filtrar = mysqli_query($conexao, "select * from revistas where ano like '%$filtro%'");
                }
                else if($verifica == 3 && $verifica2 == 4){
                    $filtro = $_POST['filtrar']; 
                    $filtrar = mysqli_query($conexao, "select * from revistas where ano like '%$filtro'");
                }
                else if($verifica == 4 && $verifica2 == 2){
                    $filtro = $_POST['filtrar']; 
                    $filtrar = mysqli_query($conexao, "select * from revistas where edicao like '$filtro%'");
                }
                else if($verifica == 4 && $verifica2 == 3){
                    $filtro = $_POST['filtrar']; 
                    $filtrar = mysqli_query($conexao, "select * from revistas where edicao like '%$filtro%'");
                }
                else if($verifica == 4 && $verifica2 == 4){
                    $filtro = $_POST['filtrar']; 
                    $filtrar = mysqli_query($conexao, "select * from revistas where edicao like '%$filtro'");
                }
                else if($verifica == 5 && $verifica2 == 2){
                    $filtro = $_POST['filtrar']; 
                    $filtrar = mysqli_query($conexao, "select * from revistas where datacadastro like '$filtro%'");
                }
                else if($verifica == 5 && $verifica2 == 3){
                    $filtro = $_POST['filtrar']; 
                    $filtrar = mysqli_query($conexao, "select * from revistas where datacadastro like '%$filtro%'");
                }
                else if($verifica == 5 && $verifica2 == 4){
                    $filtro = $_POST['filtrar']; 
                    $filtrar = mysqli_query($conexao, "select * from revistas where datacadastro like '%$filtro'");
                }

                
                echo ': "',$filtro,'"';
                echo "</div></h4>";
                echo "<table class='table table-bordered'>";
                echo "<thead>";
                    echo "<tr class='table-dark'>
                            <th width='100px'>Nome</th>
                            <th width='100px'>Ano</th>
                            <th width='100px'>Edição</th>
                            <th width='100px'>Data de Criação</th>
                            <th width='100px'>Foto</th>
                        </tr>";
                echo "</thead>";

                while($dados=mysqli_fetch_array($filtrar)) 
                {
                    echo "<tr class='table-dark'>";
                    echo "<td>". $dados['namer']."</td>";
                    echo "<td>". $dados['ano']."</td>";
                    echo "<td>". $dados['edicao']."</td>";
                    echo "<td>".convertedata($dados['datacadastro'])."</td>";				
                    // buscando a na pasta imagem
                }
                echo "</table>";
                mysqli_close($conexao);
            ?>
            <br>
			<p><input type='button' class="btn btn-dark" onclick="window.location='readr.php';" value="Voltar"></p>
		</div>
	</body>
</html>