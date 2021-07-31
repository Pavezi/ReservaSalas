<?php

require_once 'config.php';

if (isset($_POST["status"])) {
    
    $emprestimo = new Emprestimo();
    $emprestimo->setData_devolucao($_POST["data_devolucao"]);
    $emprestimo->setStatus_emprestimo($_POST["status"]);
    $emprestimo->setCodigo_emprestimo($_POST["codigo_emprestimo"]);
    

    
    try {
            $emprestimo->AlteraDados($emprestimo->getData_devolucao(),
            $emprestimo->getStatus_emprestimo(), $emprestimo->getCodigo_emprestimo());
        
        // assign a variable
        if (!isset($_SESSION)) {
            session_start();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['postdata'] = $_POST;
            unset($_POST);
            unset($_SESSION['postdata']);
            echo "<script>alert('Dados atualizados com sucesso!!'); </script>";
            //header("location: cadastroLoja.php");
            echo "<script>window.location.href = 'pesquisaEmprestimo.php';</script>";
            exit;
        }
        
    } catch (ErrorException $e) {
        echo $e->getMessage();
        
    }
}

?>


<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Sistema de Controle da Biblioteca</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/formulario.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript" src="css/validacoes.js"></script>
  <style>

  </style>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
<h1><b><i>
<img src="imagens/logo.png"> <br><br>	Sistema de Controle da Biblioteca</i></b></h1>
	
</div>

	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Menu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <!-- Dropdown -->
      <li class="nav-item">
        <a class="nav-link" href="index.php"><img src="imagens/home.png" style="height: 23px; width: 23px; padding-bottom: 2px;"> Home</a>
      </li>
      <li class="nav-item dropdown">
	      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
	        <img src="imagens/livro.png" style="height: 23px; width: 20px; padding-bottom: 2px;"> Livros
	      </a>
	      <div class="dropdown-menu">
	        <a class="dropdown-item" href="cadastroLivro.php">Cadastro Livro</a>
	        <a class="dropdown-item" href="pesquisaLivro.php">Pesquisa Livro</a>
	      </div>
      </li>
      <li class="nav-item dropdown">
	      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
	        <img src="imagens/revista.png" style="height: 23px; width: 23px; padding-bottom: 2px;"> Revistas
	      </a>
	      <div class="dropdown-menu">
	        <a class="dropdown-item" href="cadastroRevista.php">Cadastro Revista</a>
	        <a class="dropdown-item" href="pesquisaRevista.php">Pesquisa Revista</a>
	      </div>
      </li>
      <li class="nav-item dropdown">
	      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
	        <img src="imagens/usuario.png" style="height: 23px; width: 23px; padding-bottom: 2px;"> Usuário
	      </a>
	      <div class="dropdown-menu">
	        <a class="dropdown-item" href="cadastroUsuario.php">Cadastro Usuário</a>
	        <a class="dropdown-item" href="pesquisaUsuario.php">Pesquisa Usuário</a>
	      </div>
      </li>
      <li class="nav-item dropdown">
	      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
	        <img src="imagens/emprestimo.png" style="height: 23px; width: 23px; padding-bottom: 2px;"> Empréstimo
	      </a>
	      <div class="dropdown-menu">
	        <a class="dropdown-item" href="cadastroEmprestimo.php">Cadastro Empréstimo Livro</a>
	        <a class="dropdown-item" href="cadastroEmprestimoRevista.php">Cadastro Empréstimo Revista</a>
	        <a class="dropdown-item" href="pesquisaEmprestimo.php">Pesquisa Empréstimo</a>
	      </div>
      </li>
      </ul>
  </div>  
</nav>

<div class="container-fluid" style="margin-top: 30px">
		<div class="row">
			<div class="col-sm-12">
				
				<form id="loja" action="alteraEmprestimo.php" method="post" onsubmit="this.submit(); this.reset(); return false;">
					<h2><i>ALTERA STATUS DO EMPRÉSTIMO</i></h2>
					<br>
					<?php 
    					if (isset($_POST["codigo_emprestimo"])) {
    					   	$emprestimo = new Emprestimo();
    					   	$emprestimo->setCodigo_emprestimo($_POST["codigo_emprestimo"]);
    					   	
    					   	$result = $emprestimo->SelecionaDados($emprestimo->getCodigo_emprestimo());
    					   	if ($result->num_rows != 0) {
    					   	    foreach ($result as $res) {
    					   	        $status = $res['status_emprestimo'];
    					   	    }
    					   	}
    					}
					?>
					<input type="hidden"
						id="codigo_emprestimo" name="codigo_emprestimo" value = <?php echo $_POST["codigo_emprestimo"]; ?>> 
						
					<label for="lbl_data_devolucao"><b>DATA DE DEVOLUÇÃO</b></label> <input type="date" id="data_devolucao"
						name="data_devolucao" required="required">  
					
					<label for="lbl_status"><b>STATUS DO EMPRÉSTIMO</b></label> <input type="text"
						id="status" maxlength="50" name="status" required="required" value = "<?php echo "$status" ?>"
						placeholder="Insira o status aqui"> 
						
					
				<br><br>	<input type="submit" value="Atualizar" >
				</form>

			</div>
		</div>
	</div>


	<nav class="navbar navbar-expand-sm bg-dark navbar-dark"
		style="margin-top: 20px"></nav>

</body>
</html>
