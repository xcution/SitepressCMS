<?php

// retorna o limit de conversas chat
function retorne_limit_conversas_chat(){

// dados de formulario
$contador_avanco = remove_html($_REQUEST['contador_avanco_chat']);

// limit
$limit = "limit $contador_avanco, 1";

// retorno
return $limit;

};

?>