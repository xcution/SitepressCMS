<?php

// atualiza a publicacao
function atualizar_publicacao(){

// dados de formulario
$idpost = retorne_idpost_request();
$titulo = remove_html($_REQUEST['titulo']);
$conteudo = remove_html($_REQUEST['conteudo']);

// tabela
$tabela = TABELA_PUBLICACOES;

// valida id de post e usuario administrador
if($idpost == null or retorne_usuario_administrador() == false){

// retorno nulo
return null;
	
};

// query
$query = "update $tabela set titulo='$titulo', conteudo='$conteudo' where id='$idpost';";

// comando executa
comando_executa($query);

};

?>