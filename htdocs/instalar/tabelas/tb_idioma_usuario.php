<?php

// campos de tabela
$campos = null;
$campos .= "idusuario text, ";
$campos .= "idioma_usuario text";

// nome de tabela
$nome_tabela = TABELA_IDIOMA_USUARIO;

// query
$query = "create table $nome_tabela($campos);";

// cria a tabela
query_executa($query);

?>