<?php

// carrega o slideshow
function carregar_slideshow(){

// globals
global $idioma;

// tabela
$tabela = TABELA_SLIDESHOW;

// usuario administrador
$usuario_administrador = retorne_usuario_administrador();

// limit
$limit = retorne_limit();

// query
$query = "select *from $tabela order by id desc $limit";

// dados
$dados = retorne_dados_query($query);

// separa dados
$id = $dados['id'];
$url_imagem = $dados['url_imagem'];
$url_imagem_miniatura = $dados['url_imagem_miniatura'];
$comentario = $dados['comentario'];

// imagens de servidor
$imagem_servidor[0] = retorne_imagem_servidor(16);

// campo comentario
if($usuario_administrador == true){

// campo excluir imagem
$campo_excluir_imagem = "
$idioma[115]
<br>
<br>
<input type='button' value='$idioma[101]' class='botao_padrao' onclick='excluir_imagem_slideshow($id);'>
";

// adiciona dialogo
$campo_excluir_imagem = janela_mensagem_dialogo($idioma[114], $campo_excluir_imagem, "dialogo_excluir_imagem_slideshow_$id");

// campo excluir imagem
$campo_excluir_imagem .= "
<div class='classe_div_campo_excluir_imagem_slideshow' onclick='pausar_slideshow(1), dialogo_excluir_imagem_slideshow($id);'>
$imagem_servidor[0]
</div>
";

// campo comentario
$comentario = "

<div class='classe_div_editar_descricao_img_slideshow'>
<input type='text' value='$comentario' placeholder='$idioma[54]' id='id_campo_comentario_imagem_slideshow' onkeyup='atualizar_descricao_imagem_slideshow($id);'>
$campo_excluir_imagem
</div>

";
	
};

// imagem de slide
$imagem_slide = "
<a class='fancybox' rel='group' href='$url_imagem'>
<img src='$url_imagem_miniatura'>
</a>
";

// dados de retorno
if($url_imagem_miniatura != null){
	
$dados_retorno['imagem'] = $imagem_slide;
$dados_retorno['comentario'] = $comentario;

}else{
	
$dados_retorno['imagem'] = -1;
$dados_retorno['comentario'] = -1;
	
};

// retorno
return json_encode($dados_retorno);

};

?>