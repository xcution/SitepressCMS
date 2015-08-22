<?php

// carrega os funcionarios
function carrega_funcionarios(){

// globals
global $idioma;
global $requeste;

// tabela
$tabela = TABELA_FUNCIONARIO;

// id de funcionario
$id_funcionario = retorne_idfuncionario_request();

// limit de query
$limit_query = retorne_limit();

// query
if($id_funcionario == null){
	
$query = "select *from $tabela order by id desc $limit_query;";

}else{
	
$query = "select *from $tabela where id='$id_funcionario';";

};

// dados
$dados = retorne_dados_query($query);

// separa dados
$id = $dados['id'];
$url_imagem_perfil = $dados['url_imagem_perfil'];
$nome = $dados['nome'];
$cargo = $dados['cargo'];
$hora_entra = $dados['hora_entra'];
$hora_sai = $dados['hora_sai'];
$hora_pausa_inicio = $dados['hora_pausa_inicio'];
$hora_pausa_fim = $dados['hora_pausa_fim'];
$data = $dados['data'];

// valida id
if($id == null){

// retorno padrao
return null;

};

// valida usuario administrador
if(retorne_usuario_administrador() == true){

// campo imagem de perfil
$campo_imagem_perfil = constroe_formulario_barra_progresso(PAGINA_ACOES, $id, "foto", PAGINA_ID20, false, 4);

// url de pagina
$url_pagina = PAGINA_INICIAL."?$requeste[0]=$idioma[77]&$requeste[5]=$id";

// imagem de servidor
$imagem_servidor[0] = retorne_imagem_servidor(16);

// campo excluir funcionario
$campo_excluir_funcionario = "
$idioma[110]
<br>
<br>
<input type='button' value='$idioma[101]' class='botao_padrao' onclick='excluir_funcionario($id);'>
";

// campo excluir funcionario
$campo_excluir_funcionario = janela_mensagem_dialogo($idioma[110], $campo_excluir_funcionario, "id_dialogo_excluir_funcionario_$id");

// campo excluir funcionario
$campo_excluir_funcionario .= "
<div class='classe_div_funcionario_excluir'>
<div onclick='dialogo_excluir_funcionario($id);'>$imagem_servidor[0]</div>
</div>
";

// campo recortar imagem
if($id_funcionario == null){

// campo recortar imagem
$campo_recortar = "
<img src='$url_imagem_perfil' title='$nome'>

<div class='classe_div_funcionario_recorte_imagem'>
<a href='$url_pagina' title='$idioma[109]'>$idioma[109]</a>
</div>

";

}else{

// dados de imagem
$dados_imagem['id'] = $dados['id'];
$dados_imagem['url_imagem_perfil'] = $dados['url_imagem_perfil'];
$dados_imagem['url_imagem_perfil'] = $dados['url_imagem_perfil'];
$dados_imagem['nome'] = $dados['nome'];
$dados_imagem['tipo_pagina'] = 21;
$dados_imagem['url_pagina'] = PAGINA_ACOES;
$dados_imagem[$requeste[5]] = $id_funcionario;

// formulario de recorte
$campo_recortar = campo_recortar_imagem($dados_imagem);

// campo recortar imagem
$campo_recortar = "
<div class='classe_div_funcionario_recorte_imagem'>
$campo_recortar
</div>
";

};

}else{

// campo recortar imagem
$campo_recortar = "<img src='$url_imagem_perfil' title='$nome'>";

};

// codigo html
$codigo_html = "
<div class='classe_div_funcionario'>

<div class='classe_div_funcionario_imagem'>
$campo_recortar
<br>
$campo_imagem_perfil
</div>

$campo_excluir_funcionario

<div class='classe_div_funcionario_nome'>
$idioma[91]: $nome
</div>

<div class='classe_div_funcionario_cargo'>
$idioma[92]: $cargo
</div>

<div class='classe_div_funcionario_horarios'>
<span class='classe_div_funcionario_span'>$idioma[93]: $hora_entra</span>
<span class='classe_div_funcionario_span'>$idioma[94]: $hora_sai</span>
<span class='classe_div_funcionario_span'>$idioma[95]: $hora_pausa_inicio</span>
<span class='classe_div_funcionario_span'>$idioma[96]: $hora_pausa_fim</span>
</div>

</div>
";

// retorno
return $codigo_html;

};

?>