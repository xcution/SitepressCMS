<?php

// constroe campo criar slideshow
function constroe_criar_slideshow(){

// globals
global $idioma;

// imagem
$imagem[0] = retorne_imagem_servidor(1);

// formulario de upload
$formulario_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, "id_formulario_upload_imagem_slideshow", "fotos[]", PAGINA_ID4, true, 1);

// codigo html
$codigo_html = "
<div class='classe_div_criar_slideshow'>

<div class='classe_div_criar_slideshow_descreve'>
$imagem[0]
<span>
$idioma[49]
</span>
</div>

$formulario_upload

</div>
";

// retorno
return $codigo_html;

};

?>