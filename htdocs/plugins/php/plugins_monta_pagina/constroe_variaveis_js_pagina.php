<?php

// constroe as variaveis javascript da pagina
function constroe_variaveis_js_pagina(){

// globals
global $requeste;

// url de pagina de acoes
$url_pagina_acoes = PAGINA_ACOES;

// href de pagina
$href_pagina = retorne_href_get();

// id de funcionario
$id_funcionario = retorne_idfuncionario_request();

// limit de chat de usuario
$limit_chat_usuario = LIMIT_MAX_NUM_USUARIOS_CHAT;

// limit de conversas de chat
$limit_chat_conversas = CONFIG_LIMIT_CONVERSAS_CHAT;

// termo de pesquisa
$termo_pesquisa = retorne_termo_pesquisa();

// largura atual do sistema de resolucao
$largura_atual_sistema = TAMANHO_RESOLUCAO_PADRAO;

// codigo html
$codigo_html = "<script>
var v_pagina_acoes = '$url_pagina_acoes';
\n
var v_contador_slideshow = 0;
\n
var v_slideshow_pausado = 0;
\n
var v_contador_avanco_publicacoes = 0;
\n
var v_bkp_miniatura_destaque = '';
\n
var v_href = '$href_pagina';
\n
var v_contador_avanco_bloco = 1;
\n
var v_bkp_conteudo_bloco = '';
\n
var v_id_funcionario = '$id_funcionario';
\n
var contador_avanco_chat = 0;
\n
var array_usuarios_chat = [];
\n
var v_limit_chat_usuario = $limit_chat_usuario;
\n
var v_limit_chat_conversas = $limit_chat_conversas;
\n
var contador_avanco_mensagens_chat = 0;
\n
var contador_avanco_historico_chat = 0;
\n
var $requeste[1] = '$termo_pesquisa';
\n
var v_largura_atual_sistema = $largura_atual_sistema;
\n
\n
\n
\n
\n
\n
\n
\n
\n
\n
\n
\n
\n
\n
\n
\n

</script>";

// retorno
return $codigo_html;

};

?>