<?php

// campo editar o perfil
function campo_editar_perfil($dados){

// globals
global $idioma;

// valida usuario dono do perfil
if(retorne_usuario_dono_perfil() == false or retorne_usuario_logado() == false){

// retorno nulo
return null;
	
};

// separa dados
$nome = $dados['nome'];
$url_imagem_perfil = $dados['url_imagem_perfil'];
$endereco = $dados['endereco'];
$cidade = $dados['cidade'];
$estado = $dados['estado'];
$telefone = $dados['telefone'];

// campo edita
$campo_edita[0] = campo_edita_perfil_alterar_imagem($dados);
$campo_edita[1] = campo_edita_perfil_informacoes($dados);
$campo_edita[2] = campo_edita_perfil_alterar_senha($dados);
$campo_edita[3] = campo_edita_perfil_excluir_conta($dados);

// codigo html
$codigo_html = "
$campo_edita[0]
$campo_edita[1]
$campo_edita[2]
$campo_edita[3]
";

// adiciona o dialogo
$codigo_html = janela_mensagem_dialogo($idioma[132], $codigo_html, "dialogo_editar_perfil_usuario");

// codigo html
$codigo_html .= "
<div class='classe_div_campo_editar_perfil'>
<a href='#' title='$idioma[132]' onclick='dialogo_editar_perfil_usuario();'>$idioma[132]</a>
</div>
";

// retorno
return $codigo_html;

};

?>