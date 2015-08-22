<?php

// cadastra novo funcionario
function cadastra_funcionario(){

// tabela
$tabela = TABELA_FUNCIONARIO;

// dados de formulario
$nome = remove_html($_REQUEST['nome']);
$cargo =  remove_html($_REQUEST['cargo']);
$hora_inicio =  remove_html($_REQUEST['hora_inicio']);
$hora_fim =  remove_html($_REQUEST['hora_fim']);
$hora_pausa_inicio =  remove_html($_REQUEST['hora_pausa_inicio']);
$hora_pausa_fim =  remove_html($_REQUEST['hora_pausa_fim']);

// valida campos
if($nome == null or $cargo == null or $hora_inicio == null or $hora_fim == null or $hora_pausa_inicio == null or $hora_pausa_fim == null){

// retorno padrao
return -1;

};

// data atual
$data = data_atual();

// query
$query = "insert into $tabela values(null, '', '', '$nome', '$cargo', '$hora_inicio', '$hora_fim', '$hora_pausa_inicio', '$hora_pausa_fim', '$data');";

// comando executa
comando_executa($query);

};

?>