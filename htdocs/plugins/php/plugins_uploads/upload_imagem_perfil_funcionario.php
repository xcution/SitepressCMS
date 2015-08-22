<?php

// upload de imagem de perfil de funcionario
function upload_imagem_perfil_funcionario(){

// valida se esta postando imagem de perfil
if($_FILES['foto']['tmp_name'] == null){

// retorno nulo
return null;
	
};

// id de usuario
$idusuario = retorne_idusuario_request();

// dados de funcionario
$dados = dados_perfil_funcionario($idusuario);

// id de usuario logado
$idusuario_logado = retorne_idusuario_logado();

// cria pasta se nao existir
$pasta_upload_root = retorne_pasta_usuario($idusuario_logado, 5, true);
$pasta_upload_servidor = retorne_pasta_usuario($idusuario_logado, 5, false);

// upload de imagem
$url_imagem = upload_imagem_unica($pasta_upload_root, TAMANHO_ESCALA_IMG_PERFIL, TAMANHO_ESCALA_IMG_PERFIL_MINIATURA, $pasta_upload_servidor, false);

// urls de imagem
$url_imagem_normal = $url_imagem['normal'];
$url_imagem_normal_root = $url_imagem['normal_root'];

// tabela
$tabela = TABELA_FUNCIONARIO;

// campos a serem atualizados
$campos .= "url_imagem_perfil='$url_imagem_normal', ";
$campos .= "url_imagem_perfil_root='$url_imagem_normal_root'";

// query
$query = "update $tabela set $campos where id='$idusuario';";

// comando executa
comando_executa($query);

// enderecos de arquivos antigos
$arquivo_antigo = $dados['url_imagem_perfil_root'];

// exclui arquivo
exclui_arquivo_unico($arquivo_antigo);

};

?>