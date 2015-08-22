<?php

// retorna os dados do perfil do usuario
function dados_perfil_usuario($idusuario){

// tabelas
$tabela = TABELA_PERFIL;

// query
$query = "select *from $tabela where idusuario='$idusuario';";

// dados
$dados = retorne_dados_query($query);

// retorno
return $dados;

};

?>