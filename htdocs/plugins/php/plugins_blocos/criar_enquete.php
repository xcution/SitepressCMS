<?php

// salva cria uma nova enquete
function criar_enquete(){

// dados de formulario
$conteudo = remove_html($_REQUEST['conteudo']);

// tabela
$tabela = TABELA_ENQUETE;

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