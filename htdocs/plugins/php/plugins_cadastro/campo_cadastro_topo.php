<?php

// campo de cadastro
function campo_cadastro_topo(){

// globals
global $idioma;
global $pagina_href;

// valida o usuario logado
if(retorne_usuario_logado() == false){

// codigo html
$codigo_html = formulario_login();

}else{
	
// codigo html
$codigo_html = "
<div class='classe_div_campo_cadastro_topo'>
<a href='$pagina_href[2]' title='$idioma[15]'>$idioma[15]</a>
</div>
";

};

// retorno
return $codigo_html;

};

?>