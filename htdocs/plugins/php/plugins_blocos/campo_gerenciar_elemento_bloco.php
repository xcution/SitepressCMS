<?php

// campo gerenciar elemento de bloco
function campo_gerenciar_elemento_bloco($tipo_bloco, $dados){

// globals
global $idioma;

// separa dados
$id = $dados['id'];
$conteudo = $dados['conteudo'];
$nome_usuario = $dados['nome_usuario'];
$data = $dados['data'];

// valida usuario administrador
if(retorne_usuario_administrador() == false or $id == null){

// retorno nulo
return null;
	
};

// imagem de servidor
$imagem_servidor[0] = retorne_imagem_servidor(16);
$imagem_servidor[1] = retorne_imagem_servidor(17);

// campo excluir
$campo_excluir = "
$idioma[100]
<br>
<br>
<input type='button' value='$idioma[101]' class='botao_padrao' onclick='excluir_elemento_bloco($id);'>
";

// adiciona o dialogo
$campo_excluir = janela_mensagem_dialogo($idioma[98], $campo_excluir, "id_dialogo_excluir_elemento_bloco_$id");

// valida tipo de bloco
if($tipo_bloco != $idioma[76]){

// campo editar
$campo_editar = "

<div class='classe_div_editar_conteudo_elemento_bloco'>
<textarea cols='50' rows='5' id='textarea_editar_conteudo_elemento_bloco_$id'>$conteudo</textarea>
</div>

$campos_extras

<div class='classe_div_editar_conteudo_elemento_bloco'>
<input type='button' value='$idioma[102]' class='botao_padrao' onclick='atualizar_conteudo_elemento_bloco($id);'>
</div>

";

// botao editar
$botao_editar = "

<div onclick='dialogo_editar_elemento_bloco($id);'>$imagem_servidor[1]</div>

";

// adiciona dialogo
$campo_editar = janela_mensagem_dialogo($idioma[99], $campo_editar, "id_dialogo_editar_elemento_bloco_$id");

};

// codigo html
$codigo_html = "
<div class='classe_div_excluir_elemento_bloco'>

<div onclick='dialogo_excluir_elemento_bloco($id);'>$imagem_servidor[0]</div>
$botao_editar

</div>
$campo_excluir
$campo_editar
";

// retorno
return $codigo_html;

};

?>