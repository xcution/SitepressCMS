<?php

// constroe campo destaque
function constroe_campo_destaque(){

// globals
global $idioma;

// codigo html
$codigo_html = "
<div class='classe_div_campo_destaque_titulo'>
<span>
$idioma[106]
</span>
</div>
<div class='classe_div_campo_destaque' id='id_div_campo_destaque'></div>
";

// retorno
return $codigo_html;

};

?>