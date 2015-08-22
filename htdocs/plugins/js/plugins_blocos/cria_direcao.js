
// salva cria direcao
function cria_direcao(){

// dados de formulario
conteudo = document.getElementById("id_campo_conteudo_direcao").value;

// monta requisicao
$.post(v_pagina_acoes, {conteudo: conteudo, href: 13}, function(retorno){

location.reload();

});

};

