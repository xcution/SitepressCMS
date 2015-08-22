<?php

// faz o upload de imagens para a galeria
function upload_imagens_galeria(){

// dados formulario
$idalbum = retorne_idalbum_post();

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// data atual
$data_atual = data_atual();

// valida idalbum
if($idalbum == null){
	
$idalbum = md5($idusuario.data_atual());

};

// pasta de upload
$pasta_upload_root = retorne_pasta_usuario($idusuario, 4, true);
$pasta_upload_servidor = retorne_pasta_usuario($idusuario, 4, false);

// array com fotos
$fotos = $_FILES['fotos'];

// numero de imagens
$numero_imagens = retorne_numero_array_post_imagens();

// contador
$contador = 0;

// uploading de imagens
for($contador == $contador; $contador <= $numero_imagens; $contador++){

 // nome imagem
$nome_imagem = $fotos['tmp_name'][$contador];
$nome_imagem_real = $fotos['name'][$contador]; 

// upload da imagem e recebe dados
if($nome_imagem != null){

// dados de imagem
$dados_imagem = upload_imagem_unica_album($nome_imagem, $nome_imagem_real, $pasta_upload_root, ESCALA_IMAGEM_ALBUM, ESCALA_IMAGEM_ALBUM_MINIATURA, $pasta_upload_servidor, true);

};

// cadastra a imagem no banco de dados
if($nome_imagem != null){

// url de imagem
$url_imagem = $dados_imagem['normal'];
$url_imagem_miniatura = $dados_imagem['miniatura'];
$url_imagem_root = $dados_imagem['normal_root'];
$url_imagem_miniatura_root = $dados_imagem['miniatura_root'];

// tabela
$tabela = TABELA_GALERIA_IMAGENS;

// query
$query = "insert into $tabela values(null, '$idusuario', '', '$idalbum', '$url_imagem', '$url_imagem_miniatura', '$url_imagem_root', '$url_imagem_miniatura_root', '$data_atual');";

// comando
comando_executa($query);

};

};

// retorno
return $idalbum;

};

?>