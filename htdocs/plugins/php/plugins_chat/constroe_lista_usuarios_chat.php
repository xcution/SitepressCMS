<?php

// constroe a lista de usuarios do chat
function constroe_lista_usuarios_chat(){

// tabela
$tabela = TABELA_AMIZADE;

// id de usuario
$idusuario = retorne_idusuario_logado();

// limit
$limit = retorne_limit_chat();

// query
$query = "select *from $tabela where idusuario='$idusuario' order by id desc $limit;";

// contador
$contador = 0;

// comando
$comando = comando_executa($query);

// numero de linhas de comando
$numero_linhas = retorne_numero_linhas_comando($comando);

// array de retorno
$array_retorno = array();

// constroe usuarios
for($contador == $contador; $contador <= $numero_linhas; $contador++){

// dados
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);

// separa dados
$idamigo = $dados['idamigo'];

// constroe usuario
if($idamigo != null){

// nome do usuario
$nome_usuario = retorne_nome_usuario($idamigo);

// dados de imagem
$dados_imagem = retorne_imagem_perfil_usuario($idamigo);

// separa dados de imagem
$imagem_perfil_miniatura = $dados_imagem['url_imagem_perfil_miniatura'];

// imagem de perfil
$imagem_perfil = "<img src='$imagem_perfil_miniatura' title='$nome_usuario'>";

// usuario online
$usuario_online = retorne_usuario_online($idamigo);

// valida usuario online
if($usuario_online == true){

$imagem_servidor[0] = retorne_imagem_servidor(23);

}else{

$imagem_servidor[0] = retorne_imagem_servidor(22);
	
};

// codigo html
$codigo_html .= "
<div class='classe_div_usuario_chat' onclick='seta_usuario_chat($idamigo);'>

<div class='classe_div_usuario_chat_img_perfil'>$imagem_perfil</div>
<div class='classe_div_usuario_chat_nome'>$nome_usuario</div>
<div class='classe_div_usuario_chat_usuario_online' id='id_div_usuario_online_offline_$idamigo'>$imagem_servidor[0]</div>
<span class='classe_div_usuario_chat_novas_mensagens' id='id_numero_novas_mensagens_usuario_$idamigo'></span>

</div>
";

// atualiza array de ids de amigos
$array_amigos_carregados[] = $idamigo;

};


};

// valida numero de linhas
if($numero_linhas == 0){

// limpa o codigo html
$codigo_html = null;
$array_amigos_carregados[] = 0;
	
};

// atualiza o array de retorno
$array_retorno['conteudo'] = $codigo_html;
$array_retorno['ids_usuarios'] = $array_amigos_carregados;

// retorno
return json_encode($array_retorno);

};

?>