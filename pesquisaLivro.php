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

				<h2>
					<i>Pesquisa Livro</i>
				</h2>
				<br>
				<form name="form_pesquisa" id="form_pesquisa" method="post" 
					action="pesquisaLivro.php">
					<fieldset>
						<legend>Digite o nome do livro</legend>
						<div class="input-prepend">
							<input type="text" name="nome_livro" id="nome_livro" required="required"
								value="" tabindex="1" placeholder="Pesquisar nome do livro..." />
						</div>
						
						<br/><input type="submit" value="Pesquisar" >
					</fieldset>
				</form><br>
				
				<br> <br>
				
				<?php

require_once 'config.php';

if (isset($_POST["nome_livro"])) {
    
    $livro = new Livro();
    $livro->setTitulo_livro($_POST["nome_livro"]);
    
    try {
        $result = $livro->SelecionaDados($livro->getTitulo_livro());
        
        if ($result->num_rows != 0) {
            
            $msg = "";
            
            // começamos a concatenar nossa tabela
            $msg .= " <div id='customers' class='table-responsive'>";
            $msg .= "<table class='table'>";
            $msg .= "    <thead>";
            $msg .= "        <tr>";
            $msg .= "            <th>AÇÃO</th>";
            $msg .= "            <th>TÍTULO</th>";
            $msg .= "            <th>EDIÇÃO</th>";
            $msg .= "            <th>ANO</th>";
            $msg .= "            <th>ASSUNTO</th>";
            $msg .= "            <th>ISBN</th>";
            $msg .= "        </tr>";
            $msg .= "    </thead>";
            $msg .= "    <tbody>";
            
            foreach ($result as $res) {
                
                $msg .= "                <tr>";
                $msg .= "                    <td class='filterable-cell' style='background-color: #fff; '>
<form action='excluiLivro.php' method='post' style='padding: 0px; background-color: #FFF;'>
<input type='hidden' name='codigo_livro' value=" . $res['codigo_livro'] . " /> <button style='border:0px; background-color: #FFF; cursor: pointer; '> <img src='imagens/excluir.png' style='height: 35px; width: 35px;  padding:3px; '> </button>
</form>
</td>";
                $msg .= "                    <td class='filterable-cell'>" . $res['titulo_livro'] . "</td>";
                $msg .= "                    <td class='filterable-cell'>" . $res['edicao_livro'] . "</td>";
                $msg .= "                    <td class='filterable-cell'>" . $res['ano_publicacao_livro'] . "</td>";
                $msg .= "                    <td class='filterable-cell'>" . $res['assunto'] . "</td>";
                $msg .= "                    <td class='filterable-cell'>" . $res['isbn'] . "</td>";
                
                $msg .= "                </tr>";
            }
            $msg .= "    </tbody>";
            $msg .= "</table>";
            $msg .= "</div>";
            
            echo $msg;
                
            }        
        else {
            $msg = "";
            $msg .= "Nenhum resultado foi encontrado...";
            echo $msg;
        }
        

        
    } catch (ErrorException $e) {
        echo $e->getMessage();
        
    }
}

?>
				
			</div>
		</div>
	</div>

	<br>
	<br>

	<nav class="navbar navbar-expand-sm bg-dark navbar-dark"
		style="margin-top: 20px"></nav>


</body>
</html>
