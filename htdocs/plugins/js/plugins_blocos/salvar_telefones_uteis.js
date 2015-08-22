
// salva telefones uteis
function salvar_telefones_uteis(){

// dados de formulario
conteudo = document.getElementById("id_campo_conteudo_telefones").value;

// monta requisicao
$.post(v_pagina_acoes, {conteudo: conteudo, href: 10}, function(retorno){

location.reload();

});

};

