<?php

// abre a janela de conversa de chat
function abrir_janela_conversa_chat(){

// valida id de usuario
if(retorne_usuario_chat() == null){

// oculta
return false;
	
}else{

// exibe
return true;

};

};

?>