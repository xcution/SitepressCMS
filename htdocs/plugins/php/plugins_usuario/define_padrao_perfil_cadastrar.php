<?php

// salva o perfil do usuario
function define_padrao_perfil_cadastrar(){

// globals
global $idioma;

// tabela
$tabela = TABELA_PERFIL;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// querys
$query[0] = "select *from $tabela where idusuario='$idusuario';";

// data atual
$data = data_atual();

// imagens de servidor
$imagem_servidor[0] = retorne_imagem_servidor(20);
$imagem_servidor[1] = retorne_imagem_servidor(21);

// tipo de query a executar
if(retorne_numero_linhas_query($query[0]) == 0){

// query
$query[1] = "insert into $tabela values(null, '$idusuario', '$idioma[138]', '$imagem_servidor[0]', '$imagem_servidor[1]', '', '', '', '', '', '', '$data');";

// comando executa
comando_executa($query[1]);

};

};

?>