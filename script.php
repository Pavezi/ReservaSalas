



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

var numero_salas= 9
var cards_gerados = 0
var menu = document.getElementById('menu')
function gerarMenu() {
    do{
        menu.innerHTML = menu.innerHTML+"<div class=\"indent-1\">"+gerarLinhaCards()+"</div>"
    }while(cards_gerados<numero_salas)
}

function gerarLinhaCards() {
    var linha = ""
    for(i=0;i<4;i++){
        <?php
        print_r($result);
            ?>
        linha = linha+"<section class=\"card_sala\"><p class=\"nome_sala\"> Sala 1 </p><p class=\"info_sala\">Sala 1 AMF 1</p> <hr> <input class=\"botao_mais\" type=\"button\" value=\"MAIS\"><input class=\"botao_reservar\" type=\"button\" value=\"RESERVAR\"> </section>"
        cards_gerados+=1
        if(cards_gerados==numero_salas){
            return linha
        }
    }
    return linha
}