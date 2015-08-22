<?php

// formulario de contato de usuario
function formulario_contato_usuario(){

// globals
global $idioma;
global $requeste;

// url do formulario
$url_formulario = PAGINA_ACOES;

// codigo html
$codigo_html = "
<div class='classe_div_formulario_contato'>
<form action='$url_formulario' method='post'>

<span>$idioma[116]</span>

<div>
<input type='text' name='email_telefone_contato' placeholder='$idioma[117]' required>
</div>

<div>
<textarea cols='10' rows='5' name='mensagem_contato' placeholder='$idioma[118]' required></textarea>
</div>

<div>
<input type='submit' value='$idioma[119]' class='botao_padrao' onclick=''>
</div>

<input type='hidden' name='$requeste[0]' value='28'>

</form>
</div>
";

// retorno
return $codigo_html;

};

?>