<?php

// carregar depois que a pagina estiver carregada
function scripts_js_carregar_onload(){

// codigo html
$codigo_html .= "
\n
<script>
\n
carregar_slideshow();
\n
constroe_lista_usuarios_chat();
\n
detecta_resolucao_pagina();
\n
</script>
\n
";

// retorno
return $codigo_html;

};

?>