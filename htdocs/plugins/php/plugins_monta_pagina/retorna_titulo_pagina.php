<?php

// retorna o titulo da pagina
function retorna_titulo_pagina(){

// globals
global $idioma;

// seleciona titulo
switch(retorne_href_get()){

case $idioma[31]:
$titulo_pagina = $idioma[19]." - ".NOME_SISTEMA;
break;

case $idioma[32]:
$titulo_pagina = $idioma[47]." - ".NOME_SISTEMA;
break;

case $idioma[34]:
$titulo_pagina = $idioma[22]." - ".NOME_SISTEMA;
break;

case $idioma[35]:
$titulo_pagina = $idioma[23]." - ".NOME_SISTEMA;
break;

case $idioma[37]:
$titulo_pagina = $idioma[25]." - ".NOME_SISTEMA;
break;

case $idioma[38]:
$titulo_pagina = $idioma[26]." - ".NOME_SISTEMA;
break;

case $idioma[39]:
$titulo_pagina = $idioma[27]." - ".NOME_SISTEMA;
break;

case $idioma[40]:
$titulo_pagina = $idioma[28]." - ".NOME_SISTEMA;
break;

case $idioma[42]:
$titulo_pagina = $idioma[30]." - ".NOME_SISTEMA;
break;

case $idioma[73]:
$titulo_pagina = $idioma[22]." - ".NOME_SISTEMA;
break;

case $idioma[74]:
$titulo_pagina = $idioma[23]." - ".NOME_SISTEMA;
break;

case $idioma[76]:
$titulo_pagina = $idioma[69]." - ".NOME_SISTEMA;
break;

case $idioma[77]:
$titulo_pagina = $idioma[26]." - ".NOME_SISTEMA;
break;

case $idioma[78]:
$titulo_pagina = $idioma[27]." - ".NOME_SISTEMA;
break;

case $idioma[79]:
$titulo_pagina = $idioma[28]." - ".NOME_SISTEMA;
break;

case $idioma[81]:
$titulo_pagina = $idioma[30]." - ".NOME_SISTEMA;
break;

default:
$titulo_pagina = NOME_SISTEMA;

};

// retorna titulo de postagem
if(retorne_idpost_request() != null){

// titulo de pagina
$titulo_pagina = retorna_titulo_postagem_idpost(retorne_idpost_request())." - ".NOME_SISTEMA;;
	
};

// retorno
return $titulo_pagina;

};

?>