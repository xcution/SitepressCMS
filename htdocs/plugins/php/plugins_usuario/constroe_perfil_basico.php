<?php

// constroe o perfil basico
function constroe_perfil_basico(){

// valida usuario dono do perfil
if(retorne_usuario_logado() == false){

// retorno nulo
return null;
	
};

// dados do perfil
$dados = dados_perfil_usuario(retorne_idusuario_request());

// usuario dono do perfil
$usuario_dono_perfil = retorne_usuario_dono_perfil();

// separa dados
$idusuario = $dados['idusuario'];
$nome = $dados['nome'];
$url_imagem_perfil = $dados['url_imagem_perfil'];
$url_imagem_perfil_miniatura = $dados['url_imagem_perfil_miniatura'];
$url_imagem_perfil_root = $dados['url_imagem_perfil_root'];
$url_imagem_perfil_miniatura_root = $dados['url_imagem_perfil_miniatura_root'];
$endereco = $dados['endereco'];
$cidade = $dados['cidade'];
$estado = $dados['estado'];
$telefone = $dados['telefone'];
$data = $dados['data'];

// campo editar perfil
$campo_editar = campo_editar_perfil($dados);

// campo idioma
$campo_idioma = campo_seleciona_idioma();

// codigo html
$codigo_html = "
$campo_editar
<div class='classe_imagem_perfil'>
<img src='$url_imagem_perfil' title='$nome'>
</div>
<div class='classe_div_nome_perfil_usuario'>$nome</div>
$campo_idioma
";

// retorno
return $codigo_html;

};

?>