
// usuario online ou offline
function usuario_online_offline_chat(){


// atualiza array de usuarios de chat
for(index = 0; index < array_usuarios_chat.length; index++) {

// id de amigo
var idamigo = parseInt(array_usuarios_chat[index]);

// valida id de amigo
if(idamigo != null){

// monta requisicao
$.post(v_pagina_acoes, {uid: idamigo, href: 38, dataType : "json"}, function(retorno){


// objeto
var objeto = jQuery.parseJSON(retorno);

// conteudo
var conteudo = objeto['conteudo'];
var idusuario = objeto['idusuario'];
var numero_mensagens = objeto['numero_mensagens'];

// exibe online ou offline
document.getElementById("id_div_usuario_online_offline_" + idusuario).innerHTML = conteudo;
document.getElementById("id_numero_novas_mensagens_usuario_" + idusuario).innerHTML = numero_mensagens;

// valida numero de mensagens
if(numero_mensagens > 0){
	
document.getElementById("id_numero_novas_mensagens_usuario_" + idusuario).style.display = "inline";

}else{

document.getElementById("id_numero_novas_mensagens_usuario_" + idusuario).style.display = "none";

};

});

};

};


};

