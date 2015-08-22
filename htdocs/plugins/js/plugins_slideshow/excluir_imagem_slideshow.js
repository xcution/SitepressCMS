
// exclui imagem de slideshow
function excluir_imagem_slideshow(id){

// monta requisicao
$.post(v_pagina_acoes, {id: id, href: 27}, function(retorno){

location.reload();

});

};

