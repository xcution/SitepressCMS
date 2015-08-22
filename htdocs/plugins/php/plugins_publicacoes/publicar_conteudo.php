<?php

// publica conteudo
function publicar_conteudo(){

// globals
global $requeste;

// dados de formulario
$titulo = remove_html($_REQUEST['titulo']);
$conteudo = remove_html($_REQUEST['conteudo']);

// idalbum de sessao
session_start();

// limpa id de album
$_SESSION[$requeste[6]] = null;

// valida dados de formulario
if($titulo == null){

// retorno nulo
return null;
	
};

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// tabela
$tabela = TABELA_PUBLICACOES;

// data atual
$data = data_atual();

// id de album
$idalbum = upload_imagens_album();

// query
$query = "insert into $tabela values(null ,'$idusuario', '$titulo', '$conteudo', '$idalbum', '$data');";

// comando executa
comando_executa($query);

};

?>