<?php

// constroe o campo widget
function campo_widget(){

// globals
global $idioma;

// tabela
$tabela = TABELA_WIDGET;

// query
$query = "select *from $tabela;";

// dados do widget
$dados = retorne_dados_query($query);

// separa dados
$conteudo = $dados['conteudo'];

// valida usuario administrador
if(retorne_usuario_administrador() == true){

// campo edita
$campo_edita = "<textarea cols='10' rows='5' placeholder='$idioma[162]' id='id_campo_textarea_widget' class='campo_textarea_widget' onkeyup='salva_widget();'>$conteudo</textarea>";

// iguala campos
$conteudo = $campo_edita;

};

// codigo html
$codigo_html = "
<div class='classe_div_widget'>
$conteudo
</div>
";

// retorno
return $codigo_html;

};

?>