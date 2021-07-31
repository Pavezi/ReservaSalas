<?php

require_once 'config.php';

if (isset($_POST["id_sala"])) {
    
    $reserva = new Reserva();
    $reserva->setId($_POST["id"]);
    $reserva->setId_sala($_POST["id_sala"]);
    $reserva->setHorario_de_uso($_POST["horario_uso"]);
    $reserva->setDia_de_uso($_POST["dia_uso"]);
    $reserva->setResponsavel($_POST["responsavel"]);
    $reserva->setCurso($_POST["curso"]);
    $reserva->setOcupado($_POST["ocupado"]);
    $reserva->setObservacao($_POST["observacao"]);

    try {
        $result = $reserva->insereDados($reserva->getId(), $reserva->getIdSala(), $reserva->getHorarioDeUso(), $reserva->getDiaDeUso(), $reserva->getResponsavel(), $reserva->getCurso(), $reserva->getOcupado(), $reserva->getObservacao());

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