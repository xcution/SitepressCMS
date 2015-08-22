<?php

// campo compartilhar em midia social
function campo_media_social_compartilhar(){

// url atual
$url_atual = URL_SERVIDOR.$_SERVER['REQUEST_URI'];

// codigo html
$campo_twitter = "

<a class='twitter-follow-button'
  href='https://twitter.com/TwitterDev'>
Follow @TwitterDev</a>

";

// codigo html
$codigo_html = "

<br>
<br>
<div class='fb-share-button'></div>
<br>
<br>
<div class='fb-like'></div>
<br>
$campo_twitter
<br>
<div class='fb-comments' data-href='$url_atual' data-numposts='30'></div>
<br>
<br>

";

// retorno
return $codigo_html;

};

?>