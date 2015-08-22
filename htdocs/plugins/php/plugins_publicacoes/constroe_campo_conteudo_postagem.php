<?php

// constroe campo conteudo de postagem
function constroe_campo_conteudo_postagem(){

// globals
global $idioma;
global $requeste;

// id de post
$idpost = retorne_idpost_request();

// tabela
$tabela = TABELA_PUBLICACOES;

// query
$query = "select *from $tabela where id='$idpost';";

// dados de query
$dados = retorne_dados_query($query);

// separa dados
$id = $dados['id'];
$idusuario = $dados['idusuario'];
$titulo = $dados['titulo'];
$conteudo = $dados['conteudo'];
$idalbum = $dados['idalbum'];
$data = $dados['data'];

// valida id
if($id == null){

// retorno nulo
return null;
	
};

// adiciona quebra de linha
$conteudo = adiciona_quebra_linha($conteudo);

// imagens de publicacao
$imagens = constroe_imagens_publicacao($idalbum);

// campo opcoes
$campo_opcoes = campo_opcoes_publicacao($dados);

// usuario administrador
$usuario_administrador = retorne_usuario_administrador();

// valida usuario administrador
if($usuario_administrador == true){

// remove a quebra de linha
$conteudo = str_replace("<br>", "&#13;", $conteudo);

// campo titulo
$campo_titulo = "
<input type='text' value='$titulo' placeholder='$idioma[43]' id='id_publicacao_titulo_$id'>
";

// campo conteudo
$campo_conteudo = "
<textarea cols='10' rows='5' placeholder='$idioma[44]' id='id_publicacao_conteudo_$id'>$conteudo</textarea>
";

// inicia a sessao
session_start();

// seta id de album temporario
$_SESSION[$requeste[6]] = $idalbum;

// campo upload de imagens
$campo_upload_imagens .= $imagens;
$campo_upload_imagens .= constroe_formulario_barra_progresso(PAGINA_ACOES, $id, "fotos[]", 24, true, 1);

// campo salvar
$campo_salvar = "
<div class='classe_div_atualizar_publicacao_salvar'>
<input type='button' value='$idioma[112]' class='botao_padrao' onclick='atualizar_publicacao($id);'>
</div>
";

}else{

// converte o codigo para o modo html
$conteudo = html_entity_decode($conteudo);

// campo titulo
$campo_titulo = $titulo;	

// campo conteudo
$campo_conteudo = $conteudo;

// campo upload de imagens
$campo_upload_imagens = $imagens;

};

// valida usuario administrador logado
if($usuario_administrador == false){

// campo compartilhar
$campo_compartilhar[0] = campo_media_social_compartilhar();

};

// dados do autor
$dados_autor = dados_perfil_usuario($idusuario);

// dados do autor
$nome_autor = $dados_autor['nome'];
$url_imagem_perfil_miniatura = $dados_autor['url_imagem_perfil_miniatura'];
$endereco = $dados_autor['endereco'];
$cidade = $dados_autor['cidade'];
$estado = $dados_autor['estado'];
$telefone = $dados_autor['telefone'];

// campo autor de publicacao
$campo_autor = "
<div class='classe_div_autor_publicacao'>
$idioma[163]$nome_autor
<span>$idioma[133]: $endereco - $cidade - $estado</span>
<span>$idioma[136]: $telefone</span>
</div>
";

// codigo html
$codigo_html = "
<div class='classe_div_campo_postagem'>

$campo_opcoes

<div class='classe_titulo_postagem'>
$campo_titulo
</div>

<div class='classe_conteudo_postagem'>
$campo_conteudo
</div>

<div class='classe_imagens_postagem'>
$campo_upload_imagens
</div>

$campo_autor
$campo_salvar
$campo_compartilhar[0]

</div>
";

// retorno
return $codigo_html;

};

?>