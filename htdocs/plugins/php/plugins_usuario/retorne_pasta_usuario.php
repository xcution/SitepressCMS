<?php

// retorna a pasta do usuario
function retorne_pasta_usuario($idusuario, $tipo_pasta, $modo){

// modo true retorna root
// modo false retorna servidor

// pasta de usuario
$pasta_usuario_root = PASTA_ARQUIVOS_USUARIOS_ROOT.$idusuario."/".md5($idusuario)."/";
$pasta_usuario_servidor = PASTA_ARQUIVOS_USUARIOS_HOST.$idusuario."/".md5($idusuario)."/";

switch($tipo_pasta){

case 1:
$sub_pasta = "perfil_pessoal";
break;

case 2:
$sub_pasta = "album_postagens";
break;

case 3:
$sub_pasta = "slideshow_site";
break;

case 4:
$sub_pasta = "galeria_imagens";
break;

case 5:
$sub_pasta = "perfil_funcionario";
break;

};

// adiciona subpasta
if($tipo_pasta != 0){
	
$pasta_usuario_root .= $sub_pasta."/";
$pasta_usuario_servidor .= $sub_pasta."/";

};

// cria pasta e subpastas
criar_pasta($pasta_usuario_root);

// retorno
if($modo == true){

// root
return $pasta_usuario_root;

}else{

// servidor
return $pasta_usuario_servidor;

};

};

?>