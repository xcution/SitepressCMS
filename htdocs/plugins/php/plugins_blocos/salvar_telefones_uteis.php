<?php

// salva telefones uteis
function salvar_telefones_uteis(){

// dados de formulario
$conteudo = remove_html($_REQUEST['conteudo']);

// tabela
$tabela = TABELA_TELEFONES_UTEIS;

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