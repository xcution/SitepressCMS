<?php

// salva o perfil do usuario
function salvar_perfil_usuario(){

// dados de formulario
$nome_perfil_salvar = remove_html($_REQUEST['nome_perfil_salvar']);
$endereco_perfil_salvar = remove_html($_REQUEST['endereco_perfil_salvar']);
$cidade_perfil_salvar = remove_html($_REQUEST['cidade_perfil_salvar']);
$estado_perfil_salvar = remove_html($_REQUEST['estado_perfil_salvar']);
$telefone_perfil_salvar = remove_html($_REQUEST['telefone_perfil_salvar']);

// tabela
$tabela = TABELA_PERFIL;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// querys
$query[0] = "select *from $tabela where idusuario='$idusuario';";

// data atual
$data = data_atual();

// tipo de query a executar
if(retorne_numero_linhas_query($query[0]) == 0){

$query[1] = "insert into $tabela values(null, '$idusuario', '$nome_perfil_salvar', '', '', '', '', '$endereco_perfil_salvar', '$cidade_perfil_salvar', '$estado_perfil_salvar', '$telefone_perfil_salvar', '$data');";

}else{
	
$query[1] = "update $tabela set nome='$nome_perfil_salvar', endereco='$endereco_perfil_salvar', cidade='$cidade_perfil_salvar', estado='$estado_perfil_salvar', telefone='$telefone_perfil_salvar', data='$data' where idusuario='$idusuario';";
	
};

// comando executa
comando_executa($query[1]);

};

?>