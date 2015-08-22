<?php

// constroe elemento de bloco
function constroe_elemento_bloco($titulo, $conteudo, $imagens){

// global
global $idioma;

// codigo html
$codigo_html = "
<div class='classe_div_bloco_pagina_bloco_div'>

<div class='classe_titulo_bloco'>
$titulo
</div>

<div class='classe_conteudo_bloco'>
$conteudo
</div>

<div class='classe_imagens_bloco'>
$imagens
</div>

</div>
";

// retorno
return $codigo_html;

};

?>