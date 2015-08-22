<?php

// retorna a imagem de perfil de usuario
function retorne_imagem_perfil_usuario($idusuario){

// tabela
$tabela = TABELA_PERFIL;

// query
$query = "select *from $tabela where idusuario='$idusuario';";

// dados
$dados = retorne_dados_query($query);

// url de imagem de perfil
$dados_retorno['url_imagem_perfil'] = $dados['url_imagem_perfil'];
$dados_retorno['url_imagem_perfil_miniatura'] = $dados['url_imagem_perfil_miniatura'];
$dados_retorno['url_imagem_perfil_root'] = $dados['url_imagem_perfil_root'];
$dados_retorno['url_imagem_perfil_miniatura_root'] = $dados['url_imagem_perfil_miniatura_root'];

// retorno
return $dados_retorno;

};

?>