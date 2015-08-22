<?php

// retorna o limit
function retorne_limit(){

// dados de formulario
$contador_avanco = remove_html($_REQUEST['contador_avanco_conteudo']);

// valida limit
if($contador_avanco == null){

$contador_avanco = 0;
	
};

// contadores de avanco limit
$contador_inicio = $contador_avanco;
$contador_fim = 1;

// limit
$limit = "limit $contador_inicio, $contador_fim";

// retorno
return $limit;

};

?>