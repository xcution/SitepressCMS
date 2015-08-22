<?php

// retorna o limit de chat
function retorne_limit_chat(){

// dados de formulario
$contador_avanco_conteudo = remove_html($_REQUEST['contador_avanco_chat']);

// contadores de avanco limit
$contador_inicio = $contador_avanco_conteudo;
$contador_fim = $contador_avanco_conteudo + LIMIT_MAX_NUM_USUARIOS_CHAT;

// limit
$limit = "limit $contador_inicio, $contador_fim";

// retorno
return $limit;

};

?>