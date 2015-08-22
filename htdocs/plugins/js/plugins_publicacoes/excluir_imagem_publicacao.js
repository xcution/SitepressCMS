
// exclui imagem de publicacao
function excluir_imagem_publicacao(id){

// monta requisicao
$.post(v_pagina_acoes, {id: id, href: 26}, function(retorno){

// oculta elemento
document.getElementById("div_imagem_publicacao_" + id).style.display = "none";

});

// fecha janela de mensagem de dialogo
fechar_janela_mensagem_dialogo();

};

