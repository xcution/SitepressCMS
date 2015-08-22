
// atualiza a publicacao
function atualizar_publicacao(id){

// dados de formulario
titulo = document.getElementById("id_publicacao_titulo_" + id).value;
conteudo = document.getElementById("id_publicacao_conteudo_" + id).value;

// monta requisicao
$.post(v_pagina_acoes, {idpost: id, titulo: titulo, conteudo: conteudo, href: 25}, function(retorno){

// recarrega a pagina
location.reload();

});

};

