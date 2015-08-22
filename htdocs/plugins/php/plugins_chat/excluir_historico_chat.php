<?php

// limpa o historico de chat
function excluir_historico_chat(){

// tabela
$tabela = TABELA_CHAT_USUARIO;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// id de amigo
$idamigo = retorne_usuario_chat();

// valida ids de usuarios de conversa
if($idusuario == null or $idamigo == null){

// retorno nulo
return null;
	
};

// query
$query = "delete from $tabela where idusuario='$idusuario' and idamigo='$idamigo';";

// comando
comando_executa($query);

};

?>