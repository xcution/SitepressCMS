<?php

// fecha a janela de chat
function fechar_janela_conversa_chat(){

// inicia a sessao
session_start();

// seta usuario de chat de sessao
$_SESSION[CONFIG_MD5_IDUSUARIO_CHAT] = null;

};

?>