
// cadastra o funcionario
function cadastra_funcionario(){

// dados de formulario
nome = document.getElementById("campo_nome_cad_funcionario").value;
cargo = document.getElementById("campo_cargo_cad_funcionario").value;
hora_inicio = document.getElementById("campo_hora_entra_cad_funcionario").value;
hora_fim = document.getElementById("campo_hora_sai_cad_funcionario").value;
hora_pausa_inicio = document.getElementById("campo_hora_pausa_inicio_cad_funcionario").value;
hora_pausa_fim = document.getElementById("campo_hora_pausa_fim_cad_funcionario").value;

// monta requisicao
$.post(v_pagina_acoes, {nome: nome, cargo: cargo, hora_inicio: hora_inicio, hora_fim: hora_fim, hora_pausa_inicio: hora_pausa_inicio, hora_pausa_fim: hora_pausa_fim, href: 19}, function(retorno){

// valida retorno
if(retorno != -1){

// recarrega a pagina
location.reload();

};

});

};

