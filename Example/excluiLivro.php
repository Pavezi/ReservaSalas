<?php

require_once 'config.php';

$livro = new Livro();

$livro->setCodigo_livro($_POST["codigo_livro"]);

$livro->DeletaDados($livro->getCodigo_livro());

echo "<script>alert('Dados excluídos com sucesso!!'); </script>";
//header("location: cadastroLoja.php");
echo "<script>window.location.href = 'pesquisaLivro.php';</script>";

?>