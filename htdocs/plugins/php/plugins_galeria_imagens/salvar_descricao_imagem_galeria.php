<?php

// salva a descricao de imagem de galeria
function salvar_descricao_imagem_galeria(){

// tabela
$tabela = TABELA_GALERIA_IMAGENS;

// dados de formulario
$id = remove_html($_REQUEST['id']);
$conteudo = remove_html($_REQUEST['conteudo']);

// query
$query = "update $tabela set conteudo='$conteudo' where id='$id';";

// comando executa
comando_executa($query);

};

?>