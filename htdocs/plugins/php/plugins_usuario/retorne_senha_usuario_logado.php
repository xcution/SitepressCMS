<?php

// retorna a senha do usuario logado
function retorne_senha_usuario_logado(){

// tabela
$tabela = TABELA_CADASTRO;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query = "select *from $tabela where id='$idusuario';";

// dados
$dados = retorne_dados_query($query);

// retorno
return $dados['senha'];

};

?>