<?php

require_once 'config.php';

$revista = new Revista();

$revista->setCodigo_revista($_POST["codigo_revista"]);

$revista->DeletaDados($revista->getCodigo_revista());

echo "<script>alert('Dados excluídos com sucesso!!'); </script>";
//header("location: cadastroLoja.php");
echo "<script>window.location.href = 'pesquisaRevista.php';</script>";

?>