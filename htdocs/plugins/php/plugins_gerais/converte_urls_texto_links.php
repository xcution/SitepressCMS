<?php

// converte urls de textos para links
function converte_urls_texto_links($conteudo_post){

// 1° converte url em links
$conteudo_post = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a href='$1' title='$1' target='_blank'>$1</a>", $conteudo_post); // converte url em links

// 2° converte link para video do youtube
$conteudo_post = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<br><iframe width=\"100%\" height=\"100%\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe><br>",$conteudo_post); // converte link para video do youtube

// converte tag imagem para imagem
$conteudo_post = converte_tag_imagem($conteudo_post); // converte tag imagem para imagem

// retorno
return $conteudo_post; // retorno

};

?>