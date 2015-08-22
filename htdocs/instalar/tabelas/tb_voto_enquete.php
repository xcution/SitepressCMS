<?php

// campos de tabela
$query = array();
$campos = null;
$campos .= "id int not null auto_increment primary key, ";
$campos .= "id_enquete text, ";
$campos .= "idusuario text, ";
$campos .= "resposta_sim text, ";
$campos .= "resposta_nao text, ";
$campos .= "data text";

// nome de tabela
$nome_tabela = TABELA_VOTO_ENQUETE;

// query
$query[] = "create table $nome_tabela($campos);";

// cria a tabela
executador_querys($query);

?>