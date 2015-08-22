<?php

// constroe conteudo de rodape
function constroe_conteudo_rodape(){

// globals
global $idioma;

// nome do desenvolvedor
$nome_desenvolvedor = DESENVOLVEDOR_SISTEMA;

// nome do sistema
$nome_sistema = NOME_SISTEMA;

// localizacao
$localizacao = LOCALIZACAO;

$ano_atual = Date("Y");;

// codigo html
$codigo_html = "
<div class='classe_div_conteudo_rodape'>

<div>$idioma[120]$nome_desenvolvedor</div>
<div>$idioma[121]$nome_sistema - $ano_atual</div>
<div>$localizacao</div>

</div>
";

// retorno
return $codigo_html;

};

?>