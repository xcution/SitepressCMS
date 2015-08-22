<?php

// constroe o campo de publicacao
function constroe_campo_publicar(){

// globals
global $idioma;
global $requeste;

// url de formulario
$url_formulario = PAGINA_ACOES;

// codigo html
$codigo_html = "
<div class='classe_div_campo_publicar'>
<form action='$url_formulario' method='post' enctype='multipart/form-data'>

<div class='classe_div_campo_publicar_titulo'>
<input type='text' name='titulo' placeholder='$idioma[43]'>
</div>

<div class='classe_div_campo_publicar_conteudo'>
<textarea cols='10' rows='10' placeholder='$idioma[44]' name='conteudo'></textarea>
</div>

<div class='classe_div_publicar_imagens'>
<input type='hidden' name='$requeste[0]' value='3'>
<input type='file' name='fotos[]' id='elemento_file_campo_publicar' class='campo_file_upload' multiple onchange='visualizar_imagens_upload_postagem();'>
<input type='button' class='botao_cadastro' value='$idioma[46]' onclick='seleciona_imagens_publicacao_usuario();'>
<div class='classe_div_imagens_pre_publicacao' id='div_imagens_pre_publicacao'></div>
</div>

<div class='classe_div_campo_publicar_opcoes'>
<input type='submit' value='$idioma[45]' class='botao_padrao'>
</div>

</form>
</div>
";

// retorno
return $codigo_html;

};

?>