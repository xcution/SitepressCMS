
// salva cria enquete
function criar_enquete(){

// dados de formulario
conteudo = document.getElementById("id_campo_conteudo_enquete").value;

// monta requisicao
$.post(v_pagina_acoes, {conteudo: conteudo, href: 12}, function(retorno){

location.reload();

});

};

