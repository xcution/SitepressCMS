
// seleciona as imagens da publicacao do usuario
function seleciona_imagens_publicacao_usuario(){

// limpa imagens antigas
document.getElementById("div_imagens_pre_publicacao").innerHTML = "";

// limpa elemento file
document.getElementById("elemento_file_campo_publicar").value = "";

// simula click
document.getElementById("elemento_file_campo_publicar").click();

};
