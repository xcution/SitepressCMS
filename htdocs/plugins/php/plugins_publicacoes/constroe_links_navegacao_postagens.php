<?php

// constroe os links de navegacao de postagens
function constroe_links_navegacao_postagens(){

// tabela
$tabela = TABELA_PUBLICACOES;

// query
$query = "select *from $tabela order by id desc;";

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

// constroe o link de post
$link_post = constroe_link_publicacao_idpost($id, $titulo, $titulo);

// valida id
if($id != null){

// codigo html
$codigo_html .= "
$link_post
";
	
};

};

// retorno
return $codigo_html;

};

?>