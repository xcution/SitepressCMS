<?php

// salva a sessao de idioma de usuario
function sessao_idioma_atualizar(){

// globals
global $idioma_disponivel;

// modo de idioma
$modo = remove_html($_REQUEST['modo']);

// tempo de validade do cookie
$tempo_vida = time() + (COOKIES_DIAS_EXISTE * 24 * 3600);

// tipo de idioma
switch($modo){

case 1:
$idioma_selecionado = $idioma_disponivel[0];
break;

case 2:
$idioma_selecionado = $idioma_disponivel[1];
break;

default:
$idioma_selecionado = $idioma_disponivel[0];

};

// salva o cookie de idioma
setcookie(IDENTIFICADOR_SESSAO_IDIOMA, $idioma_selecionado, $tempo_vida, "/");

// valida usuario logado
if(retorne_usuario_logado() == false){

// retorno nulo
return null;
	
};

// tabela
$tabela = TABELA_IDIOMA_USUARIO;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// querys
$query[] = "delete from $tabela where idusuario='$idusuario';";
$query[] = "insert into $tabela values('$idusuario', '$idioma_selecionado');";

// executador de querys
executador_querys($query);

};

?>