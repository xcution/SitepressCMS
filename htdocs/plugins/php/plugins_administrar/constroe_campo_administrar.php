<?php

// constroe o campo de administrar
function constroe_campo_administrar(){

// globals
global $idioma;
global $pagina_href;

// valida usuario administrador
if(retorne_usuario_administrador() == false){

// retorno nulo
return null;
	
};

// titulo
$titulo = $idioma[18];

// links de administrador
$links[] = "<a href='$pagina_href[3]'>$idioma[19]</a>";
$links[] = "<a href='$pagina_href[4]'>$idioma[47]</a>";
$links[] = "<a href='$pagina_href[6]'>$idioma[22]</a>";
$links[] = "<a href='$pagina_href[7]'>$idioma[23]</a>";
$links[] = "<a href='$pagina_href[9]'>$idioma[25]</a>";
$links[] = "<a href='$pagina_href[10]'>$idioma[26]</a>";
$links[] = "<a href='$pagina_href[11]'>$idioma[27]</a>";
$links[] = "<a href='$pagina_href[12]'>$idioma[28]</a>";
$links[] = "<a href='$pagina_href[14]'>$idioma[30]</a>";

// conteudo
$conteudo = constroe_links_menu_vertical($links);

// codigo html
$codigo_html = constroe_menu_navegacao_vertical($titulo, $conteudo);

// retorno
return $codigo_html;

};

?>