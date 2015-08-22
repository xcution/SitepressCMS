
// salva o perfil do usuario
function salvar_perfil_usuario(){

// dados de formulario
nome_perfil_salvar = document.getElementById("id_nome_perfil_salvar").value;
endereco_perfil_salvar = document.getElementById("id_endereco_perfil_salvar").value;
cidade_perfil_salvar = document.getElementById("id_cidade_perfil_salvar").value;
estado_perfil_salvar = document.getElementById("id_estado_perfil_salvar").value;
telefone_perfil_salvar = document.getElementById("id_telefone_perfil_salvar").value;

// monta requisicao
$.post(v_pagina_acoes, {nome_perfil_salvar, endereco_perfil_salvar, cidade_perfil_salvar, estado_perfil_salvar, telefone_perfil_salvar, href: 32}, function(retorno){

location.reload();

});

};

