<?php
function incluirClasses($nomeClasse){ //essa funcao recebe uma variavel que eh o nome da classe chamada
    //var_dump($nomeClasse);
    //echo "<br/>";
    
    if(file_exists($nomeClasse.".php") === true){
        require_once ($nomeClasse.".php"); //vai chamar delrey e vai ver que tem a classe automovel junto, vai fazer o autoload automaticamente de novo e chamar ela tbm
    };
}

spl_autoload_register("incluirClasses");

spl_autoload_register(function ($nomeClasse){
    if(file_exists("classes" . DIRECTORY_SEPARATOR . $nomeClasse.".php") === true){
        require_once ("classes" . DIRECTORY_SEPARATOR . $nomeClasse.".php");
    }});
    
    ?>