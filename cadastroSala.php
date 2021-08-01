<?php

require_once 'config.php';

if (isset($_POST["id"])) {
    
    $sala = new Sala();
    $sala->setId($_POST["id"]);
    $sala->setNumero($_POST["numero"]);
    $sala->setpredio($_POST["predio"]);
	$sala->setIs_lab($_POST["lab"]);

    try {
        $result = $sala->insereDados($sala->getId(), $sala->getNumero(), $sala->getPredio(), $sala->getIs_lab());

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
            echo "<script>window.location.href = 'cadastroLivro.php';</script>";
            exit;
        }
        
    } catch (ErrorException $e) {
        echo $e->getMessage();
        
    } 
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body onload="gerarMenu()">
  <header><h1>Todas as salas</h1></header>
  <section class="cadastro_salas">
    <p>CADASTRO DE SALAS</p>
	<form action="cadastroSala.php" method="post" onsubmit="this.submit(); this.reset(); return false;">
		Id da sala: <input  type="number" id="id" name="id"><br>
		Número da sala: <input  type="number" id="numero" name="numero"><br>
		Laboraótio: <input  type="number" id="lab" name="lab"><br>
		<p>Prédio:
			<input type="radio" id="predio" name="predio" value="1">AMF 1
			<input type="radio" id="predio" name="predio" value="2">AMF 2   
			<input type="radio" id="predio" name="predio" value="3">AMF 3
			<input class="botao_criar" type="submit" value="CRIAR">
		</p>
	</form>
  </section>
  

  <section id="menu">

  </section>

    <script src="script.php"></script>
  </div>
</body>
</html>

<?php

require_once 'config.php';

$sala = new Sala();
    
    try {
        $result = $sala->SelecionaDadosGerais();
        if ($result->num_rows != 0) {
            
            $msg = "";
            
            // começamos a concatenar nossa tabela
            $msg .= " <div id='customers' class='table-responsive'>";
            $msg .= "<table class='table'>";
            $msg .= "    <thead>";
            $msg .= "        <tr>";
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
                $msg .= "                    <td class='filterable-cell'>" . $res['numero'] . "</td>";
                $msg .= "                    <td class='filterable-cell'>" . $res['predio'] . "</td>";
                $msg .= "                    <td class='filterable-cell'>" . $res['lab'] . "</td>";
                
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
    ?>
