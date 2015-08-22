<?php

// retorna o id de funcionario via request
function retorne_idfuncionario_request(){

// globals
global $requeste;

// retorno
return remove_html($_REQUEST[$requeste[5]]);

};

?>