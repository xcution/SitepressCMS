<?php

// retorna o nome do usuario
function retorne_nome_usuario($idusuario){

// tabela
$tabela = TABELA_PERFIL;

// query
$query = "select *from $tabela where idusuario='$idusuario';";

// dados
$dados = retorne_dados_query($query);

// retorno
return $dados['nome'];

};

?>