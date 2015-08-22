<?php

// campos de tabela
$query = array();
$campos = null;
$campos .= "id int not null auto_increment primary key, ";
$campos .= "url_imagem_perfil text, ";
$campos .= "url_imagem_perfil_root text, ";
$campos .= "nome text, ";
$campos .= "cargo text, ";
$campos .= "hora_entra text, ";
$campos .= "hora_sai text, ";
$campos .= "hora_pausa_inicio text, ";
$campos .= "hora_pausa_fim text, ";
$campos .= "data text";

// nome de tabela
$nome_tabela = TABELA_FUNCIONARIO;

// query
$query[] = "create table $nome_tabela($campos);";

// cria a tabela
executador_querys($query);

?>