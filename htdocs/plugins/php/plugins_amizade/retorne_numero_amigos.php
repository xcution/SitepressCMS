<?php

// retorne o numero de amigos
function retorne_numero_amigos($modo, $idusuario){

// tabela de amigos
$tabela_amigos = TABELA_AMIZADE;
$tabela_solicitacao_amigos = TABELA_SOLICITACAO_AMIZADE;

// modo de numero de amigos
switch($modo){

case 1:
$query = "select *from $tabela_amigos where idusuario='$idusuario';";
break;

case 2:
$query = "select *from $tabela_solicitacao_amigos where idusuario='$idusuario' and modo='0';";
break;

case 3:
$query = "select *from $tabela_solicitacao_amigos where idusuario='$idusuario' and modo='1';";
break;

};

// retorno
return retorne_numero_linhas_query($query);

};

?>