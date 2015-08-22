<?php

// campos de tabela
$query = array();
$campos = null;
$campos .= "conteudo text, ";
$campos .= "data text";

// nome de tabela
$nome_tabela = TABELA_WIDGET;

// query
$query[] = "create table $nome_tabela($campos);";

// cria a tabela
executador_querys($query);

?>