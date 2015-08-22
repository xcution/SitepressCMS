
// excluir publicacao
function excluir_publicacao(id){

// monta requisicao
$.post(v_pagina_acoes, {idpost: id, href: 23}, function(retorno){

location.reload();

});

};

