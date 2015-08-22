<?php

// constroe imagens de publicacao
function constroe_imagens_publicacao($idalbum){

// globals
global $idioma;

// tabela
$tabela = TABELA_IMAGENS_ALBUM;

// query
$query = "select *from $tabela where idalbum='$idalbum' order by id desc;";

// contador
$contador = 0;

// comando
$comando = comando_executa($query);

// numero de linhas de comando
$numero_linhas = retorne_numero_linhas_comando($comando);

// usuario administrador
$usuario_administrador = retorne_usuario_administrador();

// imagens de servidor
$imagem_servidor[0] = retorne_imagem_servidor(16);

// construindo imagens
for($contador == $contador; $contador <= $numero_linhas; $contador++){

// dados	
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);

// url de imagem
$id = $dados['id'];
$url_imagem = $dados['url_imagem'];
$url_imagem_miniatura = $dados['url_imagem_miniatura'];

// valida url de imagem
if($url_imagem_miniatura != null){

// campo gerenciar imagem
if($usuario_administrador == true){

// campo dialogo excluir
$campo_dialogo_excluir = "
$idioma[114]
<br>
<br>
<input type='button' value='$idioma[101]' class='botao_padrao' onclick='excluir_imagem_publicacao($id);'>
";

// adiciona o dialogo
$campo_dialogo_excluir = janela_mensagem_dialogo($idioma[114], $campo_dialogo_excluir, "dialogo_excluir_imagem_publicacao_$id");

// campo gerenciar imagem
$campo_gerenciar_imagem = "
<div>
<span class='classe_span_opcao_publicacao' onclick='dialogo_excluir_imagem_publicacao($id);'>$imagem_servidor[0]</span>
</div>
";
	
};

// codigo html
$codigo_html .= "
<div class='classe_div_imagem_publicacao' id='div_imagem_publicacao_$id'>
$campo_gerenciar_imagem

<a class='fancybox' rel='group' href='$url_imagem'>
<img src='$url_imagem_miniatura'>
</a>

</div>
$campo_dialogo_excluir
";
	
};

};

// retorno
return $codigo_html;

};

?>