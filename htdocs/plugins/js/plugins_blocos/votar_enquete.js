
// voto em enquete
function votar_enquete(id, voto){

// monta requisicao
$.post(v_pagina_acoes, {id: id, voto: voto, href: 31}, function(retorno){

// apresenta valores
document.getElementById("id_div_votar_enquete_bloco_" + id).innerHTML = retorno;

});

};

