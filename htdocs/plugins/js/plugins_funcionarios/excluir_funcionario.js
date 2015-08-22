
// excluir usuario
function excluir_funcionario(id_funcionario){

// monta requisicao
$.post(v_pagina_acoes, {id_funcionario: id_funcionario, href: 22}, function(retorno){

// recarrega a pagina
location.reload();

});

};

