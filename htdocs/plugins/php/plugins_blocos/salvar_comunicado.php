<?php

// salva o comunicado
function salvar_comunicado(){

// dados de formulario
$conteudo = remove_html($_REQUEST['conteudo']);

// tabela
$tabela = TABELA_COMUNICADO;

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