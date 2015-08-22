<?php

// retorna a imagem do servidor
function retorne_imagem_servidor($numero){

// globals
global $idioma;
global $pagina_href;
global $requeste;

// nome sistema
$nome_sistema = NOME_SISTEMA;

// titulos
$array_titulo_blocos = retorna_array_links_blocos(false);

// numero da imagem
switch($numero){

case 0:
$url_link = PAGINA_INICIAL;
$titulo = NOME_SISTEMA;
break;

case 1:
$url_link = null;
$titulo = $idioma[48];
break;

case 2:
$url_link = null;
$titulo = $idioma[52];
break;

case 3:
$url_link = null;
$titulo = $idioma[53];
break;

case 4:
$url_link = null;
$titulo = null;
break;

case 5:
$url_link = null;
$titulo = $idioma[55];
break;

case 6:
$url_link = $array_titulo_blocos[0];
$titulo = $idioma[63];
break;

case 7:
$url_link = $array_titulo_blocos[1];
$titulo = $idioma[22];
break;

case 8:
$url_link = $array_titulo_blocos[2];
$titulo = $idioma[23];
break;

case 9:
$url_link = $array_titulo_blocos[3];
$titulo = $idioma[24];
break;

case 10:
$url_link = $array_titulo_blocos[4];
$titulo = $idioma[69];
break;

case 11:
$url_link = $array_titulo_blocos[5];
$titulo = $idioma[26];
break;

case 12:
$url_link = $array_titulo_blocos[6];
$titulo = $idioma[27];
break;

case 13:
$url_link = $array_titulo_blocos[7];
$titulo = $idioma[28];
break;

case 14:
$url_link = $array_titulo_blocos[8];
$titulo = $idioma[29];
break;

case 15:
$url_link = $array_titulo_blocos[9];
$titulo = $idioma[30];
break;

case 16:
$url_link = null;
$titulo = $idioma[98];
break;

case 17:
$url_link = null;
$titulo = $idioma[99];
break;

case 18:
$url_link = null;
$titulo = $idioma[107];
break;

case 19:
$url_link = null;
$titulo = $idioma[113];
break;

case 20:
$url_link = null;
$titulo = null;
$endereco = true;
break;

case 21:
$url_link = null;
$titulo = null;
$endereco = true;
break;

case 22:
$url_link = null;
$titulo = $idioma[141];
break;

case 23:
$url_link = null;
$titulo = $idioma[140];
break;

case 24:
$url_link = null;
$titulo = $idioma[143];
break;

case 25:
$url_link = null;
$titulo = $idioma[147];
break;

case 26:
$url_link = null;
$titulo = $idioma[156];
break;

case 27:
$url_link = null;
$titulo = $idioma[157];
break;

case 28:
$url_link = null;
$titulo = $idioma[4];
break;

};

// valida apenas endereco
if($endereco == true){

// retorno
return PASTA_IMAGENS_SISTEMA."$numero.png";
	
};

// imagem
if($url_link == null){

// imagem
$imagem = "<img src='".PASTA_IMAGENS_SISTEMA."$numero.png"."' title='$titulo' $evento>";

}else{

// imagem
$imagem = "<img src='".PASTA_IMAGENS_SISTEMA."$numero.png"."' title='$titulo' $evento>";

// verifica se ha um evento, se houver nao transforma em link
if($evento == null){
	
$imagem = "<a href='$url_link' title='$titulo'>$imagem</a>";

};

};

// retorno
return $imagem;

};

?>