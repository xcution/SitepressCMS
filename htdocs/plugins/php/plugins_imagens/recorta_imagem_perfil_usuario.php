<?php

// recorta a imagem de perfil de usuario
function recorta_imagem_perfil_usuario(){

// imagem normal
$targ_w[0] = TAMANHO_IMG_PERFIL_RECORTAR_LARGURA;
$targ_h[0] = TAMANHO_IMG_PERFIL_RECORTAR_ALTURA;

// imagem miniatura
$targ_w[1] = TAMANHO_IMG_PERFIL_RECORTAR_LARGURA_MIN;
$targ_h[1] = TAMANHO_IMG_PERFIL_RECORTAR_ALTURA_MIN;

// qualidade
$jpeg_quality = 100;

// criando nova imagem
$src[0] = remove_html($_REQUEST['imagem_perfil']);
$img_r[0] = imagecreatefromjpeg($src[0]);
$dst_r[0] = ImageCreateTrueColor($targ_w[0], $targ_h[0]);
imagecopyresampled($dst_r[0], $img_r[0], 0, 0, $_POST['x'], $_POST['y'], $targ_w[0], $targ_h[0], $_POST['w'], $_POST['h']);

// criando nova imagem
$src[1] = remove_html($_REQUEST['imagem_perfil']);
$img_r[1] = imagecreatefromjpeg($src[1]);
$dst_r[1] = ImageCreateTrueColor($targ_w[1], $targ_h[1]);
imagecopyresampled($dst_r[1], $img_r[1], 0, 0, $_POST['x'], $_POST['y'], $targ_w[1], $targ_h[1], $_POST['w'], $_POST['h']);

// dados da imagem
$dados_imagem = retorne_imagem_perfil_usuario_root();

// dados de retorno
$imagem_perfil = $dados_imagem['imagem_perfil'];
$imagem_perfil_miniatura = $dados_imagem['imagem_perfil_miniatura'];

// grava a nova imagem
imagejpeg($dst_r[0], $imagem_perfil);
imagejpeg($dst_r[1], $imagem_perfil_miniatura);

// chama a pagina inicial
chama_pagina_inicial();

};

?>
