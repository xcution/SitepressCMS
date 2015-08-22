<?php

// constroe o campo de bloco de pagina
function constroe_campo_bloco_pagina(){

// globals
global $idioma;
global $pagina_href;

// valida usuario logado
if(retorne_usuario_logado() == false and CONFIG_VALIDA_USUARIO_LOGADO_BLOCO == true and retorne_href_get() != $idioma[81]){

// imagem de servidor
$imagem[0] = retorne_imagem_servidor(18);

// mensagem do sistema
$mensagem = "
$imagem[0]
<br>
<br>
$idioma[107]
";

// retorno
return mensagem_sistema($mensagem);
	
};

// seleciona o tipo de bloco a construir
switch(retorne_href_get()){

case $idioma[73]:
$conteudo_bloco = carregar_conteudo_bloco();
break;

case $idioma[74]:
$conteudo_bloco = carregar_conteudo_bloco();
break;

case $idioma[75]:
$conteudo_bloco = carregar_conteudo_bloco();
break;

case $idioma[76]:
$conteudo_bloco = carregar_conteudo_bloco();
break;

case $idioma[77]:
$conteudo_bloco = carrega_funcionarios();
break;

case $idioma[78]:
$conteudo_bloco = carrega_galeria_imagens();
break;

case $idioma[79]:
$conteudo_bloco = carregar_conteudo_bloco();
break;

case $idioma[81]:
$conteudo_bloco = formulario_contato_usuario();
break;

};

// titulos
$array_titulo_blocos = retorna_array_links_blocos(true);

// blocos
$bloco[1] = constroe_elemento_bloco($array_titulo_blocos[1], $idioma[65], retorne_imagem_servidor(7));
$bloco[2] = constroe_elemento_bloco($array_titulo_blocos[2], $idioma[67], retorne_imagem_servidor(8));
$bloco[4] = constroe_elemento_bloco($array_titulo_blocos[4], $idioma[69], retorne_imagem_servidor(10));
$bloco[5] = constroe_elemento_bloco($array_titulo_blocos[5], $idioma[70], retorne_imagem_servidor(11));
$bloco[6] = constroe_elemento_bloco($array_titulo_blocos[6], $idioma[71], retorne_imagem_servidor(12));
$bloco[7] = constroe_elemento_bloco($array_titulo_blocos[7], $idioma[28], retorne_imagem_servidor(13));
$bloco[9] = constroe_elemento_bloco($array_titulo_blocos[9], $idioma[30], retorne_imagem_servidor(15));

// codigo html
if($conteudo_bloco == null){
	
$codigo_html = "
<div class='classe_div_bloco_pagina' id='id_div_bloco_pagina'>

$bloco[1]
$bloco[2]
$bloco[4]
$bloco[5]
$bloco[6]
$bloco[7]
$bloco[9]

</div>
";

}else{

$codigo_html = "
<div class='classe_div_bloco_pagina' id='id_div_bloco_pagina'>

$conteudo_bloco

</div>
";
	
};

// retorno
return $codigo_html;

};

?>