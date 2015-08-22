
// enviar conversa de chat
function enviar_conversa_chat(){

// dados de formulario
conteudo = document.getElementById("id_campo_entrada_conversa_chat").value;

// valida conteudo
if(conteudo.length == 0){

// retorno nulo
return false;
	
};

// monta requisicao
$.post(v_pagina_acoes, {conteudo: conteudo, href: 39}, function(retorno){

// limpa campos
document.getElementById("id_campo_entrada_conversa_chat").value = "";

// move o foco
document.getElementById("id_campo_entrada_conversa_chat").focus();

});

};

