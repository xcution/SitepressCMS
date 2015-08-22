<?php

// retorne o id de usuario administrador
function retorne_idusuario_administrador(){

// email
$email = CONFIG_EMAIL_ADMIN;

// tabela
$tabela = TABELA_CADASTRO;

// query
$query = "select *from $tabela where email='$email';";

// dados
$dados = retorne_dados_query($query);

// retorno
return $dados['id'];

};

?>