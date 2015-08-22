<?php

// recupera a conta de usuario
function recuperar_conta_usuario(){

// globals
global $idioma;

// dados de formulario
$email = remove_html($_REQUEST['email']);

// valida email
if(verifica_se_email_valido($email) == false or retorne_email_cadastrado($email) == false){

// retorno invalido
return -1;

};

// senha do usuario
$senha_usuario = retorne_senha_usuario_email($email, true);

// conteudo de mensagem
$conteudo_mensagem = "
\n
$idioma[160]$senha_usuario
\n
";

// envia email
enviar_email($email, $idioma[158], $conteudo_mensagem);

// mensagem de sucesso
return $idioma[161].$email;

};

?>