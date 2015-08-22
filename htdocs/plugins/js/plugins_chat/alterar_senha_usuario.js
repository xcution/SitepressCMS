
// altera a senha do usuario
function alterar_senha_usuario(){

// dados de formulario
senha_atual = document.getElementById("campo_altera_senha_atual").value;
nova_senha = document.getElementById("campo_altera_senha_nova").value;
nova_senha_confirma = document.getElementById("campo_altera_senha_confirma").value;

// monta requisicao
$.post(v_pagina_acoes, {nova_senha_confirma: nova_senha_confirma, nova_senha: nova_senha, senha_atual: senha_atual, href: 47}, function(retorno){

location.reload();

});

};

