<?php

// retorna o array com links de blocos
function retorna_array_links_blocos($modo){

// globals
global $idioma;
global $pagina_href;

// linkss
if($modo == true){
	
$links[1] = "<a href='$pagina_href[18]' title='$idioma[22]'>$idioma[22]</a>";
$links[2] = "<a href='$pagina_href[19]' title='$idioma[23]'>$idioma[23]</a>";
$links[4] = "<a href='$pagina_href[21]' title='$idioma[69]'>$idioma[69]</a>";
$links[5] = "<a href='$pagina_href[22]' title='$idioma[26]'>$idioma[26]</a>";
$links[6] = "<a href='$pagina_href[23]' title='$idioma[27]'>$idioma[27]</a>";
$links[7] = "<a href='$pagina_href[24]' title='$idioma[28]'>$idioma[28]</a>";
$links[9] = "<a href='$pagina_href[26]' title='$idioma[30]'>$idioma[30]</a>";

}else{

$links[1] = "$pagina_href[18]' title='$idioma[22]";
$links[2] = "$pagina_href[19]' title='$idioma[23]";
$links[4] = "$pagina_href[21]' title='$idioma[69]";
$links[5] = "$pagina_href[22]' title='$idioma[26]";
$links[6] = "$pagina_href[23]' title='$idioma[27]";
$links[7] = "$pagina_href[24]' title='$idioma[28]";
$links[9] = "$pagina_href[26]' title='$idioma[30]";

};

// retorno
return $links;

};

?>