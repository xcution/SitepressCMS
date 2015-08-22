<?php

// campo edita informacoes de perfil
function campo_edita_perfil_informacoes($dados){

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
<input type='text' value='$nome' id='id_nome_perfil_salvar' placeholder='$idioma[91]'>
<input type='text' value='$endereco' id='id_endereco_perfil_salvar' placeholder='$idioma[133]'>
<input type='text' value='$cidade' id='id_cidade_perfil_salvar' placeholder='$idioma[134]'>
<input type='text' value='$estado' id='id_estado_perfil_salvar' placeholder='$idioma[135]'>
<input type='text' value='$telefone' id='id_telefone_perfil_salvar' placeholder='$idioma[136]'>
<br>
<br>
<input type='button' value='$idioma[57]' class='botao_padrao' onclick='salvar_perfil_usuario();'>
";

// adiciona o dialogo
$codigo_html = janela_mensagem_dialogo($idioma[132], $codigo_html, "dialogo_editar_perfil_usuario_informacoes");

// codigo html
$codigo_html .= "
<div class='classe_div_campo_editar_perfil_opcao'>
<a href='#' title='$idioma[132]' onclick='dialogo_editar_perfil_usuario_informacoes();'>$idioma[132]</a>
</div>
";

// retorno
return $codigo_html;

};

?>