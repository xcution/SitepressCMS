<?php

// exclui a publicacao
function excluir_publicacao(){

// valida usuario administrador
if(retorne_usuario_administrador() == false){

// retorno nulo
return null;
	
};

// tabela
$tabela[0] = TABELA_PUBLICACOES;
$tabela[1] = TABELA_IMAGENS_ALBUM;

// id de post
$idpost = retorne_idpost_request();

// query
$query[0] = "select *from $tabela[0] where id='$idpost';";

// dados
$dados = retorne_dados_query($query[0]);

// separa dados
$idusuario = $dados['idusuario'];
$idalbum = $dados['idalbum'];

// query
$query[1] = "select *from $tabela[1] where idalbum='$idalbum';";

// comando
$comando = comando_executa($query[1]);

// contador
$contador = 0;

// numero de linhas
$numero_linhas = retorne_numero_linhas_comando($comando);

// pasta de usuario
$pasta_usuario = retorne_pasta_usuario($idusuario, 2, true);

// apagando imagens de album
for($contador == $contador; $contador <= $numero_linhas; $contador++){

// dados
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);

// separa dados
$url_imagem = $pasta_usuario.basename($dados['url_imagem']);
$url_imagem_miniatura = $pasta_usuario.basename($dados['url_imagem_miniatura']);

// excluindo arquivo
exclui_arquivo_unico($url_imagem);
exclui_arquivo_unico($url_imagem_miniatura);
	
};

// remove dados de tabela
$query[0] = "delete from $tabela[0] where id='$idpost';";
$query[1] = "delete from $tabela[1] where idalbum='$idalbum';";

// comando executa
comando_executa($query[0]);
comando_executa($query[1]);

};

?>