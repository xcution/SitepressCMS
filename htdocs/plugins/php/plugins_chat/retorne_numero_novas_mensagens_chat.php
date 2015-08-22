<?php

// retorna o numero de novas mensagens no chat
function retorne_numero_novas_mensagens_chat($idamigo){

// tabela
$tabela = TABELA_CHAT_USUARIO;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query = "select *from $tabela where idusuario='$idusuario' and idamigo='$idamigo' and visualizada='0';";

// retorno
return retorne_numero_linhas_query($query);

};

?>