<?php

// constroe o link da publicacao por id de post
function constroe_link_publicacao_idpost($id, $titulo, $conteudo){

// globals
global $requeste;

// url de pagina inicial
$url_pagina_inicial = PAGINA_INICIAL;

// codigo html
$codigo_html = "<a href='$url_pagina_inicial?$requeste[4]=$id' title='$titulo'>$conteudo</a>";

// retorno
return $codigo_html;

};

?>