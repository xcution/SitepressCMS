
// salva a sessao de idioma
function sessao_idioma_atualizar(modo){

// monta requisicao
$.post(v_pagina_acoes, {modo: modo, href: 49}, function(retorno){

location.reload();

});

};

