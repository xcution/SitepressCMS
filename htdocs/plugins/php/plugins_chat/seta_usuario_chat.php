<?php

// seta usuario de chat
function seta_usuario_chat(){

// id de usuario
$idusuario = retorne_idusuario_request();

// verifica se e o proprio usuario
if($idusuario == retorne_idusuario_logado()){

// anula id de usuario
$idusuario = null;
	
};

// inicia a sessao
session_start();

// seta usuario de chat de sessao
$_SESSION[CONFIG_MD5_IDUSUARIO_CHAT] = $idusuario;

};

?>