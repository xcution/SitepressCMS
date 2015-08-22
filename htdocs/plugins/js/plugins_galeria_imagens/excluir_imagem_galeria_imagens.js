
// exclui imagem de galeria
function excluir_imagem_galeria_imagens(id){

// monta requisicao
$.post(v_pagina_acoes, {id: id, href: 18}, function(retorno){

// oculta elemento
document.getElementById("id_div_conteudo_galeria_imagens_" + id).style.display = "none";

});

};

