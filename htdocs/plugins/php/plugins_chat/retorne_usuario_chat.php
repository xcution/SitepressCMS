<?php

// retorna usuario de chat
function retorne_usuario_chat(){

// inicia a sessao
session_start();

// seta usuario de chat de sessao
return $_SESSION[CONFIG_MD5_IDUSUARIO_CHAT];

};

?>