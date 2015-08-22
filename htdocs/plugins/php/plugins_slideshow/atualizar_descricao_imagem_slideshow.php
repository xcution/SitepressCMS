<?php

// atualiza a descricao de imagem de slideshow
function atualizar_descricao_imagem_slideshow(){

// dados de formulario
$id = remove_html($_REQUEST['id']);
$comentario = remove_html($_REQUEST['comentario']);

// valida id
if($id == null){

// retorno nulo
return null;
	
};

// tabela
$tabela = TABELA_SLIDESHOW;

// query
$query = "update $tabela set comentario='$comentario' where id='$id';";

// comando executa
comando_executa($query);

};

?>