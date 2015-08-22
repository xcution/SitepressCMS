<?php

// retorna titulo de postagem
function retorna_titulo_postagem_idpost($idpost){

// tabela
$tabela = TABELA_PUBLICACOES;

// query
$query = "select *from $tabela where id='$idpost';";

// dados
$dados = retorne_dados_query($query);

// retorno
return $dados['titulo'];

};

?>