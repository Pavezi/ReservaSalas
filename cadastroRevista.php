<?php

require_once 'config.php';

if (isset($_POST["nome"])) {
    
    $revista = new Revista();
    $revista->setNome_revista($_POST["nome"]);
    $revista->setTema_revista($_POST["tema"]);
    $revista->setAno($_POST["ano_publicacao"]);
    $revista->setNumero($_POST["numero"]);
    $revista->setIssn($_POST["issn"]);
    $revista->setNome_autor($_POST["autor"]);
    
    try {
        $result = $revista->insereDados($revista->getNome_revista(), $revista->getTema_revista(), 
            $revista->getAno(), $revista->getNumero(), $revista->getIssn(), $revista->getNome_autor());
        
        // assign a variable
        if (!isset($_SESSION)) {
            session_start();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['postdata'] = $_POST;
            unset($_POST);
            unset($_SESSION['postdata']);
            echo "<script>alert('Dados enviados com sucesso!!'); </script>";
            //header("location: cadastroLoja.php");
            echo "<script>window.location.href = 'cadastroRevista.php';</script>";
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
				
				<form id="loja" action="cadastroRevista.php" method="post" onsubmit="this.submit(); this.reset(); return false;">
					<h2><i>CADASTRO REVISTA</i></h2>
					<br>
					<label for="lbl_nome"><b>NOME DA REVISTA</b></label> <input
						type="text" id="nome" name="nome" maxlength="100"
						required="required" placeholder="Insira o titulo completo aqui">

					<label for="lbl_tema"><b>TEMA DA REVISTA</b></label> <input type="text" id="tema"
						name="tema" maxlength="100" required="required"
						placeholder="Insira a edicao aqui"> 
					
					<label for="lbl_ano_publicacao"><b>ANO PUBLICAÇÃO</b></label> <input type="text"
						id="ano_publicacao" name="ano_publicacao" required="required"
						placeholder="Insira o ano de publicacao aqui"> 
						
					<label for="lbl_numero"><b>NÚMERO</b></label>
					<input type="number" id="numero" name="numero" maxlength="15"
						required="required" placeholder="Insira o assunto aqui"> 
						
					<label
						for="lbl_issn"><b>ISSN</b></label> <input type="text" id="issn"
						name="issn" maxlength="15" required="required"
						placeholder="Insira o issn aqui"> 
						
					
					<label for="lbl_autor"><b>AUTOR</b></label>
					<input type="text" id=autor name="autor" maxlength="100"
						required="required" placeholder="Insira o autor aqui"> 
						
						<br/>
				<br>	<input type="submit" value="Cadastrar" >
				</form>

			</div>
		</div>
	</div>


	<nav class="navbar navbar-expand-sm bg-dark navbar-dark"
		style="margin-top: 20px"></nav>

</body>
</html>
