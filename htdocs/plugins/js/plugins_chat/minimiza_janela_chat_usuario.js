
// minimiza a janela de chat
function minimiza_janela_chat_usuario(){

// seta valores inicials
if(document.getElementById("id_div_chat_usuario_amigos_chat").style.display.length == 0){
	
document.getElementById("id_div_chat_usuario_amigos_chat").style.display = "none";
document.getElementById("id_div_amigos_usuario_chat").style.display = "none";
document.getElementById("id_div_chat_usuario_opcoes").style.bottom = 0;

};

// verifica valores atuais
if(document.getElementById("id_div_chat_usuario_amigos_chat").style.display != "none"){
	
document.getElementById("id_div_chat_usuario_amigos_chat").style.display = "none";
document.getElementById("id_div_amigos_usuario_chat").style.display = "none";
document.getElementById("id_div_chat_usuario_opcoes").style.bottom = 0;

}else{
	
document.getElementById("id_div_chat_usuario_amigos_chat").style.display = "inline";
document.getElementById("id_div_amigos_usuario_chat").style.display = "inline";
document.getElementById("id_div_chat_usuario_opcoes").style.bottom = 460;

};

};
