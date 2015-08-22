<?php

// envia dados do formulario para o contato do admin
function envia_dados_formulario_contato_admin(){

// dados de formulario
$email_telefone_contato = remove_html($_REQUEST['email_telefone_contato']);
$mensagem_contato = remove_html($_REQUEST['mensagem_contato']);

// corpo da mensagem
$corpo_mensagem .= "\n";
$corpo_mensagem .= $email_telefone_contato;
$corpo_mensagem .= "\n";
$corpo_mensagem .= "--------------------";
$corpo_mensagem .= "\n";
$corpo_mensagem .= $mensagem_contato;
$corpo_mensagem .= "\n";

// envia o e-mail
if($email_telefone_contato != null and $mensagem_contato != null){

// envia a mensagem
enviar_email(CONFIG_EMAIL_ADMIN, $email_telefone_contato, $corpo_mensagem);

};

// chama pagina inicial
chama_pagina_inicial();

};

?>