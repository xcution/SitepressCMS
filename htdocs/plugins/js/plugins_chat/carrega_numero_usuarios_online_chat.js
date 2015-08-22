
// carrega numero de usuarios online de chat
function carrega_numero_usuarios_online_chat(){

// monta requisicao
$.post(v_pagina_acoes, {href: 36}, function(retorno){

document.getElementById("id_span_num_usuarios_online_chat").innerHTML = retorno;

});

};

