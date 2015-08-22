<?php

// atualiza elemento de bloco
function atualizar_conteudo_elemento_bloco(){

// globals
global $idioma;

// dados de formulario
$id = remove_html($_REQUEST['id']);
$tipo_elemento = remove_html($_REQUEST['tipo_elemento']);
$valor = remove_html($_REQUEST['valor']);
$nome_usuario = remove_html($_REQUEST['nome_usuario']);
$data = remove_html($_REQUEST['data']);

// tipo de elemento
switch($tipo_elemento){

case $idioma[73]:
$tabela = TABELA_COMUNICADO;
$campo_tabela = "conteudo='$valor'";
break;

case $idioma[74]:
$tabela = TABELA_TELEFONES_UTEIS;
$campo_tabela = "conteudo='$valor'";
break;

case $idioma[79]:
$tabela = TABELA_DIRECAO;
$campo_tabela = "conteudo='$valor'";
break;
	
};

// query
$query = "update $tabela set $campo_tabela where id='$id';";

// comando executa
comando_executa($query);

};

?>