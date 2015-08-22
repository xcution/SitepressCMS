<?php

// constroe o chat de usuario
function constroe_chat_usuario(){

// globals
global $idioma;

// valida usuario logado
if(retorne_usuario_logado() == false){

// retorno nulo
return null;
	
};

// numero de amigos online
$numero_amigos_online = retorne_numero_amigos_online();

// imagem de servidor
$imagem_servidor[0] = retorne_imagem_servidor(24);
$imagem_servidor[1] = retorne_imagem_servidor(16);
$imagem_servidor[2] = retorne_imagem_servidor(25);

// campo historico
$campo_historico = "
<span class='classe_div_conversa_chat_opcoes_historico' onclick='dialogo_historico_conversa_chat();'>$imagem_servidor[0]</span>
";

// campo conteudo de historico
$campo_conteudo_historico = "
<div class='classe_div_opcoes_historico_chat'>
<div onclick='dialogo_limpar_historico_chat()'>$imagem_servidor[1]</div>
</div>

<div class='classe_div_mensagens_historico_chat' id='id_div_mensagens_historico_chat'></div>
<div class='classe_div_limpar_historico_chat' onclick='carregar_historico_chat();'>$idioma[145]</div>
";

// adiciona dialogo
$campo_conteudo_historico = janela_mensagem_dialogo($idioma[144], $campo_conteudo_historico, "id_dialogo_historico_conversas");

// campo excluir
$campo_excluir = "
$idioma[146]
<br>
<br>
<input type='button' class='botao_padrao' value='$idioma[101]' onclick='excluir_historico_chat();'>
";

// adiciona dialogo
$campo_excluir = janela_mensagem_dialogo($idioma[146], $campo_excluir, "id_dialogo_historico_conversas_limpar");

// codigo html
$campo_usuarios_chat = "
<div class='classe_div_chat_usuario_opcoes' id='id_div_chat_usuario_opcoes' onclick='minimiza_janela_chat_usuario();'>
<span>$idioma[139]</span>
<span id='id_span_num_usuarios_online_chat'>$numero_amigos_online</span>
</div>

<div class='classe_div_chat_usuario' id='id_div_amigos_usuario_chat'>
<div class='classe_div_chat_usuario_amigos' id='id_div_chat_usuario_amigos_chat' onscroll='constroe_lista_usuarios_chat();'></div>
</div>
";

// campo conversa chat
$campo_conversa_chat = "
<div class='classe_div_conversa_chat' id='id_div_janela_conversa_chat_usuario'>
<div class='classe_div_conversa_chat_opcoes'>

<span class='classe_div_conversa_chat_opcoes_historico_fechar' onclick='fechar_janela_conversa_chat();'>$imagem_servidor[2]</span>
<span class='classe_div_conversa_chat_opcoes_online_offline' id='id_span_online_offline_usuario_conversando'>...</span>
<span class='classe_div_conversa_chat_opcoes_nome' id='id_span_nome_usuario_conversando'>...</span>
$campo_historico

</div>
<div class='classe_div_conversas_usuario' id='id_div_conversas_usuario_chat'></div>
<div class='classe_div_enviar_conversa_chat'>
<textarea cols='10' rows='5' placeholder='$idioma[142]' id='id_campo_entrada_conversa_chat' onkeydown='if(event.keyCode == 13){enviar_conversa_chat();}'></textarea>
</div>
</div>
$campo_conteudo_historico
$campo_excluir
";

// codigo html
$codigo_html .= $campo_usuarios_chat;
$codigo_html .= $campo_conversa_chat;

// retorno
return $codigo_html;

};

?>