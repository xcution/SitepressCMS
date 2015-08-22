<?php

// carrega as informacoes de usuario de chat
function carrega_informacoes_usuario_chat(){

// seta usuario de chat de sessao
$idusuario = retorne_usuario_chat();

// valida idusuario
if($idusuario == null){

// retorno nulo
return null;
	
};

// nome de usuario
$nome_usuario = retorne_nome_usuario($idusuario);

// usuario online
$usuario_online = retorne_usuario_online($idusuario);

// valida usuario online
if($usuario_online == true){

$imagem_servidor[0] = retorne_imagem_servidor(23);

}else{

$imagem_servidor[0] = retorne_imagem_servidor(22);
	
};

// atualiza o array
$array_retorno['nome'] = $nome_usuario;
$array_retorno['online_offline'] = $imagem_servidor[0];

// retorno
return json_encode($array_retorno);

};

?>