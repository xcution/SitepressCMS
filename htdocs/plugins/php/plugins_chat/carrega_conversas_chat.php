<?php

// carrega as conversas de chat
function carrega_conversas_chat(){

// tabela
$tabela = TABELA_CHAT_USUARIO;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// id de amigo
$idamigo = retorne_usuario_chat();

// dados de formulario
$contador_avanco = remove_html($_REQUEST['contador_avanco_chat']);

// valida ids de usuarios
if($idusuario == null or $idamigo == null){

// valores padrao
$codigo_html = -1;
	
};

// limit de mensagens de chat
if($contador_avanco == 0){

// query
$query = "select *from $tabela where idusuario='$idusuario' and idamigo='$idamigo';";

// numero de mensagens
$numero_mensagens = retorne_numero_linhas_query($query) - 1;

// valida numero de mensagens
if($numero_mensagens < 0){

// numero de mensagens padrao
$numero_mensagens = 0;
	
};

// limit
$limit = "limit $numero_mensagens, 25";

}else{

// limit	
$limit = retorne_limit_conversas_chat();

// numero de mensagens padrao
$numero_mensagens = 0;

};

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

// valores padrao
$codigo_html = -1;
	
};

// constroe mensagens
for($contador == $contador; $contador <= $numero_linhas; $contador++){

// dados
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);

// codigo html
$codigo_html .= constroe_conversas_chat_dados($dados);

};

// atualiza array de retorno
$array_retorno['conteudo'] = $codigo_html;
$array_retorno['contador'] = $numero_mensagens;

// retorno
return json_encode($array_retorno);

};

?>