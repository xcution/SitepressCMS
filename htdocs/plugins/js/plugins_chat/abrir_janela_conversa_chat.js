
// abre a janela de conversa de chat
function abrir_janela_conversa_chat(){

// monta requisicao
$.post(v_pagina_acoes, {href: 46}, function(retorno){

// oculta a janela de mensagens de chat
if(retorno == true){

// exibe
document.getElementById("id_div_janela_conversa_chat_usuario").style.display = "inline";

}else{

// oculta
document.getElementById("id_div_janela_conversa_chat_usuario").style.display = "none";
	
};

});

};

