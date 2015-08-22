
// atualiza elemento de bloco
function atualizar_conteudo_elemento_bloco(identificador){

// valor de conteudo
valor = document.getElementById("textarea_editar_conteudo_elemento_bloco_" + identificador).value;

// valida campo existe
if($('#nome_usuario_editar_elemento_bloco_' + identificador).length > 0){

// nome de usuario
nome_usuario = document.getElementById("nome_usuario_editar_elemento_bloco_" + identificador).value;

}else{
	
// nome de usuario
nome_usuario = "";
	
};

// valida campo existe
if($('#data_editar_elemento_bloco_' + identificador).length > 0){

// data
data = document.getElementById("data_editar_elemento_bloco_" + identificador).value;
	
}else{

// data
data = "";

};

// monta requisicao
$.post(v_pagina_acoes, {nome_usuario: nome_usuario, data: data, valor: valor, id: identificador, tipo_elemento: v_href , href: 15}, function(retorno){

// atualiza a pagina
location.reload();

});

};

