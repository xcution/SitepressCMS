<?php

// campo editar imagem de perfil
function campo_edita_perfil_alterar_imagem($dados){

// globals
global $idioma;

// separa dados
$nome = $dados['nome'];
$url_imagem_perfil = $dados['url_imagem_perfil'];
$endereco = $dados['endereco'];
$cidade = $dados['cidade'];
$estado = $dados['estado'];
$telefone = $dados['telefone'];

// campo upload de imagem
$campo_upload_imagem = constroe_formulario_barra_progresso(PAGINA_ACOES, "id_formulario_upload_imagem_perfil", "foto", 33, false, 1);

// atualiza array de dados
$dados['tipo_pagina'] = 34;
$dados['url_pagina'] = PAGINA_ACOES;

// campo de recorte de imagem
$campo_recorte_imagem = campo_recortar_imagem($dados);

// codigo html
$codigo_html = "
$campo_recorte_imagem
$campo_upload_imagem
";

// adiciona o dialogo
$codigo_html = janela_mensagem_dialogo($idioma[132], $codigo_html, "dialogo_editar_perfil_usuario_imagem");

// codigo html
$codigo_html .= "
<div class='classe_div_campo_editar_perfil_opcao'>
<a href='#' title='$idioma[149]' onclick='dialogo_editar_perfil_usuario_imagem();'>$idioma[149]</a>
</div>
";

// retorno
return $codigo_html;

};

?>