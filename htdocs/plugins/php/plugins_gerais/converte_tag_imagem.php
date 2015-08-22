<?php

// converte tag imagem para imagem visivel
function converte_tag_imagem($conteudo_post){

// conver url em imagem
$conteudo_post = preg_replace('#(http://([^\s]*)\.(jpg|gif|png|jpeg))#', '<a class="fancybox" rel="group" href="$1" target="_blank"><img src="$1" class="imagem_convertida_url" /></a>', $conteudo_post);
$conteudo_post = preg_replace('#(https://([^\s]*)\.(jpg|gif|png|jpeg))#', '<a class="fancybox" rel="group" href="$1" target="_blank"><img src="$1" class="imagem_convertida_url" /></a>', $conteudo_post);

return $conteudo_post;

};

?>