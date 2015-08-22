<?php

// envia conversa de chat
function enviar_conversa_chat(){

// tabela
$tabela = TABELA_CHAT_USUARIO;

// conteudo
$conteudo = remove_html($_REQUEST['conteudo']);

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// id de amigo
$idamigo = retorne_usuario_chat();

// data atual
$data = data_atual();

// query
$query[0] = "insert into $tabela values(null, '$idusuario', '$idamigo', '$conteudo', '1', '$data', '$idusuario');";
$query[1] = "insert into $tabela values(null, '$idamigo', '$idusuario', '$conteudo', '0', '$data', '$idusuario');";
$query[2] = "update $tabela set visualizada='1' where idusuario='$idusuario' and idamigo='$idamigo';";

// comando executa
comando_executa($query[0]);
comando_executa($query[1]);
comando_executa($query[2]);

};

?>