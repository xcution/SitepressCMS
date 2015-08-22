
// seta usuario de chat de sessao
function seta_usuario_chat(idusuario){

// monta requisicao
$.post(v_pagina_acoes, {uid: idusuario, href: 40}, function(retorno){

// zera o contador
contador_avanco_mensagens_chat = 0;

// limpa mensagens antigas
document.getElementById("id_div_conversas_usuario_chat").innerHTML = "";
document.getElementById("id_div_mensagens_historico_chat").innerHTML = "";


// limpa enviar mensagem
document.getElementById("id_campo_entrada_conversa_chat").value = "";

// zera contador de avanco de historico de chat
contador_avanco_historico_chat = 0;

// oculta a janela de mensagens de chat
document.getElementById("id_div_janela_conversa_chat_usuario").style.display = "inline";

// move o foco
document.getElementById("id_campo_entrada_conversa_chat").focus();

});

};

