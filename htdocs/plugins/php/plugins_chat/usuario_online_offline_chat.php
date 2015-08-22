<?php

// usuario online offline
function usuario_online_offline_chat(){

// id de usuario
$idusuario = retorne_idusuario_request();

// usuario online
$usuario_online = retorne_usuario_online($idusuario);

// valida usuario online
if($usuario_online == true){

$imagem_servidor = retorne_imagem_servidor(23);

}else{

$imagem_servidor = retorne_imagem_servidor(22);
	
};

// array de retorno
$array_retorno['conteudo'] = $imagem_servidor;
$array_retorno['idusuario'] = $idusuario;
$array_retorno['numero_mensagens'] = retorne_tamanho_resultado(retorne_numero_novas_mensagens_chat($idusuario));

// retorno
return json_encode($array_retorno);

};

?>