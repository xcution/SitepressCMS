<?php

// atualizacoes javascript que devem iniciar com a pagina
function carregar_atualizacoes_jquery_longo(){

// globals
global $idioma;

// valida usuario logado
if(retorne_usuario_logado() == false){

// retorno nulo
//return null;
	
};

// tempo de timer
$tempo_timer = CONFIG_TIMER_LONGO;

// campo chat de usuario
$campo_chat = "
\n
constroe_lista_usuarios_chat();
\n
usuario_online_offline_chat();
\n
";

// codigo html
$codigo_html .= "
<script>
\n
var variavelTempoAtualizador_longo = setInterval(function(){ AtualizadorTimerLongo() }, $tempo_timer);
\n
function AtualizadorTimerLongo() {
\n
carregar_atualizacoes_jquery_longo();
\n
};
\n
\n
function carregar_atualizacoes_jquery_longo(){
\n

// codigos aqui ::::
$campo_chat

// codigos aqui ::::


// ::::

\n
};
\n
</script>
\n
";

// retorno
return $codigo_html;

};

?>