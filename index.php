<?php



?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Sistema de Controle da Biblioteca</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
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

<div class="container-fluid" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12">
    <br>
      <h2>EMPRÉSTIMOS COM VENCIMENTO NA DATA DE HOJE</h2>
      
      <br><br>
      
      <?php

require_once 'config.php';


    
    $emprestimo = new Emprestimo();
    
    try {
        $result = $emprestimo->SelecionaEmprestimosRevistas();
        
        if ($result->num_rows != 0) {
            
            echo "<h2>REVISTAS</h2>";
            
            $msg = "";
            
            // começamos a concatenar nossa tabela
            $msg .= " <div id='customers' class='table-responsive'>";
            $msg .= "<table class='table'>";
            $msg .= "    <thead>";
            $msg .= "        <tr>";
            $msg .= "            <th>NOME</th>";
            $msg .= "            <th>DATA EMPRÉSTIMO</th>";
            $msg .= "            <th>DATA DEVOLUÇÃO</th>";
            $msg .= "            <th>STATUS</th>";
            $msg .= "        </tr>";
            $msg .= "    </thead>";
            $msg .= "    <tbody>";
            
            foreach ($result as $res) {
                $data1 = date('Y-m-d');
                if(strtotime($data1) == strtotime($res['data_devolucao']))
                {
                
                $msg .= "                <tr>";
                $msg .= "                    <td class='filterable-cell'>" . $res['nome_revista'] . "</td>";
                $msg .= "                    <td class='filterable-cell'>" . $res['data_emprestimo'] . "</td>";
                $msg .= "                    <td class='filterable-cell'>" . $res['data_devolucao'] . "</td>";
                $msg .= "                    <td class='filterable-cell'>" . $res['status_emprestimo'] . "</td>";
                
                $msg .= "                </tr>";
                }}
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
    echo "<br>";
    try {
        $result = $emprestimo->SelecionaEmprestimosLivros();
        
        if ($result->num_rows != 0) {
            
            echo "<h2>LIVROS</h2>";
            
            $msg = "";
            
            // começamos a concatenar nossa tabela
            $msg .= " <div id='customers' class='table-responsive'>";
            $msg .= "<table class='table'>";
            $msg .= "    <thead>";
            $msg .= "        <tr>";
            $msg .= "            <th>NOME</th>";
            $msg .= "            <th>DATA EMPRÉSTIMO</th>";
            $msg .= "            <th>DATA DEVOLUÇÃO</th>";
            $msg .= "            <th>STATUS</th>";
            $msg .= "        </tr>";
            $msg .= "    </thead>";
            $msg .= "    <tbody>";
            
            foreach ($result as $res) {
                $data1 = date('Y-m-d');

                if(strtotime($data1) == strtotime($res['data_devolucao']))
                {
                 
                $msg .= "                <tr>";
                $msg .= "                    <td class='filterable-cell'>" . $res['titulo_livro'] . "</td>";
                $msg .= "                    <td class='filterable-cell'>" . $res['data_emprestimo'] . "</td>";
                $msg .= "                    <td class='filterable-cell'>" . $res['data_devolucao'] . "</td>";
                $msg .= "                    <td class='filterable-cell'>" . $res['status_emprestimo'] . "</td>";
                
                $msg .= "                </tr>";}}
            
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


?>
      
     <br><br><br><br>
     <br>
       </div>
  </div>
</div>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
</nav>

</body>
</html>
