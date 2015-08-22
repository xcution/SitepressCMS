<?php

// salva o widget
function salva_widget(){

// conteudo
$conteudo = $_REQUEST['conteudo'];

// tabela
$tabela = TABELA_WIDGET;

// data atual
$data_atual = data_atual();

// querys
$query[] = "delete from $tabela;";
$query[] = "insert into $tabela values('$conteudo', '$data_atual');";

// executa querys
executador_querys($query);

};

?>