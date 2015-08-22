<?php

// constroe o menu de navegacao de topo
function constroe_menu_navegacao_topo(){

// titulos
$array_titulo_blocos = retorna_array_links_blocos(true);

// codigo html
$codigo_html = "
<div class='classe_div_menu_navegacao_topo'>
<div class='classe_div_menu_navegacao_topo_centro'>
$array_titulo_blocos[1]
$array_titulo_blocos[2]
$array_titulo_blocos[4]
$array_titulo_blocos[5]
$array_titulo_blocos[6]
$array_titulo_blocos[7]
$array_titulo_blocos[9]
</div>
</div>
";

// retorno
return $codigo_html;

};

?>