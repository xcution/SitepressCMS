
// carrega o conteudo de bloco
function carrega_conteudo_bloco(){

// DEIXE ASSIM! SÓ ASSIM FUNCIONA
// neste caso o conteudo ja foi carregado
if(v_id_funcionario.length != 0){

// retorno nulo
return null;
	
};

// monta requisicao
$.post(v_pagina_acoes, {id_funcionario: v_id_funcionario, contador_avanco_conteudo: v_contador_avanco_bloco, href: v_href }, function(retorno){

// valida retorno
if(retorno != -1 && v_bkp_conteudo_bloco != retorno && retorno.length > 0){
	
// atualiza o conteudo
$(retorno).appendTo('#id_div_bloco_pagina');

// atualiza o contador
v_contador_avanco_bloco++;

// atualiza o backup
v_bkp_conteudo_bloco = retorno;

};

});

};

