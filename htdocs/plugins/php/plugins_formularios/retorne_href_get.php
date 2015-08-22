<?php

// retorne o href da pagina
function retorne_href_get(){

// globals
global $requeste;
global $idioma;

// retorno
return remove_html($_REQUEST[$requeste[0]]);

};

?>