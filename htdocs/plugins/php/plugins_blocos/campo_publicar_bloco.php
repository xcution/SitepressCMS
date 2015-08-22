<?php

// campo publicar em bloco
function campo_publicar_bloco(){

// globals
global $idioma;

// seleciona o tipo de bloco
switch(retorne_href_get()){

case $idioma[34]:

// validou conteudo
$validou_conteudo = true;

// evento
$evento = "salvar_comunicado();";

// imagem
$imagem = retorne_imagem_servidor(7);

// descricao
$descricao = $idioma[82];

// campos
$campos = "
<textarea cols='10' rows='3' placeholder='$descricao' id='id_campo_conteudo_comunicado'></textarea>
";

break;

case $idioma[35]:

// validou conteudo
$validou_conteudo = true;

// evento
$evento = "salvar_telefones_uteis();";

// imagem
$imagem = retorne_imagem_servidor(8);

// descricao
$descricao = $idioma[83];

// campos
$campos = "
<textarea cols='10' rows='3' placeholder='$descricao' id='id_campo_conteudo_telefones'></textarea>
";

break;

case $idioma[37]:

// validou conteudo
$validou_conteudo = true;

// evento
$evento = "criar_enquete();";

// imagem
$imagem = retorne_imagem_servidor(10);

// descricao
$descricao = $idioma[85];

// campos
$campos = "
<textarea cols='10' rows='3' placeholder='$descricao' id='id_campo_conteudo_enquete'></textarea>
";

break;

case $idioma[38]:

// validou conteudo
$validou_conteudo = true;

// evento
$evento = "cadastra_funcionario();";

// imagem
$imagem = retorne_imagem_servidor(11);

// descricao
$descricao = $idioma[86];

// campos
$campos = "
<div class='classe_div_cadastra_funcionario'>

<div>
<span>$idioma[91]</span>
<input type='text' id='campo_nome_cad_funcionario' placeholder='$idioma[91]'>
</div>

<div>
<span>$idioma[92]</span>
<input type='text' id='campo_cargo_cad_funcionario' placeholder='$idioma[92]'>
</div>

<div class='classe_div_cadastra_funcionario_hora'>
<span>$idioma[93]</span>
<input type='text' id='campo_hora_entra_cad_funcionario' placeholder='$idioma[93]'>
</div>

<div class='classe_div_cadastra_funcionario_hora'>
<span>$idioma[94]</span>
<input type='text' id='campo_hora_sai_cad_funcionario' placeholder='$idioma[94]'>
</div>

<div class='classe_div_cadastra_funcionario_hora'>
<span>$idioma[95]</span>
<input type='text' id='campo_hora_pausa_inicio_cad_funcionario' placeholder='$idioma[95]'>
</div>

<div class='classe_div_cadastra_funcionario_hora'>
<span>$idioma[96]</span>
<input type='text' id='campo_hora_pausa_fim_cad_funcionario' placeholder='$idioma[96]'>
</div>

</div>
";

break;

case $idioma[39]:

// validou conteudo
$validou_conteudo = true;

// evento
$evento = null;

// imagem
$imagem = retorne_imagem_servidor(12);

// descricao
$descricao = $idioma[87];

// campos
$campos = constroe_formulario_barra_progresso(PAGINA_ACOES, "id_formulario_upload_imagens_galeria", "fotos[]", 16, true, 1);

break;

case $idioma[40]:

// validou conteudo
$validou_conteudo = true;

// evento
$evento = "cria_direcao();";

// imagem
$imagem = retorne_imagem_servidor(13);

// descricao
$descricao = $idioma[88];

// campos
$campos = "
<textarea cols='10' rows='3' placeholder='$descricao' id='id_campo_conteudo_direcao'></textarea>
";

break;

case $idioma[42]:

// validou conteudo
$validou_conteudo = true;

// evento
$evento = null;

// imagem
$imagem = retorne_imagem_servidor(15);

// descricao
$descricao = $idioma[90];

// campos
$campos = "

";

break;

};

// valida evento existe
if($evento != null){

// botao salvar
$botao_salvar = "

<div class='classe_div_campo_publicar_bloco_salvar'>
<input type='button' value='$idioma[57]' class='botao_padrao' onclick='$evento'>
</div>

";

};

// codigo html
$codigo_html = "
<div class='classe_div_campo_publicar_bloco'>
<input type='hidden' id='' value=''>

<div class='classe_div_campo_publicar_bloco_imagem'>$imagem</div>
<div class='classe_div_campo_publicar_bloco_descricao'>$descricao</div>
<div class='classe_div_campo_publicar_bloco_campos'>$campos</div>

$botao_salvar

</div>
";

// retorno
if($validou_conteudo == true){

// retorna codigo html
return $codigo_html;

};

};

?>