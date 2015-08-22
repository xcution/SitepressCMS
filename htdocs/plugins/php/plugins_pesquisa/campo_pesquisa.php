<?php

// campo de pesquisa
function campo_pesquisa(){

// globals
global $idioma;
global $requeste;

// url de formulario
$url_formulario = PAGINA_INICIAL;

// codigo html
$codigo_html = "
<div class='classe_div_pesquisa'>
<form action='$url_formulario' method='get'>
<input type='text' name='$requeste[1]' placeholder='$idioma[148]' value=''>
</form>
</div>
";

// retorno
return $codigo_html;

};

?>