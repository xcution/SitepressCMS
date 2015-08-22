
// exibe dialogo historico de conversas
function dialogo_historico_conversa_chat(){

// procedimentos a serem iniciados com o dialogo
procedimentos_inicia_dialogo();

// zera contador de avanco de historico de chat
contador_avanco_historico_chat = 0;

// limpa mensagens antigas
document.getElementById("id_div_mensagens_historico_chat").innerHTML = "";

// exibe div com conteudo
document.getElementById("id_dialogo_historico_conversas").style.display = "inline";

// carrega o historico de chat
carregar_historico_chat();

};

