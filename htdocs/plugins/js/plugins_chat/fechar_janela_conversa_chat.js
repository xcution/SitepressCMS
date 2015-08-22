
// fecha a janela de conversa de chat
function fechar_janela_conversa_chat(){

// monta requisicao
$.post(v_pagina_acoes, {href: 45}, function(retorno){

// oculta a janela de mensagens de chat
document.getElementById("id_div_janela_conversa_chat_usuario").style.display = "none";

});

};

