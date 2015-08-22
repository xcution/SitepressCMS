
// exclui a conta do usuario
function excluir_conta_usuario(){

// dados de formulario
senha_atual = document.getElementById("campo_senha_excluir_conta").value;

// monta requisicao
$.post(v_pagina_acoes, {senha_atual: senha_atual, href: 48}, function(retorno){

location.reload();

});

};

