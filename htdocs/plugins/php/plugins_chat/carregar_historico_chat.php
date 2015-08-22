<?php

// carrega o historico de chat
function carregar_historico_chat(){

// tabela
$tabela = TABELA_CHAT_USUARIO;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// id de amigo
$idamigo = retorne_usuario_chat();

// valida ids de usuarios de conversa
if($idusuario == null or $idamigo == null){

// retorno padrao
return -1;
	
};

// limit
$limit = retorne_limit_chat();

// query
$query = "select *from $tabela where idusuario='$idusuario' and idamigo='$idamigo' order by id asc $limit";

// comando
$comando = comando_executa($query);

// contador
$contador = 0;

// numero de linhas
$numero_linhas = retorne_numero_linhas_comando($comando);

// valida o numero de linhas
if($numero_linhas == 0){

// retorno padrao
return -1;
	
};

// constroe mensagens
for($contador == $contador; $contador <= $numero_linhas; $contador++){

// dados
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);

// codigo html
$codigo_html .= constroe_conversas_chat_dados($dados);

};

// retorno
return $codigo_html;

};

?>