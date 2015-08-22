
// carrega as publicacoes em miniatura
function carrega_publicacoes_miniatura(){

// valida campo existe
if($("#id_div_campo_destaque").length == 0){

// retorna falso	
return false;

};

// monta requisicao
$.post(v_pagina_acoes, {pesq: pesq, contador_avanco_conteudo: v_contador_avanco_publicacoes, href: 7}, function(retorno){

// valida retorno
if(retorno != -1 && v_bkp_miniatura_destaque != retorno && retorno.length > 0){

// atualiza contador
v_contador_avanco_publicacoes++;

// atualiza o backup
v_bkp_miniatura_destaque = retorno;

// atualiza o conteudo
$(retorno).appendTo('#id_div_campo_destaque');

};

});

};

