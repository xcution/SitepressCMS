<?php

// idioma do sistema sessao
switch($_COOKIE[IDENTIFICADOR_SESSAO_IDIOMA]){

case $idioma_disponivel[0]:
include_once("idioma_pt_br.php");
break;

case $idioma_disponivel[1]:
include_once("idioma_us_ingles.php");
break;

default:
include_once("idioma_pt_br.php");
break;

};

// idioma do sistema request
switch($_REQUEST[$seletor_idioma_href]){

case $idioma_disponivel[0]:
include_once("idioma_pt_br.php");
break;

case $idioma_disponivel[1]:
include_once("idioma_us_ingles.php");
break;

};

?>