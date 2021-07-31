var numero_salas= 25
var cards_gerados = 0
var menu = document.getElementById('menu')
function gerar_menu() {
    do{
        menu.innerHTML = menu.innerHTML+"<div class=\"indent-1\">"+gerar_linha_cards()+"</div>"
    }while(cards_gerados<numero_salas)
}

function gerar_linha_cards() {
    var linha = ""
    for(i=0;i<4;i++){
        linha = linha+"<section class=\"card_sala\"><p class=\"nome_sala\"> Sala 1 </p><hr><p class=\"info_sala\">Sala 1 AMF 1</p> <input type=\"button\" value=\"Mais detalhes\"><input type=\"button\" value=\"Reservar\"> </section>"
        cards_gerados+=1
        if(cards_gerados==numero_salas){
            return linha
        }
    }
    return linha
}