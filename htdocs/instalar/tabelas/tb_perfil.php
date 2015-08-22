<?php

// campos de tabela
$query = array();
$campos = null;
$campos .= "id int not null auto_increment primary key, ";
$campos .= "idusuario text, ";
$campos .= "nome text, ";
$campos .= "url_imagem_perfil text, ";
$campos .= "url_imagem_perfil_miniatura text, ";
$campos .= "url_imagem_perfil_root text, ";
$campos .= "url_imagem_perfil_miniatura_root text, ";
$campos .= "endereco text, ";
$campos .= "cidade text, ";
$campos .= "estado text, ";
$campos .= "telefone text, ";
$campos .= "data text";

// nome de tabela
$nome_tabela = TABELA_PERFIL;

// query
$query[] = "create table $nome_tabela($campos);";

// cria a tabela
executador_querys($query);

?>