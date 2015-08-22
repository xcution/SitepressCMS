
// detecta a resolucao da pagina
function detecta_resolucao_pagina(){

// largura
var largura = window.innerWidth;

// monta requisicao
$.post(v_pagina_acoes, {largura: largura, href: 50}, function(retorno){

// atualiza a pagina, se a resolucao mudar
if(retorno == 1){

// atualiza a pagina
location.reload();

};

});

};