<?php

// campos de tabela
$query = array();
$campos = null;
$campos .= "id int not null auto_increment primary key, ";
$campos .= "idusuario text, ";
$campos .= "conteudo text, ";
$campos .= "idalbum text, ";
$campos .= "url_imagem text, ";
$campos .= "url_imagem_miniatura text, ";
$campos .= "url_imagem_root text, ";
$campos .= "url_imagem_miniatura_root text, ";
$campos .= "data text";

// nome de tabela
$nome_tabela = TABELA_GALERIA_IMAGENS;

// query
$query[] = "create table $nome_tabela($campos);";

// cria a tabela
executador_querys($query);

?>