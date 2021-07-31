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
        linha = linha+"<section class=\"card_sala\"><p class=\"nome_sala\"><img src=\"chalkboard-teacher-solid.svg\" width=\"49\" alt=\"imagem\"> Sala 1 </p><p class=\"info_sala\">Sala 1 AMF 1</p> <hr> <input class=\"botao_mais\" type=\"button\" value=\"MAIS\"><input class=\"botao_reservar\" type=\"button\" value=\"RESERVAR\"> </section>"
        cards_gerados+=1
        if(cards_gerados==numero_salas){
            return linha
        }
    }
    return linha
}

function criarSala(){

}

function verificarCheckBox(){
    
}