<?php

// retorna se o email esta cadastrado
function retorne_email_cadastrado($email){

// tabela
$tabela = TABELA_CADASTRO;

// query
$query = "select *from $tabela where email='$email';";

// retorno
if(retorne_numero_linhas_query($query) == 1){

// esta cadastrado
return true;

}else{

// nao esta cadastrado
return false;

};


};

?>