<?php

// campo editar perfil alterar senha
function campo_edita_perfil_alterar_senha($dados){

// globals
global $idioma;

// separa dados
$nome = $dados['nome'];
$url_imagem_perfil = $dados['url_imagem_perfil'];
$endereco = $dados['endereco'];
$cidade = $dados['cidade'];
$estado = $dados['estado'];
$telefone = $dados['telefone'];

// codigo html
$codigo_html = "
<input type='password' id='campo_altera_senha_atual' placeholder='$idioma[151]'>
<input type='password' id='campo_altera_senha_nova' placeholder='$idioma[152]'>
<input type='password' id='campo_altera_senha_confirma' placeholder='$idioma[153]'>
<br>
<br>
<input type='button' class='botao_padrao' value='$idioma[57]' onclick='alterar_senha_usuario();'>
";

// adiciona o dialogo
$codigo_html = janela_mensagem_dialogo($idioma[150], $codigo_html, "dialogo_editar_perfil_usuario_senha");

// codigo html
$codigo_html .= "
<div class='classe_div_campo_editar_perfil_opcao'>
<a href='#' title='$idioma[150]' onclick='dialogo_editar_perfil_usuario_senha();'>$idioma[150]</a>
</div>
";

// retorno
return $codigo_html;

};

?>