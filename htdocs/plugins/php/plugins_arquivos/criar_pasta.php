<?php

// funcao para criar pasta
function criar_pasta($pasta){

// cria pastas e subpastas
if($pasta != null or is_dir($pasta) == false){

// se o arquivo nao existir entao criar a pasta
if(file_exists($pasta) == false){

mkdir($pasta, 0777, true); // criando pasta

};

};

};

?>
