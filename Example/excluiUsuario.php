<?php

require_once 'config.php';

$usuario = new Usuario();

$usuario->setCodigo_usuario($_POST["codigo_usuario"]);

$usuario->DeletaDados($usuario->getCodigo_usuario());

echo "<script>alert('Dados excluídos com sucesso!!'); </script>";
//header("location: cadastroLoja.php");
echo "<script>window.location.href = 'pesquisaUsuario.php';</script>";

?>