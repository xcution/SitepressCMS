<?php

// exclui a senha do usuario
function excluir_conta_usuario(){

// globals
global $array_tabelas_usuarios;

// dados de formulario
$senha_atual = remove_html($_REQUEST['senha_atual']);

// senha atual
$senha_atual_banco = retorne_senha_usuario_logado();

// cifra a senha atual
$senha_atual = cifra_senha_md5($senha_atual);

// valida senha atual com nova senha
if($senha_atual != $senha_atual_banco or retorne_usuario_administrador() == true){

// retorno nulo
return null;
	
};

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// pasta de usuario
$pasta_usuario = retorne_pasta_usuario($idusuario, 0, true);

// listando tabelas e excluindo dados
foreach($array_tabelas_usuarios as $tabela){

// valida tabela de cadastro
if($tabela == TABELA_CADASTRO){

// query
$query[] = "delete from $tabela where id='$idusuario';";

}else{
	
// query
$query[] = "delete from $tabela where idusuario='$idusuario';";
$query[] = "delete from $tabela where idamigo='$idusuario';";

};

// executador de querys
executador_querys($query);
	
};

// exclui a pasta de arquivos
excluir_pastas_subpastas($pasta_usuario);

// faz logout
salvar_cookies(null, null, true);

};

?>