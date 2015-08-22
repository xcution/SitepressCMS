<?php

// exclui imagem de galeria
function excluir_imagem_galeria_imagens(){

// tabela
$tabela = TABELA_GALERIA_IMAGENS;

// dados de formulario
$id = remove_html($_REQUEST['id']);

// query
$query[0] = "select *from $tabela where id='$id';";
$query[1] = "delete from $tabela where id='$id';";

// dados
$dados = retorne_dados_query($query[0]);

// comando executa
comando_executa($query[1]);

// separa dados
$url_imagem_root = $dados['url_imagem_root'];
$url_imagem_miniatura_root = $dados['url_imagem_miniatura_root'];

// exclui imagens
exclui_arquivo_unico($url_imagem_root);
exclui_arquivo_unico($url_imagem_miniatura_root);

};

?>