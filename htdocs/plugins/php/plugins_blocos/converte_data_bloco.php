<?php

// converte data bloco
function converte_data_bloco($data){

// extrai data
$data = explode("-", $data);
$data = $data[2]."-".$data[1]."-".$data[0];

// retorno
return converte_data_amigavel($data);

};

?>