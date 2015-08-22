
// carrega o historico de chat
function carregar_historico_chat(){

// monta requisicao
$.post(v_pagina_acoes, {contador_avanco_chat: contador_avanco_historico_chat, href: 43}, function(retorno){


// valida retorno
if(retorno != -1){

// atualiza o conteudo
$(retorno).appendTo('#id_div_mensagens_historico_chat');

// atualiza o contador
contador_avanco_historico_chat += v_limit_chat_usuario;

};


});

};

