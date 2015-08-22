<?php

// campo opcao de administrador
function campo_opcao_administrador(){

// globals
global $idioma;

// valida usuario administrador
if(retorne_usuario_administrador() == false){

// retorno nulo
return null;	
	
};

// constroe o conteudo de href
switch(retorne_href_get()){

case $idioma[31]:
$conteudo = constroe_campo_publicar();
break;

case $idioma[32]:
$conteudo = constroe_criar_slideshow();
break;

default:
$conteudo = constroe_campo_publicar();
break;

};

// conteudo de bloco
$conteudo_bloco = campo_publicar_bloco();

// valida conteudo de bloco
if($conteudo_bloco != null){

// iguala conteudo de bloco com conteudo atual
$conteudo = $conteudo_bloco;

};

// codigo html
$codigo_html = "
<div class='classe_campo_opcao_administrador'>
$conteudo
</div>
";

// retorno
return $codigo_html;

};

?>