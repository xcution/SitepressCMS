<?php

// retorna o termo de pesquisa
function retorne_termo_pesquisa(){

// globals
global $requeste;

// retorno
return remove_html($_REQUEST[$requeste[1]]);

};

?>