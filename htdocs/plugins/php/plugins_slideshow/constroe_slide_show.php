<?php

// constroe o slideshow
function constroe_slide_show(){

// imagens de servidor
$imagem_servidor[0] = retorne_imagem_servidor(2);
$imagem_servidor[1] = retorne_imagem_servidor(3);

// codigo html
$codigo_html = "
<div class='classe_div_slide_show'>
<div class='classe_div_slide_show_imagem' id='id_div_slide_show_imagem' onclick='pausar_slideshow(1);'></div>
<div class='classe_div_slide_show_comentario'>

<div class='classe_div_slide_show_comentario_div_1' onclick='avanca_slideshow(2), pausar_slideshow(0);'>$imagem_servidor[0]</div>
<div class='classe_div_slide_show_comentario_div_3' onclick='avanca_slideshow(1), pausar_slideshow(0);'>$imagem_servidor[1]</div>
<div class='classe_div_slide_show_comentario_div_2' id='id_div_slide_show_comentario' onclick='pausar_slideshow(1);'></div>

</div>
</div>
";

//retorno
return $codigo_html;

};

?>