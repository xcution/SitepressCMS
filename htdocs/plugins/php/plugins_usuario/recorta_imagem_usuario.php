<?php

// recorta a imagem de usuario
function recorta_imagem_usuario(){

// global
global $pagina_href;

// imagem normal
$targ_w[0] = TAMANHO_ESCALA_IMG_PERFIL;
$targ_h[0] = TAMANHO_ESCALA_IMG_PERFIL;

// qualidade
$jpeg_quality = 100;

// criando nova imagem
$src[0] = remove_html($_REQUEST['imagem_grande_url']);
$img_r[0] = imagecreatefromjpeg($src[0]);
$dst_r[0] = ImageCreateTrueColor($targ_w[0], $targ_h[0]);
imagecopyresampled($dst_r[0], $img_r[0], 0, 0, $_POST['x'], $_POST['y'], $targ_w[0], $targ_h[0], $_POST['w'], $_POST['h']);

// dados da imagem
$dados_imagem = dados_perfil_usuario(retorne_idusuario_logado());

// dados de retorno
$imagem_perfil = $dados_imagem['url_imagem_perfil_root'];

// grava a nova imagem
imagejpeg($dst_r[0], $imagem_perfil);

// chama a pagina inicial
chama_pagina_inicial();

};

?>
