<?php

// campo editar perfil alterar senha
function campo_edita_perfil_excluir_conta($dados){

// globals
global $idioma;

// separa dados
$nome = $dados['nome'];
$url_imagem_perfil = $dados['url_imagem_perfil'];
$endereco = $dados['endereco'];
$cidade = $dados['cidade'];
$estado = $dados['estado'];
$telefone = $dados['telefone'];

// valida usuario administrador
if(retorne_usuario_administrador() == true){

// codigo html
$codigo_html = "
$idioma[155]
";

// retorno
return mensagem_sistema($codigo_html);
	
};

// codigo html
$codigo_html = "
<input type='password' id='campo_senha_excluir_conta' placeholder='$idioma[151]'>
<br>
<br>
<input type='button' class='botao_padrao' value='$idioma[98]' onclick='excluir_conta_usuario();'>
";

// adiciona o dialogo
$codigo_html = janela_mensagem_dialogo($idioma[154], $codigo_html, "dialogo_editar_perfil_excluir_conta");

// codigo html
$codigo_html .= "
<div class='classe_div_campo_editar_perfil_opcao'>
<a href='#' title='$idioma[154]' onclick='dialogo_editar_perfil_excluir_conta();'>$idioma[154]</a>
</div>
";

// retorno
return $codigo_html;

};

?>