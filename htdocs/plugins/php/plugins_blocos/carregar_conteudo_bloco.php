<?php

// carrega conteudo de bloco
function carregar_conteudo_bloco(){

// globals
global $idioma;

// href de pagina
$href_pagina = retorne_href_get();

// tabela
switch($href_pagina){

case $idioma[73]:
$tabela = TABELA_COMUNICADO;
$imagem[0] = retorne_imagem_servidor(7);
$exibir_data = false;
break;

case $idioma[74]:
$tabela = TABELA_TELEFONES_UTEIS;
$imagem[0] = retorne_imagem_servidor(8);
$exibir_data = false;
break;

case $idioma[76]:
$tabela = TABELA_ENQUETE;
$imagem[0] = retorne_imagem_servidor(10);
$exibir_data = false;
$votar_enquete = true;
break;

case $idioma[77]:
return carrega_funcionarios();
break;

case $idioma[78]:
return carrega_galeria_imagens();
break;

case $idioma[79]:
$tabela = TABELA_DIRECAO;
$imagem[0] = retorne_imagem_servidor(13);
$exibir_data = false;
break;

};

// limit
$limit = retorne_limit();

// query
$query = "select *from $tabela order by id desc $limit";

// comando
$comando = comando_executa($query);

// numero de linhas
$numero_linhas = retorne_numero_linhas_comando($comando);

// valida numero de linhas
if($numero_linhas == 0){

// retorno
return null;
	
};

// contador
$contador = 0;

// construindo
for($contador == $contador; $contador <= $numero_linhas; $contador++){

// dados
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);

// separa dados
$id = $dados['id'];
$conteudo = $dados['conteudo'];
$nome_usuario = $dados['nome_usuario'];
$data = $dados['data'];

// valida id
if($id != null){

// data amigavel
$data = converte_data_bloco($data);

// campo gerenciar bloco
$campo_gerenciar = campo_gerenciar_elemento_bloco($href_pagina, $dados);

// adiciona quebra de linha
$conteudo = str_replace("\n", "<br>", $conteudo);

// valida exibir data
if($exibir_data == true){

// campo data
$campo_data = "
<div class='classe_div_conteudo_bloco_data'>$data</div>
";

};

// valida votar em enquete
if($votar_enquete == true){
	
// campo votar em enquete	
$campo_votar_enquete = campo_votar_enquete($dados);

};

// codigo html
$codigo_html .= "
<div class='classe_div_conteudo_bloco' title='$data' id='id_div_conteudo_bloco_$id'>
$campo_gerenciar
<div class='classe_div_conteudo_bloco_imagem'>$imagem[0]</div>
<div class='classe_div_conteudo_bloco_conteudo'>$conteudo</div>
$campo_data
$campo_votar_enquete
</div>

";

};

};

// retorno
return $codigo_html;

};

?>