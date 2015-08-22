<?php

// carrega a galeria de imagens
function carrega_galeria_imagens(){

// globals
global $idioma;

// tabela
$tabela = TABELA_GALERIA_IMAGENS;

// limit de query
$limit_query = retorne_limit();

// query
$query = "select *from $tabela order by id desc $limit_query;";

// dados
$dados = retorne_dados_query($query);

// sepra dados
$id = $dados['id'];
$idusuario = $dados['idusuario'];
$conteudo = $dados['conteudo'];
$idalbum = $dados['idalbum'];
$url_imagem = $dados['url_imagem'];
$url_imagem_miniatura = $dados['url_imagem_miniatura'];
$data = $dados['data'];

// valida id
if($id == null){

// retorno
return null;
	
};

// imagem de servidor
$imagem_servidor[0] = retorne_imagem_servidor(16);

// valida usuario administrador
if(retorne_usuario_administrador() == true){

// campo de dialogo de excluir
$dialogo_excluir = "
$idioma[100]
<br>
<br>
<input type='button' value='$idioma[101]' class='botao_padrao' onclick='excluir_imagem_galeria_imagens($id);'>
";

// adiciona dialogo	
$dialogo_excluir = janela_mensagem_dialogo($idioma[98], $dialogo_excluir, "id_dialogo_excluir_imagem_galeria_$id");

// campo gerenciar
$campo_gerenciar = "
<div class='classe_div_excluir_elemento_bloco'>
<div onclick='dialogo_excluir_imagem_galeria($id);'>$imagem_servidor[0]</div>
</div>
$dialogo_excluir
";

// campo conteudo
$conteudo = "
<textarea cols='10' rows='5' id='id_campo_conteudo_descricao_imagem_galeria_$id' placeholder='$idioma[54]' onkeyup='salvar_descricao_imagem_galeria($id);'>$conteudo</textarea>
";

}else{
	
// adiciona quebra de linha
$conteudo = str_replace("\n", "<br>", $conteudo);

};

// codigo html
$codigo_html .= "
<div class='classe_div_conteudo_bloco' title='$data' id='id_div_conteudo_galeria_imagens_$id'>
$campo_gerenciar
<div class='classe_div_conteudo_bloco_imagem_galeria'>
<a class='fancybox' rel='group' href='$url_imagem'>
<img src='$url_imagem_miniatura'>
</a>
</div>
<div class='classe_div_conteudo_bloco_conteudo'>$conteudo</div>
</div>
";

// retorno
return $codigo_html;

};

?>