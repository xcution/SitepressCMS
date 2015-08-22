<?php

// retorne a ultima imagem de album
function retorne_ultima_imagem_idalbum($idalbum, $modo){

// tabela
$tabela = TABELA_IMAGENS_ALBUM;

// query
$query = "select *from $tabela where idalbum='$idalbum' order by id desc limit 1;";

// dados
$dados = retorne_dados_query($query);

// retorno
if($modo == true){

// retorno
return $dados['url_imagem'];

}else{

// retorno	
return $dados['url_imagem_miniatura'];

};

};

?>