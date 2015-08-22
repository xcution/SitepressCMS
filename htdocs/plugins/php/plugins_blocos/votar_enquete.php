<?php

// votar em enquete
function votar_enquete(){

// dados de formulario
$id = remove_html($_REQUEST['id']);
$voto = remove_html($_REQUEST['voto']);

// valida campos e usuario logado
if($id == null or $voto == null or retorne_usuario_logado() == false){

// retorno nulo
return null;
	
};

// tabela
$tabela = TABELA_VOTO_ENQUETE;

// id de usuario
$idusuario = retorne_idusuario_logado();

// data
$data = data_atual();

// valida voto
if($voto == 1){

// sim
$votar[0] = 1;
$votar[1] = 0;

}else{

// nao
$votar[0] = 0;
$votar[1] = 1;	
	
};

// querys
$query[0] = "delete from $tabela where id_enquete='$id' and idusuario='$idusuario';";
$query[1] = "insert into $tabela values(null, '$id', '$idusuario', '$votar[0]', '$votar[1]', '$data');";

// salva voto
executador_querys($query);

// retorno
return votacao_atual_enquete($id);

};

?>