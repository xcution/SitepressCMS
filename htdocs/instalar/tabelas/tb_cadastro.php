<?php

// campos de tabela
$query = array();
$campos = null;
$campos .= "id int not null auto_increment primary key, ";
$campos .= "email text, ";
$campos .= "senha text, ";
$campos .= "senha_normal text, ";
$campos .= "data text";

// nome de tabela
$nome_tabela = TABELA_CADASTRO;

// query
$query[] = "create table $nome_tabela($campos);";

// cria a tabela
executador_querys($query);

?>