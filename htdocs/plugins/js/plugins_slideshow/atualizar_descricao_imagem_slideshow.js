
// atualiza a descricao de imagem de slideshow
function atualizar_descricao_imagem_slideshow(id){

// comentario
var comentario = document.getElementById("id_campo_comentario_imagem_slideshow").value;

// monta requisicao
$.post(v_pagina_acoes, {id: id, comentario: comentario, href: 6}, function(retorno){

});

};

