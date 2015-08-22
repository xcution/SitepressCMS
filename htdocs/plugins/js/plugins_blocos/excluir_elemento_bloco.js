
// exclui elemento de bloco
function excluir_elemento_bloco(identificador){

// monta requisicao
$.post(v_pagina_acoes, {id: identificador, tipo_elemento: v_href , href: 14}, function(retorno){

document.getElementById("id_div_conteudo_bloco_" + identificador).style.display = "none";

});

};

