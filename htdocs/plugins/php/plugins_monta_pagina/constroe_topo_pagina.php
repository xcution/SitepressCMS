<?php

// constroe o topo da pagina
function constroe_topo_pagina(){

// globals
global $idioma;

// pagina inicial
$pagina_inicial = PAGINA_INICIAL;
$nome_sistema = NOME_SISTEMA;

// logotipo de topo
$logotipo_topo .= "<div class='classe_div_logotipo_topo'>";
$logotipo_topo .= retorne_imagem_servidor(0);
$logotipo_topo .= "</div>";

// codigo html
$codigo_html .= "<div class='div_topo_pagina'>";
$codigo_html .= campo_cadastro_topo();
$codigo_html .= $logotipo_topo;
$codigo_html .= campo_pesquisa();
$codigo_html .= "</div>";

// retorno
return $codigo_html;

};

?>