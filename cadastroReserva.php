<?php

require_once 'config.php';


    
    $reserva = new Reserva();
    $reserva->setId(1);
    $reserva->setId_sala(1);
    $reserva->setHorario_de_uso('4:20');
    $reserva->setDia_de_uso('2021-06-21');
    $reserva->setResponsavel('cleiton');
    $reserva->setCurso('raul');
    $reserva->setOcupado(true);
    $reserva->setObservacao('muito loco');

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

?>