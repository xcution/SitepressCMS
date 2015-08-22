<?php

// exclui imagem de publicacao
function excluir_imagem_publicacao(){

// tabela
$tabela = TABELA_IMAGENS_ALBUM;

// id
$id = remove_html($_REQUEST['id']);

// valida id e usuario administrador
if($id == null or retorne_usuario_administrador() == false){

// retorno nulo
return null;
	
};

// query
$query[0] = "select *from $tabela where id='$id';";
$query[1] = "delete from $tabela where id='$id';";

// dados
$dados = retorne_dados_query($query[0]);

// pasta de usuario
$pasta_usuario = retorne_pasta_usuario($dados['idusuario'], 2, true);

// separa os dados
$url_imagem = $pasta_usuario.basename($dados['url_imagem']);
$url_imagem_miniatura = $pasta_usuario.basename($dados['url_imagem_miniatura']);

// excluindo arquivo
exclui_arquivo_unico($url_imagem);
exclui_arquivo_unico($url_imagem_miniatura);

// comando executa
comando_executa($query[1]);

};

?>