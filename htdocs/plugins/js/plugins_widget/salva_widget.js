
// salva o widget
function salva_widget(){

// dados de formulario
conteudo = document.getElementById("id_campo_textarea_widget").value;

// monta requisicao
$.post(v_pagina_acoes, {conteudo: conteudo, href: 52}, function(retorno){

});

};

