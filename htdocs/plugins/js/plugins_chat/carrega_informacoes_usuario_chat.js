
// carrega as informacoes de usuario de chat
function carrega_informacoes_usuario_chat(){

// monta requisicao
$.post(v_pagina_acoes, {dataType : "json", href: 42}, function(retorno){

// objeto
var objeto = jQuery.parseJSON(retorno);

// conteudo
var nome = objeto['nome'];
var online_offline = objeto['online_offline'];

// seta informacoes
document.getElementById("id_span_nome_usuario_conversando").innerHTML = nome;
document.getElementById("id_span_online_offline_usuario_conversando").innerHTML = online_offline;

});

};

