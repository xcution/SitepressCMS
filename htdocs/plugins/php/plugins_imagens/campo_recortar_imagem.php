<?php

// campo recortar imagem
function campo_recortar_imagem($dados){

// globals
global $idioma;
global $requeste;

// separa dados
$id = $dados['id'];
$imagem_grande_url = $dados['url_imagem_perfil'];
$imagem_miniatura_url = $dados['url_imagem_perfil'];
$nome_usuario = $dados['nome'];
$tipo_pagina = $dados['tipo_pagina'];
$url_pagina = $dados['url_pagina'];
$id_funcionario = $dados[$requeste[5]];

// url de pagina
if($url_pagina == null){

// url de pagina padrao
$url_pagina = PAGINA_ACOES;

};

// codigo html
$codigo_html = "
<div class='classe_div_campo_altera_imagem_perfil'>

<div class='classe_div_pre_visualiza_imagem_perfil_recortar' id='id_div_pre_visualiza_imagem_perfil'>
<img src='$imagem_grande_url' title='$nome_usuario' id='cropbox'>
</div>

<div class='classe_div_formulario_recorte_imagem_grande_url'>
<form action='$url_pagina' method='post' enctype='multipart/form-data' onsubmit='return checkCoords();'>
<input type='hidden' id='x' name='x'>
<input type='hidden' id='y' name='y'>
<input type='hidden' id='w' name='w'>
<input type='hidden' id='h' name='h'>
<input type='hidden' value='$id' name='$requeste[2]'>
<input type='hidden' value='$imagem_grande_url' name='imagem_grande_url'>
<input type='hidden' value='$imagem_miniatura_url' name='imagem_miniatura_url'>
<input type='hidden' name='$requeste[0]' value='$tipo_pagina'>
<input type='hidden' value='' name='endereco_imagem_grande_url_upload' id='id_endereco_imagem_grande_url_upload'>
<input type='hidden' value='$id_funcionario' name='$requeste[5]'>
<input type='submit' value='$idioma[108]' class='botao_padrao'>
</form>
</div>

</div>
";

// retorno
return $codigo_html;

};

?>