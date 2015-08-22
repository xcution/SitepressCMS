<?php

// excluir funcionario
function excluir_funcionario(){

// id de funcionario
$id_funcionario = retorne_idfuncionario_request();

// tabela
$tabela = TABELA_FUNCIONARIO;

// valida id de funcionario, e usuario administrador
if($id_funcionario == null or retorne_usuario_administrador() == false){

// retorno nulo
return null;
	
};

// dados de funcionario
$dados = dados_perfil_funcionario($id_funcionario);

// url root de imagem de perfil de funcionario
$url_imagem_perfil_root = $dados['url_imagem_perfil_root'];

// excluindo imagem de perfil
exclui_arquivo_unico($url_imagem_perfil_root);

// query
$query = "delete from $tabela where id='$id_funcionario';";

// comando executa
comando_executa($query);

};

?>