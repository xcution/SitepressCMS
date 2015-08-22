<?php

// formulario de login
function formulario_login(){

// global
global $idioma;

// redireciona para o perfil
if(retorne_usuario_logado() == true){

// retorno nulo
return null;
	
};

// imagem de servidor
$imagem_servidor[0] = retorne_imagem_servidor(28);

// codigo html
$codigo_html = "
<div class='classe_div_formulario_login'>

<div class='classe_div_formulario_login_exibir_campos' onclick='exibe_campos_login_usuario();'>
$imagem_servidor[0]
<span class='classe_div_formulario_login_span'>$idioma[7]</span>
</div>

<div class='classe_div_formulario_login_campos' id='id_div_formulario_login_campos'>
<div class='classe_mensagem_login_cadastro' id='id_mensagem_login_cadastro'></div>
<div class='classe_div_formulario_login_entrada'>
<input type='text' id='id_email_login' placeholder='$idioma[5]' onkeydown='if(event.keyCode == 13){cadastro_usuario();}'>
<input type='password' id='id_senha_login' placeholder='$idioma[6]' onkeydown='if(event.keyCode == 13){cadastro_usuario();}'>
</div>
<div class='classe_div_formulario_login_botoes'>
<input type='button' value='$idioma[4]' class='botao_padrao' onclick='logar_usuario();'>
<span>
$idioma[8]
</span>
<input type='button' value='$idioma[9]' class='botao_cadastro' onclick='cadastro_usuario();'>
</div>
<div class='classe_div_formulario_login_recupera_conta'>
<div>
<a href='#' title='$idioma[158]'>$idioma[158]</a>
</div>
<div class='classe_div_recuperar_senha'>
<input type='text' id='campo_email_recuperar_conta_usuario' placeholder='$idioma[159]' onkeydown='if(event.keyCode == 13){recuperar_conta_usuario();}'>
</div>
</div>
</div>

</div>
";

// retorno
return $codigo_html;

};

?>