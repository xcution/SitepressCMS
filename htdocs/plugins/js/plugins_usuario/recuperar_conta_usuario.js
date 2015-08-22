
// recuperar conta de usuario
function recuperar_conta_usuario(){

// dados de formulario
email = document.getElementById("campo_email_recuperar_conta_usuario").value;

// monta requisicao
$.post(v_pagina_acoes, {email: email, href: 51}, function(retorno){

// valida retorno
if(retorno != -1){
	
// mensagem de alerta	
alert(retorno);

};

// atualiza a pagina
location.reload();

});

};

