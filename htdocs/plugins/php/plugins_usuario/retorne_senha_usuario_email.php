<?php

// retorna a senha do usuario por email
function retorne_senha_usuario_email($email, $modo){

// valida se e email valido
if(verifica_se_email_valido($email) == false){

// retorno nulo
return null;
	
};

// valida se o email esta cadastrado
if(retorne_email_cadastrado($email) == false){

// retorno nulo
return null;	
	
};

// tabela
$tabela = TABELA_CADASTRO;

// query
$query = "select *from $tabela where email='$email';";

// dados
$dados = retorne_dados_query($query);

// retorna a senha do usuario
if($modo == false){

// senha cifrada
return $dados['senha'];

}else{

// senha normal
return $dados['senha_normal'];
	
};

};

?>