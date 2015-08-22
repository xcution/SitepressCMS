
// carrega a lista de usuarios de chat
function constroe_lista_usuarios_chat(){

// monta requisicao
$.post(v_pagina_acoes, {contador_avanco_chat: contador_avanco_chat, dataType : "json", href: 37}, function(retorno){

// objeto
var objeto = jQuery.parseJSON(retorno);

// conteudo
var conteudo = objeto['conteudo'];
var ids_usuarios = objeto['ids_usuarios'];

// atualiza array de usuarios de chat
for(index = 0; index < ids_usuarios.length; index++) {

// id de amigo
var idamigo = parseInt(ids_usuarios[index]);

// atualiza array com ids de amigos disponiveis
if(array_usuarios_chat.indexOf(parseInt(idamigo)) == -1 && idamigo != 0){

// atualiza o array de usuarios
array_usuarios_chat[index] = idamigo;

};

};

// valida conteudo e atualiza informacoes
if(conteudo.length != 0){

// atualiza o contador de avanco
contador_avanco_chat += v_limit_chat_usuario;

};

// atualiza o conteudo
if(document.getElementById("id_div_chat_usuario_amigos_chat").innerHTML != null){
	
$(conteudo).appendTo('#id_div_chat_usuario_amigos_chat');

}else{
	
document.getElementById("id_div_chat_usuario_amigos_chat").innerHTML = conteudo;
	
};

});

};

