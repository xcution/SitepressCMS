<?php

// retorna os dados do perfil do usuario
function dados_perfil_funcionario($id){

// tabelas
$tabela = TABELA_FUNCIONARIO;

// query
$query = "select *from $tabela where id='$id';";

// dados
$dados = retorne_dados_query($query);

// retorno
return $dados;

};

?>