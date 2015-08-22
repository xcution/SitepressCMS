
// salva o comunicado
function salvar_comunicado(){

// dados de formulario
conteudo = document.getElementById("id_campo_conteudo_comunicado").value;

// monta requisicao
$.post(v_pagina_acoes, {conteudo: conteudo, href: 9}, function(retorno){

location.reload();

});

};

