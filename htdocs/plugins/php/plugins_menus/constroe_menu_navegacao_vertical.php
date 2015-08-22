<?php

// constroe o menu de navegacao vertical
function constroe_menu_navegacao_vertical($titulo, $conteudo){

// globals
global $idioma;

// codigo html
$codigo_html = "
<div class='classe_div_menus_vertical'>

<div class='classe_div_titulo_menu_vertical'>
$titulo
</div>

<div class='classe_menu_vertical_menus'>
$conteudo
</div>

</div>
";

// retorno
return $codigo_html;

};

?>