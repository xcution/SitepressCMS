
// carrega as conversas de chat
function carrega_conversas_chat(){

// monta requisicao
$.post(v_pagina_acoes, {dataType : "json", contador_avanco_chat: contador_avanco_mensagens_chat, href: 41}, function(retorno){

// objeto
var objeto = jQuery.parseJSON(retorno);

// conteudo
var conteudo = objeto['conteudo'];
var contador = objeto['contador'];

// contador de avanco baseado em numero de mensagens trocadas
if(contador_avanco_mensagens_chat == 0){
	
// atualiza o contador
contador_avanco_mensagens_chat = contador;

};

// valida conteudo
if(parseInt(conteudo) != -1){

// atualiza o contador
contador_avanco_mensagens_chat += v_limit_chat_conversas;

// atualiza o conteudo
$(conteudo).appendTo('#id_div_conversas_usuario_chat');

// move escrol conversas chat
move_scroll_conversas_chat();

};


});

};

