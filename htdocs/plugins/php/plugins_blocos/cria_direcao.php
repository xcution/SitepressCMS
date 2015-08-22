<?php

// salva cria direcao
function cria_direcao(){

// dados de formulario
$conteudo = remove_html($_REQUEST['conteudo']);

// tabela
$tabela = TABELA_DIRECAO;

// data
$data = data_atual();

// query
$query = "insert into $tabela values(null, '$conteudo', '$data');";

// valida conteudo
if($conteudo != null){

comando_executa($query);
	
};

};

?>