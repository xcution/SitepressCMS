<?php

// envia e-mail
function enviar_email($email_destino, $assunto_mensagem, $corpo_mensagem){

// nome do sistema
$nome_sistema = NOME_SISTEMA;

// cabecalho
$cabecalho = "From: $nome_sistema"."\r\n"."Reply-To: $nome_sistema"."\r\n";

// enviando email
mail($email_destino, $assunto_mensagem , $corpo_mensagem, $cabecalho); // enviando email

};

?>
