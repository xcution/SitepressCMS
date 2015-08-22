<?php

// carrega os recursos de cabecalho
function carrega_recursos_cabecalho(){

// codigo html
$codigo_html .= fancybox();
$codigo_html .= jcrop();

// retorno
return $codigo_html;

};

?>