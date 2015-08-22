<?php

// exclui elemento de bloco
function excluir_elemento_bloco(){

// globals
global $idioma;

// dados de formulario
$id = remove_html($_REQUEST['id']);
$tipo_elemento = remove_html($_REQUEST['tipo_elemento']);

// tipo de elemento
switch($tipo_elemento){

case $idioma[73]:
$tabela = TABELA_COMUNICADO;
break;

case $idioma[74]:
$tabela = TABELA_TELEFONES_UTEIS;
break;

case $idioma[76]:
$tabela = TABELA_ENQUETE;
$excluir_votos_enquete = true;
break;

case $idioma[79]:
$tabela = TABELA_DIRECAO;
break;
	
};

// query
$query = "delete from $tabela where id='$id';";

// comando executa
comando_executa($query);

// exclui votos de enquete
if($excluir_votos_enquete == true){

// tabela
$tabela = TABELA_VOTO_ENQUETE;

// query
$query = "delete from $tabela where id_enquete='$id';";

// comando executa
comando_executa($query);

};

};

?>