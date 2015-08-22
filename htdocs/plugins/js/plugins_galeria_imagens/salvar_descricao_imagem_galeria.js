
// salva a descricao de imagem de galeria
function salvar_descricao_imagem_galeria(id){

// dados de formulario
conteudo = document.getElementById("id_campo_conteudo_descricao_imagem_galeria_" + id).value;

// monta requisicao
$.post(v_pagina_acoes, {id: id, conteudo: conteudo, href: 17}, function(retorno){



});

};

