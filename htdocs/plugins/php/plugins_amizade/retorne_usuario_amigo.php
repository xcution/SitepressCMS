<?php

// retorna se o usuario e amigo
function retorne_usuario_amigo($idamigo, $modo){

// verifica o modo de retorno
if($modo == false){

// dados do usuario
$dados_usuario = sessao_completa_usuario();

// retorna se e amigo ou nao de sessao
return $dados_usuario['usuario_amigo'];

};

// valida usuario dono do perfil
if(retorne_usuario_dono_perfil(false) == true){

// amigo
return true;

};

// tabela
$tabela = TABELA_AMIZADE;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query = "select *from $tabela where idusuario='$idusuario' and idamigo='$idamigo';";

// numero de linhas
$numero_linhas = retorne_numero_linhas_query($query);

// retorno
if($numero_linhas == 1){

// amigo
return true;

}else{

// nao amigo
return false;

};

};

?>