<?php

// retorna o id de usuario via request
function retorne_idpost_request(){

// globals
global $requeste;

// retorno
return remove_html($_REQUEST[$requeste[4]]);

};

?>