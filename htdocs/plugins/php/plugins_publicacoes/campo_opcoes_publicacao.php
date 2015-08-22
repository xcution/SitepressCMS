<?php

// campo opcoes de publicacao
function campo_opcoes_publicacao($dados){

// globals
global $idioma;

// valida usuario administrador
if(retorne_usuario_administrador() == false){

// retorno nulo
return null;
	
};

// separa dados
$id = $dados['id'];
$idusuario = $dados['idusuario'];
$titulo = $dados['titulo'];
$conteudo = $dados['conteudo'];
$idalbum = $dados['idalbum'];
$data = $dados['data'];

// campo excluir
$campo_excluir = "
$idioma[111]
<br>
<br>
<input type='button' class='botao_padrao' value='$idioma[101]' onclick='excluir_publicacao($id);'>
";

// adiciona dialogo
$campo_excluir = janela_mensagem_dialogo($idioma[111], $campo_excluir, "id_dialogo_excluir_publicacao_$id");

// imagem de servidor
$imagem_servidor[0] = retorne_imagem_servidor(16);

// codigo html
$codigo_html = "
<div class='classe_div_opcoes_publicacao'>
<div onclick='dialogo_excluir_publicacao($id);'>$imagem_servidor[0]</div>
</div>
$campo_excluir
";

// retorno
return $codigo_html;

};

?>