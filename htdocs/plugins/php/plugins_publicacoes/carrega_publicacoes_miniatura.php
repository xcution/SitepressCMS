<?php

// carrega as publicacoes em miniatura
function carrega_publicacoes_miniatura(){

// tabela
$tabela = TABELA_PUBLICACOES;

// limit
$limit = retorne_limit();

// termo de pesquisa
$termo_pesquisa = retorne_termo_pesquisa();

// query
if($termo_pesquisa != null){

// query
$query = "select *from $tabela where titulo like '%$termo_pesquisa%' or conteudo like '%$termo_pesquisa%' order by id desc $limit";

}else{

// query
$query = "select *from $tabela order by id desc $limit";

};

// comando
$comando = comando_executa($query);

// numero de linhas
$numero_linhas = retorne_numero_linhas_comando($comando);

// contador
$contador = 0;

// construindo
for($contador == $contador; $contador <= $numero_linhas; $contador++){

// dados
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);

// separa dados
$id = $dados['id'];
$idusuario = $dados['idusuario'];
$titulo = $dados['titulo'];
$conteudo = $dados['conteudo'];
$idalbum = $dados['idalbum'];
$data = $dados['data'];

// adiciona quebra de linha
$conteudo = adiciona_quebra_linha($conteudo);

// constroe o link de post
$titulo_link = constroe_link_publicacao_idpost($id, $titulo, $titulo);

// url de imagem de album
$url_imagem_album = retorne_ultima_imagem_idalbum($idalbum, false);

// imagem de post
if($url_imagem_album != null){
	
$imagem_post = "<img src='$url_imagem_album' title='$titulo'>";

}else{
	
$imagem_post = retorne_imagem_servidor(4);
 
};

// constroe o link de imagem de post
$imagem_post = constroe_link_publicacao_idpost($id, $titulo, $imagem_post);

// valida id
if($id != null){

// converte o codigo para o modo html
$conteudo = html_entity_decode($conteudo);

// codigo html
$codigo_html .= "
<div class='classe_publicacao_miniatura'>

<div class='classe_publicacao_miniatura_imagem'>
$imagem_post 
</div>

<div class='classe_publicacao_miniatura_titulo'>
$titulo_link
</div>

<div class='classe_publicacao_miniatura_conteudo'>
$conteudo
</div>

</div>
";	
	
};

};

// retorno
return $codigo_html;

};

?>