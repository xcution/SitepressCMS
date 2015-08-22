
// limpa o historico de chat
function excluir_historico_chat(){

// monta requisicao
$.post(v_pagina_acoes, {href: 44}, function(retorno){

// zera o contador
contador_avanco_mensagens_chat = 0;

// limpa mensagens antigas
document.getElementById("id_div_conversas_usuario_chat").innerHTML = "";
document.getElementById("id_div_mensagens_historico_chat").innerHTML = "";

// move o foco
document.getElementById("id_campo_entrada_conversa_chat").focus();

// limpa enviar mensagem
document.getElementById("id_campo_entrada_conversa_chat").value = "";

// zera contador de avanco de historico de chat
contador_avanco_historico_chat = 0;

// fechando janelas abertas
fechar_janela_mensagem_dialogo();

});

};

