<?php

// adiciona a quebra de linha
function adiciona_quebra_linha($conteudo){

// converte nova linha em quebra de linha
$conteudo = str_replace("\n", "<br>", $conteudo);

// retorno
return $conteudo;

};

?>