<?php

// retorna se o usuario e o administrador
function retorne_usuario_administrador(){

// email de cookie
$email_cookie = strtolower(retorne_email_cookie());

// email de administrador
$email_admin = strtolower(CONFIG_EMAIL_ADMIN);

// retorno
if($email_cookie == $email_admin){

// administrador
return true;

}else{

// usuario normal
return false;
	
};

};

?>