<?php

// adicionar amizade
function adicionar_amizade(){

// tabela
$tabela = TABELA_AMIZADE;

// idusuario
$idusuario_logado = retorne_idusuario_logado();

// id de usuario administrador
$idusuario_admin = retorne_idusuario_administrador();

// valida usuario logado administrador
if($idusuario_logado == $idusuario_admin or retorne_usuario_logado() == false){

// retorno nulo
return null;
	
};

// data
$data = data_atual();

// query
$query[0] = "select *from $tabela where idusuario='$idusuario_logado' and idamigo='$idusuario_admin';";

// numero de linhas
$numero_linhas = retorne_numero_linhas_query($query[0]);

// valida numero de linhas
if($numero_linhas == 0){

// querys
$query[1] = "insert into $tabela values(null, '$idusuario_logado', '$idusuario_admin', '$data');";
$query[2] = "insert into $tabela values(null, '$idusuario_admin', '$idusuario_logado', '$data');";

// comando executa
comando_executa($query[1]);
comando_executa($query[2]);

};

};

?>