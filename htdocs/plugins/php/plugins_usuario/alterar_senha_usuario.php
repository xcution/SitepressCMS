<?php

// salva o perfil basico senha
function alterar_senha_usuario(){

// dados de formulario
$senha_atual = remove_html($_REQUEST['senha_atual']);
$nova_senha = remove_html($_REQUEST['nova_senha']);
$nova_senha_confirma = remove_html($_REQUEST['nova_senha_confirma']);
$senha_normal = remove_html($_REQUEST['senha_normal']);

// tabela
$tabela = TABELA_CADASTRO;

// senha atual
$senha_atual_banco = retorne_senha_usuario_logado();

// cifra a senha atual
$senha_atual = cifra_senha_md5($senha_atual);

// valida senha atual com nova senha
if($senha_atual != $senha_atual_banco){

// retorno nulo
return null;
	
};

// valida se as novas senhas são iguais
if($nova_senha != $nova_senha_confirma){

// retorno nulo
return null;
	
};

// valida tamanho de senhas
if(strlen($nova_senha) < TAMANHO_MINIMO_SENHA or strlen($nova_senha_confirma) < TAMANHO_MINIMO_SENHA){

// retorno nulo
return null;
	
};

// cifra a nova senha
$nova_senha = cifra_senha_md5($nova_senha);

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query = "update $tabela set senha='$nova_senha', senha_normal='$senha_normal' where id='$idusuario';";

// comando executa
comando_executa($query);

// faz logout
salvar_cookies(null, null, true);

};

?>