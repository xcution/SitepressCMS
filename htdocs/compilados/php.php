<?php 
function campo_opcao_administrador(){
global $idioma;
if(retorne_usuario_administrador() == false){
return null;	
};
switch(retorne_href_get()){
case $idioma[31]:
$conteudo = constroe_campo_publicar();
break;
case $idioma[32]:
$conteudo = constroe_criar_slideshow();
break;
default:
$conteudo = constroe_campo_publicar();
break;
};
$conteudo_bloco = campo_publicar_bloco();
if($conteudo_bloco != null){
$conteudo = $conteudo_bloco;
};
$codigo_html = "
<div class='classe_campo_opcao_administrador'>
$conteudo
</div>
";
return $codigo_html;
};
function constroe_campo_administrar(){
global $idioma;
global $pagina_href;
if(retorne_usuario_administrador() == false){
return null;
};
$titulo = $idioma[18];
$links[] = "<a href='$pagina_href[3]'>$idioma[19]</a>";
$links[] = "<a href='$pagina_href[4]'>$idioma[47]</a>";
$links[] = "<a href='$pagina_href[6]'>$idioma[22]</a>";
$links[] = "<a href='$pagina_href[7]'>$idioma[23]</a>";
$links[] = "<a href='$pagina_href[9]'>$idioma[25]</a>";
$links[] = "<a href='$pagina_href[10]'>$idioma[26]</a>";
$links[] = "<a href='$pagina_href[11]'>$idioma[27]</a>";
$links[] = "<a href='$pagina_href[12]'>$idioma[28]</a>";
$links[] = "<a href='$pagina_href[14]'>$idioma[30]</a>";
$conteudo = constroe_links_menu_vertical($links);
$codigo_html = constroe_menu_navegacao_vertical($titulo, $conteudo);
return $codigo_html;
};
function retorne_idusuario_administrador(){
$email = CONFIG_EMAIL_ADMIN;
$tabela = TABELA_CADASTRO;
$query = "select *from $tabela where email='$email';";
$dados = retorne_dados_query($query);
return $dados['id'];
};
function adicionar_amizade(){
$tabela = TABELA_AMIZADE;
$idusuario_logado = retorne_idusuario_logado();
$idusuario_admin = retorne_idusuario_administrador();
if($idusuario_logado == $idusuario_admin or retorne_usuario_logado() == false){
return null;
};
$data = data_atual();
$query[0] = "select *from $tabela where idusuario='$idusuario_logado' and idamigo='$idusuario_admin';";
$numero_linhas = retorne_numero_linhas_query($query[0]);
if($numero_linhas == 0){
$query[1] = "insert into $tabela values(null, '$idusuario_logado', '$idusuario_admin', '$data');";
$query[2] = "insert into $tabela values(null, '$idusuario_admin', '$idusuario_logado', '$data');";
comando_executa($query[1]);
comando_executa($query[2]);
};
};
function retorne_numero_amigos($modo, $idusuario){
$tabela_amigos = TABELA_AMIZADE;
$tabela_solicitacao_amigos = TABELA_SOLICITACAO_AMIZADE;
switch($modo){
case 1:
$query = "select *from $tabela_amigos where idusuario='$idusuario';";
break;
case 2:
$query = "select *from $tabela_solicitacao_amigos where idusuario='$idusuario' and modo='0';";
break;
case 3:
$query = "select *from $tabela_solicitacao_amigos where idusuario='$idusuario' and modo='1';";
break;
};
return retorne_numero_linhas_query($query);
};
function retorne_numero_amigos_online(){
$tabela = TABELA_AMIZADE;
$idusuario = retorne_idusuario_logado();
$query = "select *from $tabela where idusuario='$idusuario';";
$comando = comando_executa($query);
$contador = 0;
$numero_amigos_online = 0;
$numero_linhas = retorne_numero_linhas_comando($comando);
for($contador == $contador; $contador <= $numero_linhas; $contador++){
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);
$idamigo = $dados['idamigo'];
if($idamigo != null){
if(retorne_usuario_online($idamigo) == true){
$numero_amigos_online++;
};
};
};
return $numero_amigos_online;
};
function retorne_usuario_amigo($idamigo, $modo){
if($modo == false){
$dados_usuario = sessao_completa_usuario();
return $dados_usuario['usuario_amigo'];
};
if(retorne_usuario_dono_perfil(false) == true){
return true;
};
$tabela = TABELA_AMIZADE;
$idusuario = retorne_idusuario_logado();
$query = "select *from $tabela where idusuario='$idusuario' and idamigo='$idamigo';";
$numero_linhas = retorne_numero_linhas_query($query);
if($numero_linhas == 1){
return true;
}else{
return false;
};
};
function criar_pasta($pasta){
if($pasta != null or is_dir($pasta) == false){
if(file_exists($pasta) == false){
mkdir($pasta, 0777, true); 
};
};
};
function excluir_pastas_subpastas($endereco_pasta_remover){
if (is_dir($endereco_pasta_remover)) {
$objects = scandir($endereco_pasta_remover);
foreach ($objects as $object) {
if ($object != "." && $object != "..") {
if (filetype($endereco_pasta_remover."/".$object) == "dir") excluir_pastas_subpastas($endereco_pasta_remover."/".$object); else unlink($endereco_pasta_remover."/".$object);
};
};
reset($objects);
rmdir($endereco_pasta_remover);
};
};
function exclui_arquivo_unico($endereco_arquivo){
if($endereco_arquivo != null){
 @unlink($endereco_arquivo);
};
};
function remove_comentarios($codigo_entrada){
$newStr  = '';
$commentTokens = array(T_COMMENT);
if (defined('T_DOC_COMMENT'))
$commentTokens[] = T_DOC_COMMENT; if (defined('T_ML_COMMENT'))
$commentTokens[] = T_ML_COMMENT;  $tokens = token_get_all($codigo_entrada);
foreach ($tokens as $token) {
if (is_array($token)) {
if (in_array($token[0], $commentTokens))
continue;
$token = $token[1];
};
$newStr .= $token;
};
$codigo_entrada = $newStr;
$codigo_entrada = preg_replace('!/\*.*?\*/!s', '', $codigo_entrada);
$codigo_entrada = preg_replace('#^\s*//.+$#m', "", $codigo_entrada);
$codigo_entrada = preg_replace('/\n\s*\n/', "\n", $codigo_entrada);
return $codigo_entrada; 
};
function retorna_conteudo_arquivo($endereco_arquivo){
if($endereco_arquivo != null){
return @file_get_contents($endereco_arquivo);
};
};
function retorne_lista_todas_pastas($endereco_pasta){
$pasta_diretorio = new RecursiveDirectoryIterator($endereco_pasta);
$array_retorno = array();
foreach($pasta_diretorio as $endereco){
if($endereco != null){
$array_retorno[] = $endereco;
};
};
return $array_retorno;
};
function retorne_lista_todos_arquivos($endereco_pasta, $extensao, $auto_include){
$pasta_diretorio = new RecursiveDirectoryIterator($endereco_pasta);
$lista_arquivos = new RecursiveIteratorIterator($pasta_diretorio);
$arquivos_encontrados = array();
foreach ($lista_arquivos as $informacao_arquivo) {
$extensao_arquivo = ".".pathinfo($informacao_arquivo, PATHINFO_EXTENSION);
if($extensao == $extensao_arquivo or $extensao == null){
$endereco_arquivo = $informacao_arquivo->getPathname();
$arquivos_encontrados[] = $endereco_arquivo;
if($auto_include == true){
include_once($endereco_arquivo);
};
};
};
return $arquivos_encontrados;
};
function salvar_arquivo($endereco, $conteudo){
$conteudo = remove_comentarios($conteudo);
$arquivo = fopen($endereco, "w+");
fwrite($arquivo, $conteudo);
fclose($arquivo);
};
function atualizar_conteudo_elemento_bloco(){
global $idioma;
$id = remove_html($_REQUEST['id']);
$tipo_elemento = remove_html($_REQUEST['tipo_elemento']);
$valor = remove_html($_REQUEST['valor']);
$nome_usuario = remove_html($_REQUEST['nome_usuario']);
$data = remove_html($_REQUEST['data']);
switch($tipo_elemento){
case $idioma[73]:
$tabela = TABELA_COMUNICADO;
$campo_tabela = "conteudo='$valor'";
break;
case $idioma[74]:
$tabela = TABELA_TELEFONES_UTEIS;
$campo_tabela = "conteudo='$valor'";
break;
case $idioma[79]:
$tabela = TABELA_DIRECAO;
$campo_tabela = "conteudo='$valor'";
break;
};
$query = "update $tabela set $campo_tabela where id='$id';";
comando_executa($query);
};
function campo_gerenciar_elemento_bloco($tipo_bloco, $dados){
global $idioma;
$id = $dados['id'];
$conteudo = $dados['conteudo'];
$nome_usuario = $dados['nome_usuario'];
$data = $dados['data'];
if(retorne_usuario_administrador() == false or $id == null){
return null;
};
$imagem_servidor[0] = retorne_imagem_servidor(16);
$imagem_servidor[1] = retorne_imagem_servidor(17);
$campo_excluir = "
$idioma[100]
<br>
<br>
<input type='button' value='$idioma[101]' class='botao_padrao' onclick='excluir_elemento_bloco($id);'>
";
$campo_excluir = janela_mensagem_dialogo($idioma[98], $campo_excluir, "id_dialogo_excluir_elemento_bloco_$id");
if($tipo_bloco != $idioma[76]){
$campo_editar = "
<div class='classe_div_editar_conteudo_elemento_bloco'>
<textarea cols='50' rows='5' id='textarea_editar_conteudo_elemento_bloco_$id'>$conteudo</textarea>
</div>
$campos_extras
<div class='classe_div_editar_conteudo_elemento_bloco'>
<input type='button' value='$idioma[102]' class='botao_padrao' onclick='atualizar_conteudo_elemento_bloco($id);'>
</div>
";
$botao_editar = "
<div onclick='dialogo_editar_elemento_bloco($id);'>$imagem_servidor[1]</div>
";
$campo_editar = janela_mensagem_dialogo($idioma[99], $campo_editar, "id_dialogo_editar_elemento_bloco_$id");
};
$codigo_html = "
<div class='classe_div_excluir_elemento_bloco'>
<div onclick='dialogo_excluir_elemento_bloco($id);'>$imagem_servidor[0]</div>
$botao_editar
</div>
$campo_excluir
$campo_editar
";
return $codigo_html;
};
function campo_publicar_bloco(){
global $idioma;
switch(retorne_href_get()){
case $idioma[34]:
$validou_conteudo = true;
$evento = "salvar_comunicado();";
$imagem = retorne_imagem_servidor(7);
$descricao = $idioma[82];
$campos = "
<textarea cols='10' rows='3' placeholder='$descricao' id='id_campo_conteudo_comunicado'></textarea>
";
break;
case $idioma[35]:
$validou_conteudo = true;
$evento = "salvar_telefones_uteis();";
$imagem = retorne_imagem_servidor(8);
$descricao = $idioma[83];
$campos = "
<textarea cols='10' rows='3' placeholder='$descricao' id='id_campo_conteudo_telefones'></textarea>
";
break;
case $idioma[37]:
$validou_conteudo = true;
$evento = "criar_enquete();";
$imagem = retorne_imagem_servidor(10);
$descricao = $idioma[85];
$campos = "
<textarea cols='10' rows='3' placeholder='$descricao' id='id_campo_conteudo_enquete'></textarea>
";
break;
case $idioma[38]:
$validou_conteudo = true;
$evento = "cadastra_funcionario();";
$imagem = retorne_imagem_servidor(11);
$descricao = $idioma[86];
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
$validou_conteudo = true;
$evento = null;
$imagem = retorne_imagem_servidor(12);
$descricao = $idioma[87];
$campos = constroe_formulario_barra_progresso(PAGINA_ACOES, "id_formulario_upload_imagens_galeria", "fotos[]", 16, true, 1);
break;
case $idioma[40]:
$validou_conteudo = true;
$evento = "cria_direcao();";
$imagem = retorne_imagem_servidor(13);
$descricao = $idioma[88];
$campos = "
<textarea cols='10' rows='3' placeholder='$descricao' id='id_campo_conteudo_direcao'></textarea>
";
break;
case $idioma[42]:
$validou_conteudo = true;
$evento = null;
$imagem = retorne_imagem_servidor(15);
$descricao = $idioma[90];
$campos = "
";
break;
};
if($evento != null){
$botao_salvar = "
<div class='classe_div_campo_publicar_bloco_salvar'>
<input type='button' value='$idioma[57]' class='botao_padrao' onclick='$evento'>
</div>
";
};
$codigo_html = "
<div class='classe_div_campo_publicar_bloco'>
<input type='hidden' id='' value=''>
<div class='classe_div_campo_publicar_bloco_imagem'>$imagem</div>
<div class='classe_div_campo_publicar_bloco_descricao'>$descricao</div>
<div class='classe_div_campo_publicar_bloco_campos'>$campos</div>
$botao_salvar
</div>
";
if($validou_conteudo == true){
return $codigo_html;
};
};
function campo_votar_enquete($dados){
$id = $dados['id'];
$conteudo = $dados['conteudo'];
$data = $dados['data'];
$votacao_atual = votacao_atual_enquete($id);
$codigo_html = "
<div class='classe_div_votar_enquete_bloco' id='id_div_votar_enquete_bloco_$id'>
$votacao_atual
</div>
";
return $codigo_html;
};
function carregar_conteudo_bloco(){
global $idioma;
$href_pagina = retorne_href_get();
switch($href_pagina){
case $idioma[73]:
$tabela = TABELA_COMUNICADO;
$imagem[0] = retorne_imagem_servidor(7);
$exibir_data = false;
break;
case $idioma[74]:
$tabela = TABELA_TELEFONES_UTEIS;
$imagem[0] = retorne_imagem_servidor(8);
$exibir_data = false;
break;
case $idioma[76]:
$tabela = TABELA_ENQUETE;
$imagem[0] = retorne_imagem_servidor(10);
$exibir_data = false;
$votar_enquete = true;
break;
case $idioma[77]:
return carrega_funcionarios();
break;
case $idioma[78]:
return carrega_galeria_imagens();
break;
case $idioma[79]:
$tabela = TABELA_DIRECAO;
$imagem[0] = retorne_imagem_servidor(13);
$exibir_data = false;
break;
};
$limit = retorne_limit();
$query = "select *from $tabela order by id desc $limit";
$comando = comando_executa($query);
$numero_linhas = retorne_numero_linhas_comando($comando);
if($numero_linhas == 0){
return null;
};
$contador = 0;
for($contador == $contador; $contador <= $numero_linhas; $contador++){
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);
$id = $dados['id'];
$conteudo = $dados['conteudo'];
$nome_usuario = $dados['nome_usuario'];
$data = $dados['data'];
if($id != null){
$data = converte_data_bloco($data);
$campo_gerenciar = campo_gerenciar_elemento_bloco($href_pagina, $dados);
$conteudo = str_replace("\n", "<br>", $conteudo);
if($exibir_data == true){
$campo_data = "
<div class='classe_div_conteudo_bloco_data'>$data</div>
";
};
if($votar_enquete == true){
$campo_votar_enquete = campo_votar_enquete($dados);
};
$codigo_html .= "
<div class='classe_div_conteudo_bloco' title='$data' id='id_div_conteudo_bloco_$id'>
$campo_gerenciar
<div class='classe_div_conteudo_bloco_imagem'>$imagem[0]</div>
<div class='classe_div_conteudo_bloco_conteudo'>$conteudo</div>
$campo_data
$campo_votar_enquete
</div>
";
};
};
return $codigo_html;
};
function constroe_campo_bloco_pagina(){
global $idioma;
global $pagina_href;
if(retorne_usuario_logado() == false and CONFIG_VALIDA_USUARIO_LOGADO_BLOCO == true and retorne_href_get() != $idioma[81]){
$imagem[0] = retorne_imagem_servidor(18);
$mensagem = "
$imagem[0]
<br>
<br>
$idioma[107]
";
return mensagem_sistema($mensagem);
};
switch(retorne_href_get()){
case $idioma[73]:
$conteudo_bloco = carregar_conteudo_bloco();
break;
case $idioma[74]:
$conteudo_bloco = carregar_conteudo_bloco();
break;
case $idioma[75]:
$conteudo_bloco = carregar_conteudo_bloco();
break;
case $idioma[76]:
$conteudo_bloco = carregar_conteudo_bloco();
break;
case $idioma[77]:
$conteudo_bloco = carrega_funcionarios();
break;
case $idioma[78]:
$conteudo_bloco = carrega_galeria_imagens();
break;
case $idioma[79]:
$conteudo_bloco = carregar_conteudo_bloco();
break;
case $idioma[81]:
$conteudo_bloco = formulario_contato_usuario();
break;
};
$array_titulo_blocos = retorna_array_links_blocos(true);
$bloco[1] = constroe_elemento_bloco($array_titulo_blocos[1], $idioma[65], retorne_imagem_servidor(7));
$bloco[2] = constroe_elemento_bloco($array_titulo_blocos[2], $idioma[67], retorne_imagem_servidor(8));
$bloco[4] = constroe_elemento_bloco($array_titulo_blocos[4], $idioma[69], retorne_imagem_servidor(10));
$bloco[5] = constroe_elemento_bloco($array_titulo_blocos[5], $idioma[70], retorne_imagem_servidor(11));
$bloco[6] = constroe_elemento_bloco($array_titulo_blocos[6], $idioma[71], retorne_imagem_servidor(12));
$bloco[7] = constroe_elemento_bloco($array_titulo_blocos[7], $idioma[28], retorne_imagem_servidor(13));
$bloco[9] = constroe_elemento_bloco($array_titulo_blocos[9], $idioma[30], retorne_imagem_servidor(15));
if($conteudo_bloco == null){
$codigo_html = "
<div class='classe_div_bloco_pagina' id='id_div_bloco_pagina'>
$bloco[1]
$bloco[2]
$bloco[4]
$bloco[5]
$bloco[6]
$bloco[7]
$bloco[9]
</div>
";
}else{
$codigo_html = "
<div class='classe_div_bloco_pagina' id='id_div_bloco_pagina'>
$conteudo_bloco
</div>
";
};
return $codigo_html;
};
function constroe_elemento_bloco($titulo, $conteudo, $imagens){
global $idioma;
$codigo_html = "
<div class='classe_div_bloco_pagina_bloco_div'>
<div class='classe_titulo_bloco'>
$titulo
</div>
<div class='classe_conteudo_bloco'>
$conteudo
</div>
<div class='classe_imagens_bloco'>
$imagens
</div>
</div>
";
return $codigo_html;
};
function converte_data_bloco($data){
$data = explode("-", $data);
$data = $data[2]."-".$data[1]."-".$data[0];
return converte_data_amigavel($data);
};
function criar_enquete(){
$conteudo = remove_html($_REQUEST['conteudo']);
$tabela = TABELA_ENQUETE;
$data = data_atual();
$query = "insert into $tabela values(null, '$conteudo', '$data');";
if($conteudo != null){
comando_executa($query);
};
};
function cria_direcao(){
$conteudo = remove_html($_REQUEST['conteudo']);
$tabela = TABELA_DIRECAO;
$data = data_atual();
$query = "insert into $tabela values(null, '$conteudo', '$data');";
if($conteudo != null){
comando_executa($query);
};
};
function excluir_elemento_bloco(){
global $idioma;
$id = remove_html($_REQUEST['id']);
$tipo_elemento = remove_html($_REQUEST['tipo_elemento']);
switch($tipo_elemento){
case $idioma[73]:
$tabela = TABELA_COMUNICADO;
break;
case $idioma[74]:
$tabela = TABELA_TELEFONES_UTEIS;
break;
case $idioma[76]:
$tabela = TABELA_ENQUETE;
$excluir_votos_enquete = true;
break;
case $idioma[79]:
$tabela = TABELA_DIRECAO;
break;
};
$query = "delete from $tabela where id='$id';";
comando_executa($query);
if($excluir_votos_enquete == true){
$tabela = TABELA_VOTO_ENQUETE;
$query = "delete from $tabela where id_enquete='$id';";
comando_executa($query);
};
};
function retorna_array_links_blocos($modo){
global $idioma;
global $pagina_href;
if($modo == true){
$links[1] = "<a href='$pagina_href[18]' title='$idioma[22]'>$idioma[22]</a>";
$links[2] = "<a href='$pagina_href[19]' title='$idioma[23]'>$idioma[23]</a>";
$links[4] = "<a href='$pagina_href[21]' title='$idioma[69]'>$idioma[69]</a>";
$links[5] = "<a href='$pagina_href[22]' title='$idioma[26]'>$idioma[26]</a>";
$links[6] = "<a href='$pagina_href[23]' title='$idioma[27]'>$idioma[27]</a>";
$links[7] = "<a href='$pagina_href[24]' title='$idioma[28]'>$idioma[28]</a>";
$links[9] = "<a href='$pagina_href[26]' title='$idioma[30]'>$idioma[30]</a>";
}else{
$links[1] = "$pagina_href[18]' title='$idioma[22]";
$links[2] = "$pagina_href[19]' title='$idioma[23]";
$links[4] = "$pagina_href[21]' title='$idioma[69]";
$links[5] = "$pagina_href[22]' title='$idioma[26]";
$links[6] = "$pagina_href[23]' title='$idioma[27]";
$links[7] = "$pagina_href[24]' title='$idioma[28]";
$links[9] = "$pagina_href[26]' title='$idioma[30]";
};
return $links;
};
function salvar_comunicado(){
$conteudo = remove_html($_REQUEST['conteudo']);
$tabela = TABELA_COMUNICADO;
$data = data_atual();
$query = "insert into $tabela values(null, '$conteudo', '$data');";
if($conteudo != null){
comando_executa($query);
};
};
function salvar_telefones_uteis(){
$conteudo = remove_html($_REQUEST['conteudo']);
$tabela = TABELA_TELEFONES_UTEIS;
$data = data_atual();
$query = "insert into $tabela values(null, '$conteudo', '$data');";
if($conteudo != null){
comando_executa($query);
};
};
function votacao_atual_enquete($id){
global $idioma;
$tabela = TABELA_VOTO_ENQUETE;
$query[0] = "select *from $tabela where id_enquete='$id';";
$query[1] = "select *from $tabela where id_enquete='$id' and resposta_sim='1';";
$query[2] = "select *from $tabela where id_enquete='$id' and resposta_nao='1';";
$numero_linhas = retorne_numero_linhas_query($query[0]);
$resposta_sim = retorne_numero_linhas_query($query[1]);
$resposta_nao = retorne_numero_linhas_query($query[2]);
$porcentagem[0] = @(($resposta_sim * 100) / $numero_linhas);
$porcentagem[1] = @(($resposta_nao * 100) / $numero_linhas);
$porcentagem[0] = round($porcentagem[0], 2);
$porcentagem[1] = round($porcentagem[1], 2);
$codigo_html = "
<div class='classe_numero_votos_enquete'>$idioma[130]: $numero_linhas</div>
<div class='classe_votos_enquete_porcentagem' onclick='votar_enquete($id, 1);'>$idioma[101]: $porcentagem[0]%</div>
<div class='classe_votos_enquete_porcentagem' onclick='votar_enquete($id, 0);'>$idioma[131]: $porcentagem[1]%</div>
";
return $codigo_html;
};
function votar_enquete(){
$id = remove_html($_REQUEST['id']);
$voto = remove_html($_REQUEST['voto']);
if($id == null or $voto == null or retorne_usuario_logado() == false){
return null;
};
$tabela = TABELA_VOTO_ENQUETE;
$idusuario = retorne_idusuario_logado();
$data = data_atual();
if($voto == 1){
$votar[0] = 1;
$votar[1] = 0;
}else{
$votar[0] = 0;
$votar[1] = 1;	
};
$query[0] = "delete from $tabela where id_enquete='$id' and idusuario='$idusuario';";
$query[1] = "insert into $tabela values(null, '$id', '$idusuario', '$votar[0]', '$votar[1]', '$data');";
executador_querys($query);
return votacao_atual_enquete($id);
};
function cadastro_usuario(){
global $idioma;
$email = remove_html($_REQUEST['email']);
$senha = remove_html($_REQUEST['senha']);
$senha_normal = remove_html($_REQUEST['senha_normal']);
$senha = cifra_senha_md5($senha);
$numero_erros = 0;
if(verifica_se_email_valido($email) == false){
$mensagem_erro .= "<li>";
$mensagem_erro .= $idioma[11];
$numero_erros++;
};
if(strlen($senha) < TAMANHO_MINIMO_SENHA){
$mensagem_erro .= "<li>";
$mensagem_erro .= $idioma[12];
$numero_erros++;
};
if($numero_erros > 0){
return mensagem_sistema($mensagem_erro);
};
$tabela = TABELA_CADASTRO;
$data = data_atual();
$query[0] = "select *from $tabela where email='$email';";
$query[1] = "insert into $tabela values(null, '$email', '$senha', '$senha_normal', '$data');";
if(retorne_numero_linhas_query($query[0]) == 1){
return mensagem_sistema($idioma[10]);
};
comando_executa($query[1]);
salvar_cookies($email, $senha, false);
return true;
};
function campo_cadastro_topo(){
global $idioma;
global $pagina_href;
if(retorne_usuario_logado() == false){
$codigo_html = formulario_login();
}else{
$codigo_html = "
<div class='classe_div_campo_cadastro_topo'>
<a href='$pagina_href[2]' title='$idioma[15]'>$idioma[15]</a>
</div>
";
};
return $codigo_html;
};
function abrir_janela_conversa_chat(){
if(retorne_usuario_chat() == null){
return false;
}else{
return true;
};
};
function carregar_historico_chat(){
$tabela = TABELA_CHAT_USUARIO;
$idusuario = retorne_idusuario_logado();
$idamigo = retorne_usuario_chat();
if($idusuario == null or $idamigo == null){
return -1;
};
$limit = retorne_limit_chat();
$query = "select *from $tabela where idusuario='$idusuario' and idamigo='$idamigo' order by id asc $limit";
$comando = comando_executa($query);
$contador = 0;
$numero_linhas = retorne_numero_linhas_comando($comando);
if($numero_linhas == 0){
return -1;
};
for($contador == $contador; $contador <= $numero_linhas; $contador++){
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);
$codigo_html .= constroe_conversas_chat_dados($dados);
};
return $codigo_html;
};
function carrega_conversas_chat(){
$tabela = TABELA_CHAT_USUARIO;
$idusuario = retorne_idusuario_logado();
$idamigo = retorne_usuario_chat();
$contador_avanco = remove_html($_REQUEST['contador_avanco_chat']);
if($idusuario == null or $idamigo == null){
$codigo_html = -1;
};
if($contador_avanco == 0){
$query = "select *from $tabela where idusuario='$idusuario' and idamigo='$idamigo';";
$numero_mensagens = retorne_numero_linhas_query($query) - 1;
if($numero_mensagens < 0){
$numero_mensagens = 0;
};
$limit = "limit $numero_mensagens, 25";
}else{
$limit = retorne_limit_conversas_chat();
$numero_mensagens = 0;
};
$query = "select *from $tabela where idusuario='$idusuario' and idamigo='$idamigo' order by id asc $limit";
$comando = comando_executa($query);
$contador = 0;
$numero_linhas = retorne_numero_linhas_comando($comando);
if($numero_linhas == 0){
$codigo_html = -1;
};
for($contador == $contador; $contador <= $numero_linhas; $contador++){
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);
$codigo_html .= constroe_conversas_chat_dados($dados);
};
$array_retorno['conteudo'] = $codigo_html;
$array_retorno['contador'] = $numero_mensagens;
return json_encode($array_retorno);
};
function carrega_informacoes_usuario_chat(){
$idusuario = retorne_usuario_chat();
if($idusuario == null){
return null;
};
$nome_usuario = retorne_nome_usuario($idusuario);
$usuario_online = retorne_usuario_online($idusuario);
if($usuario_online == true){
$imagem_servidor[0] = retorne_imagem_servidor(23);
}else{
$imagem_servidor[0] = retorne_imagem_servidor(22);
};
$array_retorno['nome'] = $nome_usuario;
$array_retorno['online_offline'] = $imagem_servidor[0];
return json_encode($array_retorno);
};
function constroe_chat_usuario(){
global $idioma;
if(retorne_usuario_logado() == false){
return null;
};
$numero_amigos_online = retorne_numero_amigos_online();
$imagem_servidor[0] = retorne_imagem_servidor(24);
$imagem_servidor[1] = retorne_imagem_servidor(16);
$imagem_servidor[2] = retorne_imagem_servidor(25);
$campo_historico = "
<span class='classe_div_conversa_chat_opcoes_historico' onclick='dialogo_historico_conversa_chat();'>$imagem_servidor[0]</span>
";
$campo_conteudo_historico = "
<div class='classe_div_opcoes_historico_chat'>
<div onclick='dialogo_limpar_historico_chat()'>$imagem_servidor[1]</div>
</div>
<div class='classe_div_mensagens_historico_chat' id='id_div_mensagens_historico_chat'></div>
<div class='classe_div_limpar_historico_chat' onclick='carregar_historico_chat();'>$idioma[145]</div>
";
$campo_conteudo_historico = janela_mensagem_dialogo($idioma[144], $campo_conteudo_historico, "id_dialogo_historico_conversas");
$campo_excluir = "
$idioma[146]
<br>
<br>
<input type='button' class='botao_padrao' value='$idioma[101]' onclick='excluir_historico_chat();'>
";
$campo_excluir = janela_mensagem_dialogo($idioma[146], $campo_excluir, "id_dialogo_historico_conversas_limpar");
$campo_usuarios_chat = "
<div class='classe_div_chat_usuario_opcoes' id='id_div_chat_usuario_opcoes' onclick='minimiza_janela_chat_usuario();'>
<span>$idioma[139]</span>
<span id='id_span_num_usuarios_online_chat'>$numero_amigos_online</span>
</div>
<div class='classe_div_chat_usuario' id='id_div_amigos_usuario_chat'>
<div class='classe_div_chat_usuario_amigos' id='id_div_chat_usuario_amigos_chat' onscroll='constroe_lista_usuarios_chat();'></div>
</div>
";
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
$codigo_html .= $campo_usuarios_chat;
$codigo_html .= $campo_conversa_chat;
return $codigo_html;
};
function constroe_conversas_chat_dados($dados){
$idusuario = retorne_idusuario_logado();
$id_tabela = $dados['id'];
$idusuario_tabela = $dados['idusuario'];
$idamigo_tabela = $dados['idamigo'];
$mensagem_tabela = $dados['mensagem'];
$data_tabela = $dados['data'];
$idusuario_enviou = $dados['idusuario_enviou'];
if($id_tabela == null){
return null;
};
if($idusuario_enviou == $idusuario){
$classe_div_imagem_perfil = "classe_div_imagem_perfil_1";
$classe_mensagem_chat = "classe_mensagem_chat_1";
}else{
$classe_div_imagem_perfil = "classe_div_imagem_perfil_2";
$classe_mensagem_chat = "classe_mensagem_chat_2";
};
$data_tabela = converte_data_amigavel($data_tabela);
$nome_usuario = retorne_nome_usuario($idusuario_enviou);
$dados_imagem = retorne_imagem_perfil_usuario($idusuario_enviou);
$url_imagem_perfil_miniatura = $dados_imagem['url_imagem_perfil_miniatura'];
$imagem_perfil = "<img src='$url_imagem_perfil_miniatura' title='$data_tabela'>";
$mensagem_tabela = converte_urls_texto_links($mensagem_tabela);
$codigo_html .= "<div class='classe_div_mensagem_recebida'>";
$codigo_html .= "<div class='$classe_div_imagem_perfil'>";
$codigo_html .= $imagem_perfil;
$codigo_html .= "</div>";
$codigo_html .= "<div class='$classe_mensagem_chat'>";
$codigo_html .= $mensagem_tabela;
$codigo_html .= "</div>";
$codigo_html .= "</div>";
return $codigo_html;
};
function constroe_lista_usuarios_chat(){
$tabela = TABELA_AMIZADE;
$idusuario = retorne_idusuario_logado();
$limit = retorne_limit_chat();
$query = "select *from $tabela where idusuario='$idusuario' order by id desc $limit;";
$contador = 0;
$comando = comando_executa($query);
$numero_linhas = retorne_numero_linhas_comando($comando);
$array_retorno = array();
for($contador == $contador; $contador <= $numero_linhas; $contador++){
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);
$idamigo = $dados['idamigo'];
if($idamigo != null){
$nome_usuario = retorne_nome_usuario($idamigo);
$dados_imagem = retorne_imagem_perfil_usuario($idamigo);
$imagem_perfil_miniatura = $dados_imagem['url_imagem_perfil_miniatura'];
$imagem_perfil = "<img src='$imagem_perfil_miniatura' title='$nome_usuario'>";
$usuario_online = retorne_usuario_online($idamigo);
if($usuario_online == true){
$imagem_servidor[0] = retorne_imagem_servidor(23);
}else{
$imagem_servidor[0] = retorne_imagem_servidor(22);
};
$codigo_html .= "
<div class='classe_div_usuario_chat' onclick='seta_usuario_chat($idamigo);'>
<div class='classe_div_usuario_chat_img_perfil'>$imagem_perfil</div>
<div class='classe_div_usuario_chat_nome'>$nome_usuario</div>
<div class='classe_div_usuario_chat_usuario_online' id='id_div_usuario_online_offline_$idamigo'>$imagem_servidor[0]</div>
<span class='classe_div_usuario_chat_novas_mensagens' id='id_numero_novas_mensagens_usuario_$idamigo'></span>
</div>
";
$array_amigos_carregados[] = $idamigo;
};
};
if($numero_linhas == 0){
$codigo_html = null;
$array_amigos_carregados[] = 0;
};
$array_retorno['conteudo'] = $codigo_html;
$array_retorno['ids_usuarios'] = $array_amigos_carregados;
return json_encode($array_retorno);
};
function enviar_conversa_chat(){
$tabela = TABELA_CHAT_USUARIO;
$conteudo = remove_html($_REQUEST['conteudo']);
$idusuario = retorne_idusuario_logado();
$idamigo = retorne_usuario_chat();
$data = data_atual();
$query[0] = "insert into $tabela values(null, '$idusuario', '$idamigo', '$conteudo', '1', '$data', '$idusuario');";
$query[1] = "insert into $tabela values(null, '$idamigo', '$idusuario', '$conteudo', '0', '$data', '$idusuario');";
$query[2] = "update $tabela set visualizada='1' where idusuario='$idusuario' and idamigo='$idamigo';";
comando_executa($query[0]);
comando_executa($query[1]);
comando_executa($query[2]);
};
function excluir_historico_chat(){
$tabela = TABELA_CHAT_USUARIO;
$idusuario = retorne_idusuario_logado();
$idamigo = retorne_usuario_chat();
if($idusuario == null or $idamigo == null){
return null;
};
$query = "delete from $tabela where idusuario='$idusuario' and idamigo='$idamigo';";
comando_executa($query);
};
function fechar_janela_conversa_chat(){
session_start();
$_SESSION[CONFIG_MD5_IDUSUARIO_CHAT] = null;
};
function retorna_numero_mensagens_chat($idamigo){
$tabela = TABELA_CHAT_USUARIO;
$idusuario = retorne_idusuario_logado();
$query = "select *from $tabela where idusuario='$idusuario' and idamigo='$idamigo' and visualizada='0';";
return retorne_numero_linhas_query($query);
};
function retorne_limit_chat(){
$contador_avanco_conteudo = remove_html($_REQUEST['contador_avanco_chat']);
$contador_inicio = $contador_avanco_conteudo;
$contador_fim = $contador_avanco_conteudo + LIMIT_MAX_NUM_USUARIOS_CHAT;
$limit = "limit $contador_inicio, $contador_fim";
return $limit;
};
function retorne_limit_conversas_chat(){
$contador_avanco = remove_html($_REQUEST['contador_avanco_chat']);
$limit = "limit $contador_avanco, 1";
return $limit;
};
function retorne_numero_novas_mensagens_chat($idamigo){
$tabela = TABELA_CHAT_USUARIO;
$idusuario = retorne_idusuario_logado();
$query = "select *from $tabela where idusuario='$idusuario' and idamigo='$idamigo' and visualizada='0';";
return retorne_numero_linhas_query($query);
};
function retorne_usuario_chat(){
session_start();
return $_SESSION[CONFIG_MD5_IDUSUARIO_CHAT];
};
function seta_usuario_chat(){
$idusuario = retorne_idusuario_request();
if($idusuario == retorne_idusuario_logado()){
$idusuario = null;
};
session_start();
$_SESSION[CONFIG_MD5_IDUSUARIO_CHAT] = $idusuario;
};
function usuario_online_offline_chat(){
$idusuario = retorne_idusuario_request();
$usuario_online = retorne_usuario_online($idusuario);
if($usuario_online == true){
$imagem_servidor = retorne_imagem_servidor(23);
}else{
$imagem_servidor = retorne_imagem_servidor(22);
};
$array_retorno['conteudo'] = $imagem_servidor;
$array_retorno['idusuario'] = $idusuario;
$array_retorno['numero_mensagens'] = retorne_tamanho_resultado(retorne_numero_novas_mensagens_chat($idusuario));
return json_encode($array_retorno);
};
function atualiza_conexao_usuario(){
$tabela = TABELA_CONEXAO_USUARIO;
$idusuario = retorne_idusuario_logado();
$data_conexao = retorne_data_atual_conexao();
$query[] = "delete from $tabela where idusuario='$idusuario';";
$query[] = "insert into $tabela values('$idusuario','$data_conexao');";
if($idusuario != null){
executador_querys($query);
};
};
function diferenca_data_conexao($data_comparar){
return strtotime(date('Y/m/d H:i:s')) - strtotime($data_comparar);
};
function retorne_data_atual_conexao(){
return date('Y/m/d H:i:s');
};
function retorne_numero_usuarios_online(){
$tabela = TABELA_CADASTRO;
$query = "select *from $tabela;";
$comando = comando_executa($query);
$contador = 0;
$numero_usuarios_online = 0;
$numero_linhas = retorne_numero_linhas_comando($comando);
for($contador == $contador; $contador <= $numero_linhas; $contador++){
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);
$idusuario = $dados['idusuario'];
if($idusuario != null){
if(retorne_usuario_online($idusuario) == true){
$numero_usuarios_online++;
};
};
};
return $numero_usuarios_online;
};
function retorne_usuario_online($idusuario){
$tabela = TABELA_CONEXAO_USUARIO;
$query = "select *from $tabela where idusuario='$idusuario';";
$dados = retorne_dados_query($query);
$data_conexao = $dados['data_conexao'];
if($data_conexao == null){
return false;
};
$tempo_diferenca = diferenca_data_conexao($data_conexao);
if($tempo_diferenca <= TEMPO_FICAR_OFFLINE){
return true;
}else{
return false;
};
};
function enviar_email($email_destino, $assunto_mensagem, $corpo_mensagem){
$nome_sistema = NOME_SISTEMA;
$cabecalho = "From: $nome_sistema"."\r\n"."Reply-To: $nome_sistema"."\r\n";
mail($email_destino, $assunto_mensagem , $corpo_mensagem, $cabecalho); 
};
function envia_dados_formulario_contato_admin(){
$email_telefone_contato = remove_html($_REQUEST['email_telefone_contato']);
$mensagem_contato = remove_html($_REQUEST['mensagem_contato']);
$corpo_mensagem .= "\n";
$corpo_mensagem .= $email_telefone_contato;
$corpo_mensagem .= "\n";
$corpo_mensagem .= "--------------------";
$corpo_mensagem .= "\n";
$corpo_mensagem .= $mensagem_contato;
$corpo_mensagem .= "\n";
if($email_telefone_contato != null and $mensagem_contato != null){
enviar_email(CONFIG_EMAIL_ADMIN, $email_telefone_contato, $corpo_mensagem);
};
chama_pagina_inicial();
};
function formulario_contato_usuario(){
global $idioma;
global $requeste;
$url_formulario = PAGINA_ACOES;
$codigo_html = "
<div class='classe_div_formulario_contato'>
<form action='$url_formulario' method='post'>
<span>$idioma[116]</span>
<div>
<input type='text' name='email_telefone_contato' placeholder='$idioma[117]' required>
</div>
<div>
<textarea cols='10' rows='5' name='mensagem_contato' placeholder='$idioma[118]' required></textarea>
</div>
<div>
<input type='submit' value='$idioma[119]' class='botao_padrao' onclick=''>
</div>
<input type='hidden' name='$requeste[0]' value='28'>
</form>
</div>
";
return $codigo_html;
};
function constroe_conteudo(){
global $idioma;
global $pagina_href;
$usar_resolucao = retorna_usar_resolucao();
$codigo_html .= "<div class='classe_div_centro_pagina'>";
if(retorne_idpost_request() == null){
$codigo_html .= constroe_slide_show();
if(retorne_termo_pesquisa() == null){
$codigo_html .= constroe_campo_bloco_pagina();
};
if($usar_resolucao == false){
$codigo_html .= campo_opcao_administrador();
};
};
if(retorne_href_get() == null and retorne_idpost_request() == null){
$codigo_html .= constroe_campo_destaque();
};
$codigo_html .= constroe_campo_conteudo_postagem();
$codigo_html .= "</div>";
if($usar_resolucao == false){
$codigo_html .= "<div class='classe_div_menus_principal'>";
$codigo_html .= constroe_perfil_usuario();
$codigo_html .= constroe_campo_administrar();
$codigo_html .= campo_widget();
$codigo_html .= constroe_menu_navegacao_vertical($idioma[106], constroe_links_navegacao_postagens());
$codigo_html .= constroe_chat_usuario();
$codigo_html .= "</div>";
}else{
$codigo_html .= constroe_chat_usuario();
};
if(retorne_idpost_request() != null){
return $codigo_html;
};
switch(retorne_href_get()){
case $idioma[15]:
salvar_cookies(null, null, true);
chama_pagina_especifica($pagina_href[0]);
break;
};
return $codigo_html;
};
function constroe_campo_destaque(){
global $idioma;
$codigo_html = "
<div class='classe_div_campo_destaque_titulo'>
<span>
$idioma[106]
</span>
</div>
<div class='classe_div_campo_destaque' id='id_div_campo_destaque'></div>
";
return $codigo_html;
};
function janela_mensagem_dialogo($titulo_janela, $conteudo_mensagem, $div_id){
$botao_fechar .= "<span class='span_botao_fechar_mensagem_dialogo'>";
$botao_fechar .= "<button class='botao_padrao' onclick='fechar_janela_mensagem_dialogo();'>x</button>";
$botao_fechar .= "</span>";
$codigo_html .= "<div id='$div_id' class='div_janela_principal_mensagem_dialogo' ondblclick='fechar_janela_mensagem_dialogo();'>";
$codigo_html .= "<div class='div_janela_mensagem_dialogo'>";
$codigo_html .= "<div class='div_janela_mensagem_dialogo_titulo'>";
$codigo_html .= $botao_fechar;
$codigo_html .= $titulo_janela;
$codigo_html .= "</div>";
$codigo_html .= "<div class='div_janela_mensagem_conteudo'>";
$codigo_html .= $conteudo_mensagem;
$codigo_html .= "</div>";
$codigo_html .= "</div>";
$codigo_html .= "</div>";
return $codigo_html;
};
function constroe_formulario($conteudo){
$codigo_html = "
<div class='classe_div_formulario'>$conteudo</div>
";
return $codigo_html;
};
function constroe_formulario_barra_progresso($url_envio, $id_formulario, $nome_file, $tipo_pagina, $multiplo, $tipo_arquivo){
global $idioma;
global $requeste;
$numero_nome_funcao = $tipo_arquivo;
switch($tipo_arquivo){
case 1:
$tipo_arquivo = "accept='image/*'";
$texto_botao_enviar = $idioma[48];
$numero_nome_funcao = $id_formulario;
break;
case 2:
$tipo_arquivo = "accept='audio/*'";
$texto_botao_enviar = $idioma[50];
$numero_nome_funcao = $id_formulario;
break;
case 3:
$tipo_arquivo = "accept='video/*'";
$texto_botao_enviar = $idioma[51];
$numero_nome_funcao = $id_formulario;
break;
case 4:
$tipo_arquivo = "accept='image/*'";
$texto_botao_enviar = $idioma[48];
$campo_hidden_extra = "<input type='hidden' name='$requeste[2]' value='$id_formulario'>";
$numero_nome_funcao = $id_formulario;
$id_formulario = "id_formulario_upload_imagem_perfil_funcionario_$id_formulario";
break;
};
$id_porcentagem = md5("porcentagem".$numero_nome_funcao);
$id_campo_file = md5("campo_file".$numero_nome_funcao);
$id_div_progresso = md5("campo_div_progresso".$numero_nome_funcao);
$id_div_botao_upload = md5("campo_botao_upload".$numero_nome_funcao);
if($multiplo == true){
$multiplo = "multiple";
};
$campo_formulario = "
<div class='classe_div_formulario_progresso'>
<form action='$url_envio' method='post' enctype='multipart/form-data' id='$id_formulario'>
<input type='file' id='$id_campo_file' name='$nome_file' onchange='simula_enviar_formulario_barra_progresso_$numero_nome_funcao();' $tipo_arquivo $multiplo>
<div class='classe_exibe_barra_progresso_formulario' id='$id_div_progresso'>
<progress value='0' max='100'></progress>
<span id='$id_porcentagem' class='classe_barra_progresso_formulario_span'>0%</span>
<input type='hidden' name='$requeste[0]' value='$tipo_pagina'>
</div>
$campo_hidden_extra
<div class='classe_div_botao_upload_formulario_progresso' id='$id_div_botao_upload'>
<input type='button' class='botao_padrao' value='$texto_botao_enviar' onclick='simula_clique_file_formulario_barra_progresso_$numero_nome_funcao();'>
</div>
</form> 
</div>
";
$campo_script = "
<script language='javascript'>
$('#$id_formulario').ajaxForm({uploadProgress: function(event, position, total, percentComplete){
$('progress').attr('value',percentComplete);
$('#$id_porcentagem').html(percentComplete+'%');
}, success: function(data){
$('progress').attr('value','100');
$('#$id_porcentagem').html('100%');
$('pre').html(data);
location.reload();
}
});
function simula_clique_file_formulario_barra_progresso_$numero_nome_funcao(){
$('#' + '$id_campo_file').click();
};
function simula_enviar_formulario_barra_progresso_$numero_nome_funcao(){
$('#$id_formulario').submit();
document.getElementById('$id_div_progresso').style.display = 'inline';
document.getElementById('$id_div_botao_upload').style.display = 'none';
};
</script>
";
$codigo_html = "
$campo_formulario
$campo_script
";
return $codigo_html;
};
function converte_data_amigavel($data){
global $semana_idioma;
global $mes_extenso_idioma;
global $idioma;
if($data == null){
return null;
};
$data_explode = explode("-", $data); 
if($data_explode[0] == null or $data_explode[1] == null or $data_explode[2] == null){
return null;
};
$time = mktime(0, 0, 0, $data_explode[1]);
$nome_mes = strftime("%b", $time);
$numero_dia = $data_explode[0];
$mes = $nome_mes; $dia = $data_explode[0]; $ano = $data_explode[2]; 
$dia_semana = date('w', mktime(0,0,0, $data_explode[1], $data_explode[0], $data_explode[2]));
$data_completa = $semana_idioma[$dia_semana]." {$dia} $idioma[303] ".$mes_extenso_idioma[$mes]." $idioma[303] {$ano}";
return $data_completa;
};
function formulario_login(){
global $idioma;
if(retorne_usuario_logado() == true){
return null;
};
$imagem_servidor[0] = retorne_imagem_servidor(28);
$codigo_html = "
<div class='classe_div_formulario_login'>
<div class='classe_div_formulario_login_exibir_campos' onclick='exibe_campos_login_usuario();'>
$imagem_servidor[0]
<span class='classe_div_formulario_login_span'>$idioma[7]</span>
</div>
<div class='classe_div_formulario_login_campos' id='id_div_formulario_login_campos'>
<div class='classe_mensagem_login_cadastro' id='id_mensagem_login_cadastro'></div>
<div class='classe_div_formulario_login_entrada'>
<input type='text' id='id_email_login' placeholder='$idioma[5]' onkeydown='if(event.keyCode == 13){cadastro_usuario();}'>
<input type='password' id='id_senha_login' placeholder='$idioma[6]' onkeydown='if(event.keyCode == 13){cadastro_usuario();}'>
</div>
<div class='classe_div_formulario_login_botoes'>
<input type='button' value='$idioma[4]' class='botao_padrao' onclick='logar_usuario();'>
<span>
$idioma[8]
</span>
<input type='button' value='$idioma[9]' class='botao_cadastro' onclick='cadastro_usuario();'>
</div>
<div class='classe_div_formulario_login_recupera_conta'>
<div>
<a href='#' title='$idioma[158]'>$idioma[158]</a>
</div>
<div class='classe_div_recuperar_senha'>
<input type='text' id='campo_email_recuperar_conta_usuario' placeholder='$idioma[159]' onkeydown='if(event.keyCode == 13){recuperar_conta_usuario();}'>
</div>
</div>
</div>
</div>
";
return $codigo_html;
};
function retorne_href_get(){
global $requeste;
global $idioma;
return remove_html($_REQUEST[$requeste[0]]);
};
function retorne_idusuario_request(){
global $requeste;
$idusuario = remove_html($_REQUEST[$requeste[2]]);
if($idusuario == null){
$idusuario = retorne_idusuario_logado();
};
return $idusuario;
};
function cadastra_funcionario(){
$tabela = TABELA_FUNCIONARIO;
$nome = remove_html($_REQUEST['nome']);
$cargo =  remove_html($_REQUEST['cargo']);
$hora_inicio =  remove_html($_REQUEST['hora_inicio']);
$hora_fim =  remove_html($_REQUEST['hora_fim']);
$hora_pausa_inicio =  remove_html($_REQUEST['hora_pausa_inicio']);
$hora_pausa_fim =  remove_html($_REQUEST['hora_pausa_fim']);
if($nome == null or $cargo == null or $hora_inicio == null or $hora_fim == null or $hora_pausa_inicio == null or $hora_pausa_fim == null){
return -1;
};
$data = data_atual();
$query = "insert into $tabela values(null, '', '', '$nome', '$cargo', '$hora_inicio', '$hora_fim', '$hora_pausa_inicio', '$hora_pausa_fim', '$data');";
comando_executa($query);
};
function carrega_funcionarios(){
global $idioma;
global $requeste;
$tabela = TABELA_FUNCIONARIO;
$id_funcionario = retorne_idfuncionario_request();
$limit_query = retorne_limit();
if($id_funcionario == null){
$query = "select *from $tabela order by id desc $limit_query;";
}else{
$query = "select *from $tabela where id='$id_funcionario';";
};
$dados = retorne_dados_query($query);
$id = $dados['id'];
$url_imagem_perfil = $dados['url_imagem_perfil'];
$nome = $dados['nome'];
$cargo = $dados['cargo'];
$hora_entra = $dados['hora_entra'];
$hora_sai = $dados['hora_sai'];
$hora_pausa_inicio = $dados['hora_pausa_inicio'];
$hora_pausa_fim = $dados['hora_pausa_fim'];
$data = $dados['data'];
if($id == null){
return null;
};
if(retorne_usuario_administrador() == true){
$campo_imagem_perfil = constroe_formulario_barra_progresso(PAGINA_ACOES, $id, "foto", PAGINA_ID20, false, 4);
$url_pagina = PAGINA_INICIAL."?$requeste[0]=$idioma[77]&$requeste[5]=$id";
$imagem_servidor[0] = retorne_imagem_servidor(16);
$campo_excluir_funcionario = "
$idioma[110]
<br>
<br>
<input type='button' value='$idioma[101]' class='botao_padrao' onclick='excluir_funcionario($id);'>
";
$campo_excluir_funcionario = janela_mensagem_dialogo($idioma[110], $campo_excluir_funcionario, "id_dialogo_excluir_funcionario_$id");
$campo_excluir_funcionario .= "
<div class='classe_div_funcionario_excluir'>
<div onclick='dialogo_excluir_funcionario($id);'>$imagem_servidor[0]</div>
</div>
";
if($id_funcionario == null){
$campo_recortar = "
<img src='$url_imagem_perfil' title='$nome'>
<div class='classe_div_funcionario_recorte_imagem'>
<a href='$url_pagina' title='$idioma[109]'>$idioma[109]</a>
</div>
";
}else{
$dados_imagem['id'] = $dados['id'];
$dados_imagem['url_imagem_perfil'] = $dados['url_imagem_perfil'];
$dados_imagem['url_imagem_perfil'] = $dados['url_imagem_perfil'];
$dados_imagem['nome'] = $dados['nome'];
$dados_imagem['tipo_pagina'] = 21;
$dados_imagem['url_pagina'] = PAGINA_ACOES;
$dados_imagem[$requeste[5]] = $id_funcionario;
$campo_recortar = campo_recortar_imagem($dados_imagem);
$campo_recortar = "
<div class='classe_div_funcionario_recorte_imagem'>
$campo_recortar
</div>
";
};
}else{
$campo_recortar = "<img src='$url_imagem_perfil' title='$nome'>";
};
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
return $codigo_html;
};
function dados_perfil_funcionario($id){
$tabela = TABELA_FUNCIONARIO;
$query = "select *from $tabela where id='$id';";
$dados = retorne_dados_query($query);
return $dados;
};
function excluir_funcionario(){
$id_funcionario = retorne_idfuncionario_request();
$tabela = TABELA_FUNCIONARIO;
if($id_funcionario == null or retorne_usuario_administrador() == false){
return null;
};
$dados = dados_perfil_funcionario($id_funcionario);
$url_imagem_perfil_root = $dados['url_imagem_perfil_root'];
exclui_arquivo_unico($url_imagem_perfil_root);
$query = "delete from $tabela where id='$id_funcionario';";
comando_executa($query);
};
function recorta_imagem_funcionario(){
global $pagina_href;
$targ_w[0] = TAMANHO_ESCALA_IMG_PERFIL;
$targ_h[0] = TAMANHO_ESCALA_IMG_PERFIL;
$jpeg_quality = 100;
$src[0] = remove_html($_REQUEST['imagem_grande_url']);
$img_r[0] = imagecreatefromjpeg($src[0]);
$dst_r[0] = ImageCreateTrueColor($targ_w[0], $targ_h[0]);
imagecopyresampled($dst_r[0], $img_r[0], 0, 0, $_POST['x'], $_POST['y'], $targ_w[0], $targ_h[0], $_POST['w'], $_POST['h']);
$dados_imagem = dados_perfil_funcionario(retorne_idfuncionario_request());
$imagem_perfil = $dados_imagem['url_imagem_perfil_root'];
imagejpeg($dst_r[0], $imagem_perfil);
chama_pagina_especifica($pagina_href[27]);
};
function retorne_idfuncionario_request(){
global $requeste;
return remove_html($_REQUEST[$requeste[5]]);
};
function carrega_galeria_imagens(){
global $idioma;
$tabela = TABELA_GALERIA_IMAGENS;
$limit_query = retorne_limit();
$query = "select *from $tabela order by id desc $limit_query;";
$dados = retorne_dados_query($query);
$id = $dados['id'];
$idusuario = $dados['idusuario'];
$conteudo = $dados['conteudo'];
$idalbum = $dados['idalbum'];
$url_imagem = $dados['url_imagem'];
$url_imagem_miniatura = $dados['url_imagem_miniatura'];
$data = $dados['data'];
if($id == null){
return null;
};
$imagem_servidor[0] = retorne_imagem_servidor(16);
if(retorne_usuario_administrador() == true){
$dialogo_excluir = "
$idioma[100]
<br>
<br>
<input type='button' value='$idioma[101]' class='botao_padrao' onclick='excluir_imagem_galeria_imagens($id);'>
";
$dialogo_excluir = janela_mensagem_dialogo($idioma[98], $dialogo_excluir, "id_dialogo_excluir_imagem_galeria_$id");
$campo_gerenciar = "
<div class='classe_div_excluir_elemento_bloco'>
<div onclick='dialogo_excluir_imagem_galeria($id);'>$imagem_servidor[0]</div>
</div>
$dialogo_excluir
";
$conteudo = "
<textarea cols='10' rows='5' id='id_campo_conteudo_descricao_imagem_galeria_$id' placeholder='$idioma[54]' onkeyup='salvar_descricao_imagem_galeria($id);'>$conteudo</textarea>
";
}else{
$conteudo = str_replace("\n", "<br>", $conteudo);
};
$codigo_html .= "
<div class='classe_div_conteudo_bloco' title='$data' id='id_div_conteudo_galeria_imagens_$id'>
$campo_gerenciar
<div class='classe_div_conteudo_bloco_imagem_galeria'>
<a class='fancybox' rel='group' href='$url_imagem'>
<img src='$url_imagem_miniatura'>
</a>
</div>
<div class='classe_div_conteudo_bloco_conteudo'>$conteudo</div>
</div>
";
return $codigo_html;
};
function excluir_imagem_galeria_imagens(){
$tabela = TABELA_GALERIA_IMAGENS;
$id = remove_html($_REQUEST['id']);
$query[0] = "select *from $tabela where id='$id';";
$query[1] = "delete from $tabela where id='$id';";
$dados = retorne_dados_query($query[0]);
comando_executa($query[1]);
$url_imagem_root = $dados['url_imagem_root'];
$url_imagem_miniatura_root = $dados['url_imagem_miniatura_root'];
exclui_arquivo_unico($url_imagem_root);
exclui_arquivo_unico($url_imagem_miniatura_root);
};
function salvar_descricao_imagem_galeria(){
$tabela = TABELA_GALERIA_IMAGENS;
$id = remove_html($_REQUEST['id']);
$conteudo = remove_html($_REQUEST['conteudo']);
$query = "update $tabela set conteudo='$conteudo' where id='$id';";
comando_executa($query);
};
function adiciona_quebra_linha($conteudo){
$conteudo = str_replace("\n", "<br>", $conteudo);
return $conteudo;
};
function chama_pagina_especifica($pagina){
header("Location: $pagina");
};
function cifra_senha_md5($senha){
if($senha != null and strlen($senha) >= TAMANHO_MINIMO_SENHA){
$senha = md5($senha);
};
return $senha;
};
function converte_tag_imagem($conteudo_post){
$conteudo_post = preg_replace('#(http://([^\s]*)\.(jpg|gif|png|jpeg))#', '<a class="fancybox" rel="group" href="$1" target="_blank"><img src="$1" class="imagem_convertida_url" /></a>', $conteudo_post);
$conteudo_post = preg_replace('#(https://([^\s]*)\.(jpg|gif|png|jpeg))#', '<a class="fancybox" rel="group" href="$1" target="_blank"><img src="$1" class="imagem_convertida_url" /></a>', $conteudo_post);
return $conteudo_post;
};
function converte_urls_texto_links($conteudo_post){
$conteudo_post = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a href='$1' title='$1' target='_blank'>$1</a>", $conteudo_post); 
$conteudo_post = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<br><iframe width=\"100%\" height=\"100%\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe><br>",$conteudo_post); 
$conteudo_post = converte_tag_imagem($conteudo_post); 
return $conteudo_post; 
};
function data_atual(){
$data_atual = Date("d-m-Y G:i:s");
return $data_atual;
};
function remove_html($codigo_html){
$codigo_html = addslashes($codigo_html);
$codigo_html = htmlentities($codigo_html);
if(verifica_se_email_valido($codigo_html) == true){
$codigo_html = strtolower($codigo_html);
};
return $codigo_html;
};
function remove_linhas_branco($conteudo){
return preg_replace('/\n\s*\n/', "\n", $conteudo);
};
function retorne_elemento_array_existe($array_pesquisa, $valor_pesquisa){
if($array_pesquisa == null){
return false;
};
foreach($array_pesquisa as $valor_array){
if($valor_array == $valor_pesquisa){
return true;
};
};
return false;
};
function retorne_imagem_servidor($numero){
global $idioma;
global $pagina_href;
global $requeste;
$nome_sistema = NOME_SISTEMA;
$array_titulo_blocos = retorna_array_links_blocos(false);
switch($numero){
case 0:
$url_link = PAGINA_INICIAL;
$titulo = NOME_SISTEMA;
break;
case 1:
$url_link = null;
$titulo = $idioma[48];
break;
case 2:
$url_link = null;
$titulo = $idioma[52];
break;
case 3:
$url_link = null;
$titulo = $idioma[53];
break;
case 4:
$url_link = null;
$titulo = null;
break;
case 5:
$url_link = null;
$titulo = $idioma[55];
break;
case 6:
$url_link = $array_titulo_blocos[0];
$titulo = $idioma[63];
break;
case 7:
$url_link = $array_titulo_blocos[1];
$titulo = $idioma[22];
break;
case 8:
$url_link = $array_titulo_blocos[2];
$titulo = $idioma[23];
break;
case 9:
$url_link = $array_titulo_blocos[3];
$titulo = $idioma[24];
break;
case 10:
$url_link = $array_titulo_blocos[4];
$titulo = $idioma[69];
break;
case 11:
$url_link = $array_titulo_blocos[5];
$titulo = $idioma[26];
break;
case 12:
$url_link = $array_titulo_blocos[6];
$titulo = $idioma[27];
break;
case 13:
$url_link = $array_titulo_blocos[7];
$titulo = $idioma[28];
break;
case 14:
$url_link = $array_titulo_blocos[8];
$titulo = $idioma[29];
break;
case 15:
$url_link = $array_titulo_blocos[9];
$titulo = $idioma[30];
break;
case 16:
$url_link = null;
$titulo = $idioma[98];
break;
case 17:
$url_link = null;
$titulo = $idioma[99];
break;
case 18:
$url_link = null;
$titulo = $idioma[107];
break;
case 19:
$url_link = null;
$titulo = $idioma[113];
break;
case 20:
$url_link = null;
$titulo = null;
$endereco = true;
break;
case 21:
$url_link = null;
$titulo = null;
$endereco = true;
break;
case 22:
$url_link = null;
$titulo = $idioma[141];
break;
case 23:
$url_link = null;
$titulo = $idioma[140];
break;
case 24:
$url_link = null;
$titulo = $idioma[143];
break;
case 25:
$url_link = null;
$titulo = $idioma[147];
break;
case 26:
$url_link = null;
$titulo = $idioma[156];
break;
case 27:
$url_link = null;
$titulo = $idioma[157];
break;
case 28:
$url_link = null;
$titulo = $idioma[4];
break;
};
if($endereco == true){
return PASTA_IMAGENS_SISTEMA."$numero.png";
};
if($url_link == null){
$imagem = "<img src='".PASTA_IMAGENS_SISTEMA."$numero.png"."' title='$titulo' $evento>";
}else{
$imagem = "<img src='".PASTA_IMAGENS_SISTEMA."$numero.png"."' title='$titulo' $evento>";
if($evento == null){
$imagem = "<a href='$url_link' title='$titulo'>$imagem</a>";
};
};
return $imagem;
};
function retorne_tamanho_resultado($numero_resultados){
$tamanho_mil = 1000;
$tamanho_milhao = 1000000;
$tamanho_bilhao = 1000000000;
if($numero_resultados == null){
$numero_resultados = 0;
};
if($numero_resultados == 0){
return 0;
};
$retorno = $numero_resultados;
if($numero_resultados >= $tamanho_mil){
$retorno = round($numero_resultados / $tamanho_mil, 2)."k";
};
if($numero_resultados >= $tamanho_milhao){
$retorno = round($numero_resultados / $tamanho_milhao, 2)."mi";
};
if($numero_resultados >= $tamanho_bilhao){
$retorno = round($numero_resultados / $tamanho_bilhao, 2)."bi";
};
return $retorno;
};
function timer_sistema($segundos, $funcoes_timer){
$segundos *= 1000;
$codigo_md5[0] = "a".md5($segundos.$funcoes_timer);
$codigo_md5[1] = "b".md5($segundos.$funcoes_timer);
$codigo_md5[2] = "c".md5($segundos.$funcoes_timer);
$codigo_html = "
\n
<script language='javascript'>
\n
var $codigo_md5[2] = setInterval(function(){ $codigo_md5[1]() }, $segundos);
\n
function $codigo_md5[1]() {
\n
$codigo_md5[0]();
\n
};
\n
function $codigo_md5[0](){
\n
$funcoes_timer
\n
};
\n
</script>
\n
";
return $codigo_html;
};
function verifica_se_email_valido($email){
$conta = "^[a-zA-Z0-9\._-]+@"; $domino = "[a-zA-Z0-9\._-]+."; $extensao = "([a-zA-Z]{2,4})$"; 
$pattern = $conta.$domino.$extensao;
return ereg($pattern, $email);
};
function campo_seleciona_idioma(){
$codigo_html .= "<div class='classe_div_campo_seleciona_idioma'>";
$codigo_html .= "<div onclick='sessao_idioma_atualizar(1);'>";
$codigo_html .= retorne_imagem_servidor(26);
$codigo_html .= "</div>";
$codigo_html .= "<div onclick='sessao_idioma_atualizar(2);'>";
$codigo_html .= retorne_imagem_servidor(27);
$codigo_html .= "</div>";
$codigo_html .= "</div>";
return $codigo_html;
};
function retorne_idioma_sessao_usuario(){
session_start();
return $_SESSION[IDENTIFICADOR_SESSAO_IDIOMA];
};
function sessao_idioma_atualizar(){
global $idioma_disponivel;
$modo = remove_html($_REQUEST['modo']);
$tempo_vida = time() + (COOKIES_DIAS_EXISTE * 24 * 3600);
switch($modo){
case 1:
$idioma_selecionado = $idioma_disponivel[0];
break;
case 2:
$idioma_selecionado = $idioma_disponivel[1];
break;
default:
$idioma_selecionado = $idioma_disponivel[0];
};
setcookie(IDENTIFICADOR_SESSAO_IDIOMA, $idioma_selecionado, $tempo_vida, "/");
if(retorne_usuario_logado() == false){
return null;
};
$tabela = TABELA_IDIOMA_USUARIO;
$idusuario = retorne_idusuario_logado();
$query[] = "delete from $tabela where idusuario='$idusuario';";
$query[] = "insert into $tabela values('$idusuario', '$idioma_selecionado');";
executador_querys($query);
};
function campo_recortar_imagem($dados){
global $idioma;
global $requeste;
$id = $dados['id'];
$imagem_grande_url = $dados['url_imagem_perfil'];
$imagem_miniatura_url = $dados['url_imagem_perfil'];
$nome_usuario = $dados['nome'];
$tipo_pagina = $dados['tipo_pagina'];
$url_pagina = $dados['url_pagina'];
$id_funcionario = $dados[$requeste[5]];
if($url_pagina == null){
$url_pagina = PAGINA_ACOES;
};
$codigo_html = "
<div class='classe_div_campo_altera_imagem_perfil'>
<div class='classe_div_pre_visualiza_imagem_perfil_recortar' id='id_div_pre_visualiza_imagem_perfil'>
<img src='$imagem_grande_url' title='$nome_usuario' id='cropbox'>
</div>
<div class='classe_div_formulario_recorte_imagem_grande_url'>
<form action='$url_pagina' method='post' enctype='multipart/form-data' onsubmit='return checkCoords();'>
<input type='hidden' id='x' name='x'>
<input type='hidden' id='y' name='y'>
<input type='hidden' id='w' name='w'>
<input type='hidden' id='h' name='h'>
<input type='hidden' value='$id' name='$requeste[2]'>
<input type='hidden' value='$imagem_grande_url' name='imagem_grande_url'>
<input type='hidden' value='$imagem_miniatura_url' name='imagem_miniatura_url'>
<input type='hidden' name='$requeste[0]' value='$tipo_pagina'>
<input type='hidden' value='' name='endereco_imagem_grande_url_upload' id='id_endereco_imagem_grande_url_upload'>
<input type='hidden' value='$id_funcionario' name='$requeste[5]'>
<input type='submit' value='$idioma[108]' class='botao_padrao'>
</form>
</div>
</div>
";
return $codigo_html;
};
function recorta_imagem_perfil_usuario(){
$targ_w[0] = TAMANHO_IMG_PERFIL_RECORTAR_LARGURA;
$targ_h[0] = TAMANHO_IMG_PERFIL_RECORTAR_ALTURA;
$targ_w[1] = TAMANHO_IMG_PERFIL_RECORTAR_LARGURA_MIN;
$targ_h[1] = TAMANHO_IMG_PERFIL_RECORTAR_ALTURA_MIN;
$jpeg_quality = 100;
$src[0] = remove_html($_REQUEST['imagem_perfil']);
$img_r[0] = imagecreatefromjpeg($src[0]);
$dst_r[0] = ImageCreateTrueColor($targ_w[0], $targ_h[0]);
imagecopyresampled($dst_r[0], $img_r[0], 0, 0, $_POST['x'], $_POST['y'], $targ_w[0], $targ_h[0], $_POST['w'], $_POST['h']);
$src[1] = remove_html($_REQUEST['imagem_perfil']);
$img_r[1] = imagecreatefromjpeg($src[1]);
$dst_r[1] = ImageCreateTrueColor($targ_w[1], $targ_h[1]);
imagecopyresampled($dst_r[1], $img_r[1], 0, 0, $_POST['x'], $_POST['y'], $targ_w[1], $targ_h[1], $_POST['w'], $_POST['h']);
$dados_imagem = retorne_imagem_perfil_usuario_root();
$imagem_perfil = $dados_imagem['imagem_perfil'];
$imagem_perfil_miniatura = $dados_imagem['imagem_perfil_miniatura'];
imagejpeg($dst_r[0], $imagem_perfil);
imagejpeg($dst_r[1], $imagem_perfil_miniatura);
chama_pagina_inicial();
};
function logar_usuario(){
global $idioma;
$email = remove_html($_REQUEST['email']);
$senha = remove_html($_REQUEST['senha']);
$senha = cifra_senha_md5($senha);
$tabela = TABELA_CADASTRO;
$query = "select *from $tabela where email='$email' and senha='$senha';";
if(retorne_numero_linhas_query($query) == 1){
salvar_cookies($email, $senha, false);
return true;
}else{
salvar_cookies(null, null, true);
return mensagem_sistema($idioma[13]);
};
};
function retorne_usuario_logado(){
$email = retorne_email_cookie();
$senha = retorne_senha_cookie();
$tabela = TABELA_CADASTRO;
$query = "select *from $tabela where email='$email' and senha='$senha';";
if(retorne_numero_linhas_query($query) == 1 and $email != null and $senha != null){
return true;
}else{
return false;	
};
};
function mensagem_sistema($mensagem){
$codigo_html .= "<div class='classe_div_mensagem_sistema'>";
$codigo_html .= $mensagem;
$codigo_html .= "</div>";
return $codigo_html;
};
function mensagem_sistema_sucesso($mensagem){
$codigo_html .= "<div class='classe_div_mensagem_sistema_sucesso'>";
$codigo_html .= $mensagem;
$codigo_html .= "</div>";
return $codigo_html;
};
function constroe_links_menu_vertical($link){
foreach($link as $link_url){
if($link_url != null){
$codigo_html .= $link_url;
};
};
return $codigo_html;
};
function constroe_menu_navegacao_topo(){
$array_titulo_blocos = retorna_array_links_blocos(true);
$codigo_html = "
<div class='classe_div_menu_navegacao_topo'>
<div class='classe_div_menu_navegacao_topo_centro'>
$array_titulo_blocos[1]
$array_titulo_blocos[2]
$array_titulo_blocos[4]
$array_titulo_blocos[5]
$array_titulo_blocos[6]
$array_titulo_blocos[7]
$array_titulo_blocos[9]
</div>
</div>
";
return $codigo_html;
};
function constroe_menu_navegacao_vertical($titulo, $conteudo){
global $idioma;
$codigo_html = "
<div class='classe_div_menus_vertical'>
<div class='classe_div_titulo_menu_vertical'>
$titulo
</div>
<div class='classe_menu_vertical_menus'>
$conteudo
</div>
</div>
";
return $codigo_html;
};
function chama_pagina_inicial(){
$index = URL_SERVIDOR;
header("Location: $index");
die;
};
function constroe_conteudo_pagina(){
global $idioma;
$conteudo_pagina = constroe_conteudo();
$codigo_html .= "<div class='div_conteudo_pagina'>";
$codigo_html .= $conteudo_pagina;
$codigo_html .= "</div>";
return $codigo_html;
};
function constroe_dependencias_timer(){
$codigo_html = "
\n
carregar_slideshow();
\n
\n
\n
\n
\n
\n
";
$codigo_html = timer_sistema(10, $codigo_html);
return $codigo_html;
};
function constroe_rodape_pagina(){
global $idioma;
$codigo_html .= "<div class='div_rodape_pagina'>";
$codigo_html .= constroe_conteudo_rodape();
$codigo_html .= "</div>";
return $codigo_html;
};
function constroe_tag_body(){
$codigo_html .= "<body onmousemove='' onkeydown=''>";
return $codigo_html;
};
function constroe_topo_pagina(){
global $idioma;
$pagina_inicial = PAGINA_INICIAL;
$nome_sistema = NOME_SISTEMA;
$logotipo_topo .= "<div class='classe_div_logotipo_topo'>";
$logotipo_topo .= retorne_imagem_servidor(0);
$logotipo_topo .= "</div>";
$codigo_html .= "<div class='div_topo_pagina'>";
$codigo_html .= campo_cadastro_topo();
$codigo_html .= $logotipo_topo;
$codigo_html .= campo_pesquisa();
$codigo_html .= "</div>";
return $codigo_html;
};
function constroe_variaveis_js_pagina(){
global $requeste;
$url_pagina_acoes = PAGINA_ACOES;
$href_pagina = retorne_href_get();
$id_funcionario = retorne_idfuncionario_request();
$limit_chat_usuario = LIMIT_MAX_NUM_USUARIOS_CHAT;
$limit_chat_conversas = CONFIG_LIMIT_CONVERSAS_CHAT;
$termo_pesquisa = retorne_termo_pesquisa();
$largura_atual_sistema = TAMANHO_RESOLUCAO_PADRAO;
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
return $codigo_html;
};
function monta_pagina(){
global $idioma;
$usar_resolucao = retorna_usar_resolucao();
$autor_pagina = DESENVOLVEDOR_SISTEMA_AUTOR;
$dependencia[0] = "<script type='text/javascript' src='".ARQUIVO_JQUERY."'></script>";
$dependencia[1] = "<link rel='stylesheet' type='text/css' href='".ARQUIVO_CSS_HOST."'/>";
$dependencia[2] = "<script type='text/javascript' src='".ARQUIVO_JQUERY_FORM."'></script>";
$dependencia[3] = "<script type='text/javascript' src='".ARQUIVO_JS_HOST."'></script>";
$dependencia[4] = "<script type='text/javascript' src='".ARQUIVO_JQUERY_PAGINACAO."'></script>";
$dependencia[5] = "<link rel='stylesheet' type='text/css' href='".ARQUIVO_CSS_PERSONALIZADO."'/>";
$dependencia[6] = "<link rel='stylesheet' type='text/css' href='".ARQUIVO_CSS_RESOLUCAO."'/>";
if($usar_resolucao == false){
$dependencia[6] = null;
};
$titulo_pagina = retorna_titulo_pagina();
$metas_pagina .= "<meta charset='UTF-8'>";
$metas_pagina .= "<meta name='viewport' content='width=device-width'/>";
$metas_pagina .= "<meta name='description' content='$idioma[0]'>";
$metas_pagina .= "<meta name='keywords' content='$idioma[1]'>";
$metas_pagina .= "<meta name='author' content='$autor_pagina'>";
$codigo_html .= "<html>";
$codigo_html .= "<head>";
$codigo_html .= "<title>$titulo_pagina</title>";
$codigo_html .= $dependencia[0];
$codigo_html .= $dependencia[1];
$codigo_html .= $dependencia[2];
$codigo_html .= $dependencia[5];
$codigo_html .= $dependencia[6];
$codigo_html .= $metas_pagina;
$codigo_html .= constroe_recursos_head();
$codigo_html .= constroe_variaveis_js_pagina();
$codigo_html .= "</head>";
$codigo_html .= constroe_tag_body();
$codigo_html .= constroe_topo_pagina();
$codigo_html .= constroe_menu_navegacao_topo();
$codigo_html .= "<div class='classe_div_principal_pagina'>";
$codigo_html .= constroe_conteudo_pagina();
$codigo_html .= "</div>";
$codigo_html .= constroe_rodape_pagina();
$codigo_html .= "</body>";
$codigo_html .= $dependencia[3];
$codigo_html .= $dependencia[4];
$codigo_html .= constroe_dependencias_timer();
$codigo_html .= scripts_js_carregar_onload();
$codigo_html .= carrega_recursos_cabecalho();
$codigo_html .= carregar_atualizacoes_jquery();
$codigo_html .= carregar_atualizacoes_jquery_longo();
$codigo_html .= "</html>";
$codigo_html = remove_linhas_branco($codigo_html);
return $codigo_html;
};
function retorna_titulo_pagina(){
global $idioma;
switch(retorne_href_get()){
case $idioma[31]:
$titulo_pagina = $idioma[19]." - ".NOME_SISTEMA;
break;
case $idioma[32]:
$titulo_pagina = $idioma[47]." - ".NOME_SISTEMA;
break;
case $idioma[34]:
$titulo_pagina = $idioma[22]." - ".NOME_SISTEMA;
break;
case $idioma[35]:
$titulo_pagina = $idioma[23]." - ".NOME_SISTEMA;
break;
case $idioma[37]:
$titulo_pagina = $idioma[25]." - ".NOME_SISTEMA;
break;
case $idioma[38]:
$titulo_pagina = $idioma[26]." - ".NOME_SISTEMA;
break;
case $idioma[39]:
$titulo_pagina = $idioma[27]." - ".NOME_SISTEMA;
break;
case $idioma[40]:
$titulo_pagina = $idioma[28]." - ".NOME_SISTEMA;
break;
case $idioma[42]:
$titulo_pagina = $idioma[30]." - ".NOME_SISTEMA;
break;
case $idioma[73]:
$titulo_pagina = $idioma[22]." - ".NOME_SISTEMA;
break;
case $idioma[74]:
$titulo_pagina = $idioma[23]." - ".NOME_SISTEMA;
break;
case $idioma[76]:
$titulo_pagina = $idioma[69]." - ".NOME_SISTEMA;
break;
case $idioma[77]:
$titulo_pagina = $idioma[26]." - ".NOME_SISTEMA;
break;
case $idioma[78]:
$titulo_pagina = $idioma[27]." - ".NOME_SISTEMA;
break;
case $idioma[79]:
$titulo_pagina = $idioma[28]." - ".NOME_SISTEMA;
break;
case $idioma[81]:
$titulo_pagina = $idioma[30]." - ".NOME_SISTEMA;
break;
default:
$titulo_pagina = NOME_SISTEMA;
};
if(retorne_idpost_request() != null){
$titulo_pagina = retorna_titulo_postagem_idpost(retorne_idpost_request())." - ".NOME_SISTEMA;;
};
return $titulo_pagina;
};
function scripts_js_carregar_onload(){
$codigo_html .= "
\n
<script>
\n
carregar_slideshow();
\n
constroe_lista_usuarios_chat();
\n
detecta_resolucao_pagina();
\n
</script>
\n
";
return $codigo_html;
};
function campo_pesquisa(){
global $idioma;
global $requeste;
$url_formulario = PAGINA_INICIAL;
$codigo_html = "
<div class='classe_div_pesquisa'>
<form action='$url_formulario' method='get'>
<input type='text' name='$requeste[1]' placeholder='$idioma[148]' value=''>
</form>
</div>
";
return $codigo_html;
};
function retorne_termo_pesquisa(){
global $requeste;
return remove_html($_REQUEST[$requeste[1]]);
};
function adicionar_imagens_publicacao(){
upload_imagens_album();
};
function atualizar_publicacao(){
$idpost = retorne_idpost_request();
$titulo = remove_html($_REQUEST['titulo']);
$conteudo = remove_html($_REQUEST['conteudo']);
$tabela = TABELA_PUBLICACOES;
if($idpost == null or retorne_usuario_administrador() == false){
return null;
};
$query = "update $tabela set titulo='$titulo', conteudo='$conteudo' where id='$idpost';";
comando_executa($query);
};
function campo_opcoes_publicacao($dados){
global $idioma;
if(retorne_usuario_administrador() == false){
return null;
};
$id = $dados['id'];
$idusuario = $dados['idusuario'];
$titulo = $dados['titulo'];
$conteudo = $dados['conteudo'];
$idalbum = $dados['idalbum'];
$data = $dados['data'];
$campo_excluir = "
$idioma[111]
<br>
<br>
<input type='button' class='botao_padrao' value='$idioma[101]' onclick='excluir_publicacao($id);'>
";
$campo_excluir = janela_mensagem_dialogo($idioma[111], $campo_excluir, "id_dialogo_excluir_publicacao_$id");
$imagem_servidor[0] = retorne_imagem_servidor(16);
$codigo_html = "
<div class='classe_div_opcoes_publicacao'>
<div onclick='dialogo_excluir_publicacao($id);'>$imagem_servidor[0]</div>
</div>
$campo_excluir
";
return $codigo_html;
};
function carrega_publicacoes_miniatura(){
$tabela = TABELA_PUBLICACOES;
$limit = retorne_limit();
$termo_pesquisa = retorne_termo_pesquisa();
if($termo_pesquisa != null){
$query = "select *from $tabela where titulo like '%$termo_pesquisa%' or conteudo like '%$termo_pesquisa%' order by id desc $limit";
}else{
$query = "select *from $tabela order by id desc $limit";
};
$comando = comando_executa($query);
$numero_linhas = retorne_numero_linhas_comando($comando);
$contador = 0;
for($contador == $contador; $contador <= $numero_linhas; $contador++){
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);
$id = $dados['id'];
$idusuario = $dados['idusuario'];
$titulo = $dados['titulo'];
$conteudo = $dados['conteudo'];
$idalbum = $dados['idalbum'];
$data = $dados['data'];
$conteudo = adiciona_quebra_linha($conteudo);
$titulo_link = constroe_link_publicacao_idpost($id, $titulo, $titulo);
$url_imagem_album = retorne_ultima_imagem_idalbum($idalbum, false);
if($url_imagem_album != null){
$imagem_post = "<img src='$url_imagem_album' title='$titulo'>";
}else{
$imagem_post = retorne_imagem_servidor(4);
};
$imagem_post = constroe_link_publicacao_idpost($id, $titulo, $imagem_post);
if($id != null){
$conteudo = html_entity_decode($conteudo);
$codigo_html .= "
<div class='classe_publicacao_miniatura'>
<div class='classe_publicacao_miniatura_imagem'>
$imagem_post 
</div>
<div class='classe_publicacao_miniatura_titulo'>
$titulo_link
</div>
<div class='classe_publicacao_miniatura_conteudo'>
$conteudo
</div>
</div>
";	
};
};
return $codigo_html;
};
function constroe_campo_conteudo_postagem(){
global $idioma;
global $requeste;
$idpost = retorne_idpost_request();
$tabela = TABELA_PUBLICACOES;
$query = "select *from $tabela where id='$idpost';";
$dados = retorne_dados_query($query);
$id = $dados['id'];
$idusuario = $dados['idusuario'];
$titulo = $dados['titulo'];
$conteudo = $dados['conteudo'];
$idalbum = $dados['idalbum'];
$data = $dados['data'];
if($id == null){
return null;
};
$conteudo = adiciona_quebra_linha($conteudo);
$imagens = constroe_imagens_publicacao($idalbum);
$campo_opcoes = campo_opcoes_publicacao($dados);
$usuario_administrador = retorne_usuario_administrador();
if($usuario_administrador == true){
$conteudo = str_replace("<br>", "&#13;", $conteudo);
$campo_titulo = "
<input type='text' value='$titulo' placeholder='$idioma[43]' id='id_publicacao_titulo_$id'>
";
$campo_conteudo = "
<textarea cols='10' rows='5' placeholder='$idioma[44]' id='id_publicacao_conteudo_$id'>$conteudo</textarea>
";
session_start();
$_SESSION[$requeste[6]] = $idalbum;
$campo_upload_imagens .= $imagens;
$campo_upload_imagens .= constroe_formulario_barra_progresso(PAGINA_ACOES, $id, "fotos[]", 24, true, 1);
$campo_salvar = "
<div class='classe_div_atualizar_publicacao_salvar'>
<input type='button' value='$idioma[112]' class='botao_padrao' onclick='atualizar_publicacao($id);'>
</div>
";
}else{
$conteudo = html_entity_decode($conteudo);
$campo_titulo = $titulo;	
$campo_conteudo = $conteudo;
$campo_upload_imagens = $imagens;
};
if($usuario_administrador == false){
$campo_compartilhar[0] = campo_media_social_compartilhar();
};
$dados_autor = dados_perfil_usuario($idusuario);
$nome_autor = $dados_autor['nome'];
$url_imagem_perfil_miniatura = $dados_autor['url_imagem_perfil_miniatura'];
$endereco = $dados_autor['endereco'];
$cidade = $dados_autor['cidade'];
$estado = $dados_autor['estado'];
$telefone = $dados_autor['telefone'];
$campo_autor = "
<div class='classe_div_autor_publicacao'>
$idioma[163]$nome_autor
<span>$idioma[133]: $endereco - $cidade - $estado</span>
<span>$idioma[136]: $telefone</span>
</div>
";
$codigo_html = "
<div class='classe_div_campo_postagem'>
$campo_opcoes
<div class='classe_titulo_postagem'>
$campo_titulo
</div>
<div class='classe_conteudo_postagem'>
$campo_conteudo
</div>
<div class='classe_imagens_postagem'>
$campo_upload_imagens
</div>
$campo_autor
$campo_salvar
$campo_compartilhar[0]
</div>
";
return $codigo_html;
};
function constroe_campo_publicar(){
global $idioma;
global $requeste;
$url_formulario = PAGINA_ACOES;
$codigo_html = "
<div class='classe_div_campo_publicar'>
<form action='$url_formulario' method='post' enctype='multipart/form-data'>
<div class='classe_div_campo_publicar_titulo'>
<input type='text' name='titulo' placeholder='$idioma[43]'>
</div>
<div class='classe_div_campo_publicar_conteudo'>
<textarea cols='10' rows='10' placeholder='$idioma[44]' name='conteudo'></textarea>
</div>
<div class='classe_div_publicar_imagens'>
<input type='hidden' name='$requeste[0]' value='3'>
<input type='file' name='fotos[]' id='elemento_file_campo_publicar' class='campo_file_upload' multiple onchange='visualizar_imagens_upload_postagem();'>
<input type='button' class='botao_cadastro' value='$idioma[46]' onclick='seleciona_imagens_publicacao_usuario();'>
<div class='classe_div_imagens_pre_publicacao' id='div_imagens_pre_publicacao'></div>
</div>
<div class='classe_div_campo_publicar_opcoes'>
<input type='submit' value='$idioma[45]' class='botao_padrao'>
</div>
</form>
</div>
";
return $codigo_html;
};
function constroe_imagens_publicacao($idalbum){
global $idioma;
$tabela = TABELA_IMAGENS_ALBUM;
$query = "select *from $tabela where idalbum='$idalbum' order by id desc;";
$contador = 0;
$comando = comando_executa($query);
$numero_linhas = retorne_numero_linhas_comando($comando);
$usuario_administrador = retorne_usuario_administrador();
$imagem_servidor[0] = retorne_imagem_servidor(16);
for($contador == $contador; $contador <= $numero_linhas; $contador++){
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);
$id = $dados['id'];
$url_imagem = $dados['url_imagem'];
$url_imagem_miniatura = $dados['url_imagem_miniatura'];
if($url_imagem_miniatura != null){
if($usuario_administrador == true){
$campo_dialogo_excluir = "
$idioma[114]
<br>
<br>
<input type='button' value='$idioma[101]' class='botao_padrao' onclick='excluir_imagem_publicacao($id);'>
";
$campo_dialogo_excluir = janela_mensagem_dialogo($idioma[114], $campo_dialogo_excluir, "dialogo_excluir_imagem_publicacao_$id");
$campo_gerenciar_imagem = "
<div>
<span class='classe_span_opcao_publicacao' onclick='dialogo_excluir_imagem_publicacao($id);'>$imagem_servidor[0]</span>
</div>
";
};
$codigo_html .= "
<div class='classe_div_imagem_publicacao' id='div_imagem_publicacao_$id'>
$campo_gerenciar_imagem
<a class='fancybox' rel='group' href='$url_imagem'>
<img src='$url_imagem_miniatura'>
</a>
</div>
$campo_dialogo_excluir
";
};
};
return $codigo_html;
};
function constroe_links_navegacao_postagens(){
$tabela = TABELA_PUBLICACOES;
$query = "select *from $tabela order by id desc;";
$comando = comando_executa($query);
$numero_linhas = retorne_numero_linhas_comando($comando);
$contador = 0;
for($contador == $contador; $contador <= $numero_linhas; $contador++){
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);
$id = $dados['id'];
$idusuario = $dados['idusuario'];
$titulo = $dados['titulo'];
$conteudo = $dados['conteudo'];
$idalbum = $dados['idalbum'];
$data = $dados['data'];
$link_post = constroe_link_publicacao_idpost($id, $titulo, $titulo);
if($id != null){
$codigo_html .= "
$link_post
";
};
};
return $codigo_html;
};
function constroe_link_publicacao_idpost($id, $titulo, $conteudo){
global $requeste;
$url_pagina_inicial = PAGINA_INICIAL;
$codigo_html = "<a href='$url_pagina_inicial?$requeste[4]=$id' title='$titulo'>$conteudo</a>";
return $codigo_html;
};
function excluir_imagem_publicacao(){
$tabela = TABELA_IMAGENS_ALBUM;
$id = remove_html($_REQUEST['id']);
if($id == null or retorne_usuario_administrador() == false){
return null;
};
$query[0] = "select *from $tabela where id='$id';";
$query[1] = "delete from $tabela where id='$id';";
$dados = retorne_dados_query($query[0]);
$pasta_usuario = retorne_pasta_usuario($dados['idusuario'], 2, true);
$url_imagem = $pasta_usuario.basename($dados['url_imagem']);
$url_imagem_miniatura = $pasta_usuario.basename($dados['url_imagem_miniatura']);
exclui_arquivo_unico($url_imagem);
exclui_arquivo_unico($url_imagem_miniatura);
comando_executa($query[1]);
};
function excluir_publicacao(){
if(retorne_usuario_administrador() == false){
return null;
};
$tabela[0] = TABELA_PUBLICACOES;
$tabela[1] = TABELA_IMAGENS_ALBUM;
$idpost = retorne_idpost_request();
$query[0] = "select *from $tabela[0] where id='$idpost';";
$dados = retorne_dados_query($query[0]);
$idusuario = $dados['idusuario'];
$idalbum = $dados['idalbum'];
$query[1] = "select *from $tabela[1] where idalbum='$idalbum';";
$comando = comando_executa($query[1]);
$contador = 0;
$numero_linhas = retorne_numero_linhas_comando($comando);
$pasta_usuario = retorne_pasta_usuario($idusuario, 2, true);
for($contador == $contador; $contador <= $numero_linhas; $contador++){
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);
$url_imagem = $pasta_usuario.basename($dados['url_imagem']);
$url_imagem_miniatura = $pasta_usuario.basename($dados['url_imagem_miniatura']);
exclui_arquivo_unico($url_imagem);
exclui_arquivo_unico($url_imagem_miniatura);
};
$query[0] = "delete from $tabela[0] where id='$idpost';";
$query[1] = "delete from $tabela[1] where idalbum='$idalbum';";
comando_executa($query[0]);
comando_executa($query[1]);
};
function publicar_conteudo(){
global $requeste;
$titulo = remove_html($_REQUEST['titulo']);
$conteudo = remove_html($_REQUEST['conteudo']);
session_start();
$_SESSION[$requeste[6]] = null;
if($titulo == null){
return null;
};
$idusuario = retorne_idusuario_logado();
$tabela = TABELA_PUBLICACOES;
$data = data_atual();
$idalbum = upload_imagens_album();
$query = "insert into $tabela values(null ,'$idusuario', '$titulo', '$conteudo', '$idalbum', '$data');";
comando_executa($query);
};
function retorna_titulo_postagem_idpost($idpost){
$tabela = TABELA_PUBLICACOES;
$query = "select *from $tabela where id='$idpost';";
$dados = retorne_dados_query($query);
return $dados['titulo'];
};
function retorne_idpost_request(){
global $requeste;
return remove_html($_REQUEST[$requeste[4]]);
};
function retorne_ultima_imagem_idalbum($idalbum, $modo){
$tabela = TABELA_IMAGENS_ALBUM;
$query = "select *from $tabela where idalbum='$idalbum' order by id desc limit 1;";
$dados = retorne_dados_query($query);
if($modo == true){
return $dados['url_imagem'];
}else{
return $dados['url_imagem_miniatura'];
};
};
function comando_executa($query){
if($query{strlen($query) - 1} != ";"){
$query .= ";";
};
if($query != null){
$comando = mysql_query($query);
}else{
return null;
};
return $comando;
};
function conecta_mysql($seleciona_banco){
$conexao = mysql_connect(SERVIDOR_MYSQL, USUARIO_MYSQL, SENHA_MYSQL);
if($seleciona_banco == true){
mysql_select_db(BANCO_DADOS);
};
return $conexao;
};
function executador_querys($querys_array){
foreach($querys_array as $query_executar){
comando_executa($query_executar);
};
};
function query_executa($query){
mysql_query($query);
};
function retorne_contador_query(){
return remove_html($_REQUEST['contador_avanco_conteudo']);
};
function retorne_dados_query($query){
$comando = comando_executa($query);
$dados = mysql_fetch_array($comando, MYSQL_ASSOC);
return $dados;
};
function retorne_limit(){
$contador_avanco = remove_html($_REQUEST['contador_avanco_conteudo']);
if($contador_avanco == null){
$contador_avanco = 0;
};
$contador_inicio = $contador_avanco;
$contador_fim = 1;
$limit = "limit $contador_inicio, $contador_fim";
return $limit;
};
function retorne_numero_linhas_comando($comando){
if($comando == null){
return 0;
};
return mysql_num_rows($comando);
};
function retorne_numero_linhas_query($query){
$comando = comando_executa($query);
return retorne_numero_linhas_comando($comando);
};
function seleciona_banco($banco_dados){
mysql_select_db($banco_dados);
};
function campo_media_social_compartilhar(){
$url_atual = URL_SERVIDOR.$_SERVER['REQUEST_URI'];
$campo_twitter = "
<a class='twitter-follow-button'
  href='https://twitter.com/TwitterDev'>
Follow @TwitterDev</a>
";
$codigo_html = "
<br>
<br>
<div class='fb-share-button'></div>
<br>
<br>
<div class='fb-like'></div>
<br>
$campo_twitter
<br>
<div class='fb-comments' data-href='$url_atual' data-numposts='30'></div>
<br>
<br>
";
return $codigo_html;
};
function carregar_atualizacoes_jquery(){
global $idioma;
if(retorne_usuario_logado() == false){
};
$tempo_timer = CONFIG_TIMER;
$campo_conexao = "
\n
atualiza_conexao_usuario();
\n
";
$campo_chat = "
\n
carrega_atualizacoes_chat();
\n
";
$codigo_html .= "
<script>
\n
var variavelTempoAtualizador = setInterval(function(){ AtualizadorTimer() }, $tempo_timer);
\n
function AtualizadorTimer() {
\n
carregar_atualizacoes_jquery();
\n
};
\n
\n
function carregar_atualizacoes_jquery(){
\n
$campo_conexao
$campo_chat
detecta_resolucao_pagina();
\n
\n
};
\n
</script>
\n
";
return $codigo_html;
};
function carregar_atualizacoes_jquery_longo(){
global $idioma;
if(retorne_usuario_logado() == false){
};
$tempo_timer = CONFIG_TIMER_LONGO;
$campo_chat = "
\n
constroe_lista_usuarios_chat();
\n
usuario_online_offline_chat();
\n
";
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
$campo_chat
\n
};
\n
</script>
\n
";
return $codigo_html;
};
function carrega_recursos_cabecalho(){
$codigo_html .= fancybox();
$codigo_html .= jcrop();
return $codigo_html;
};
function constroe_recursos_head(){
$campo_facebook = "
<div id='fb-root'></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = '//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.4';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
";
$campo_twitter = "
<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = 'https://platform.twitter.com/widgets.js';
  fjs.parentNode.insertBefore(js, fjs);
 
  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };
 
  return t;
}(document, 'script', 'twitter-wjs'));</script>
";
$codigo_html = "
$campo_facebook
$campo_twitter
\n
";
return $codigo_html;
};
function fancybox(){
$pasta_recurso = PASTA_RECURSOS."fancybox/";
$script[0] = $pasta_recurso."jquery.fancybox.css";
$script[1] = $pasta_recurso."jquery.fancybox.js";
$codigo_html .= "<link rel='stylesheet' href='$script[0]' type='text/css' media='screen'/>";
$codigo_html .= "<script type='text/javascript' src='$script[1]'></script>";
$codigo_html .= "\n";
$codigo_html .= "<script type='text/javascript'>";
$codigo_html .= "$(document).ready(function(){";
$codigo_html .= "$('.fancybox').fancybox();";
$codigo_html .= "});";
$codigo_html .= "</script>";
$codigo_html .= "\n";
return $codigo_html;
};
function jcrop(){
if(retorne_usuario_logado() == false){
return null;
};
$pasta_recurso = PASTA_RECURSOS."jcrop/";
$script[0] = $pasta_recurso."jquery.Jcrop.min.css";
$script[1] = $pasta_recurso."jquery.color.js";
$script[2] = $pasta_recurso."jquery.Jcrop.min.js";
$campo_script = "
<script language='javascript'>
$(function(){
$('#cropbox').Jcrop({aspectRatio: 0.75, onSelect: updateCoords, boxWidth: 310, boxHeight: 310});
});
function updateCoords(c){
$('#x').val(c.x);
$('#y').val(c.y);
$('#w').val(c.w);
$('#h').val(c.h);
};
function checkCoords(){
if(document.getElementById('w').value.length == 0){
return false;
};
};
</script>
";
$codigo_html = "
\n
<link rel='stylesheet' href='$script[0]' type='text/css' media='screen'/>
\n
<script type='text/javascript' src='$script[1]'></script>
\n
<script type='text/javascript' src='$script[2]'></script>
\n
$campo_script
\n
";
return $codigo_html;
};
function detecta_resolucao_pagina(){
$largura_nova = remove_html($_REQUEST['largura']);
$largura_atual = $_SESSION[DETECTOR_SESSAO_TAMANHO_RESOLUCAO];
session_start();
if($largura_atual == null){
$largura_atual = TAMANHO_RESOLUCAO_PADRAO;
$_SESSION[DETECTOR_SESSAO_TAMANHO_RESOLUCAO] = TAMANHO_RESOLUCAO_PADRAO;
};
if($largura_atual < TAMANHO_RESOLUCAO_PADRAO){
$_SESSION[USAR_RESOLUCAO_SISTEMA] = true;
}else{
$_SESSION[USAR_RESOLUCAO_SISTEMA] = false;
};
if($largura_nova != $largura_atual){
$_SESSION[DETECTOR_SESSAO_TAMANHO_RESOLUCAO] = $largura_nova;
return 1;
}else{
return -1;	
};
};
function retorna_usar_resolucao(){
session_start();
return $_SESSION[USAR_RESOLUCAO_SISTEMA];
};
function constroe_conteudo_rodape(){
global $idioma;
$nome_desenvolvedor = DESENVOLVEDOR_SISTEMA;
$nome_sistema = NOME_SISTEMA;
$localizacao = LOCALIZACAO;
$ano_atual = Date("Y");;
$codigo_html = "
<div class='classe_div_conteudo_rodape'>
<div>$idioma[120]$nome_desenvolvedor</div>
<div>$idioma[121]$nome_sistema - $ano_atual</div>
<div>$localizacao</div>
</div>
";
return $codigo_html;
};
function retorne_email_cookie(){
return retorne_valor_cookie(CONFIG_NOME_COOKIE_EMAIL);
};
function retorne_senha_cookie(){
return retorne_valor_cookie(CONFIG_NOME_COOKIE_SENHA);
};
function retorne_valor_cookie($nome_cookie){
return $_COOKIE[$nome_cookie];
};
function salvar_cookies($email, $senha, $limpa){
session_start();
$tempo_vida = time() + (COOKIES_DIAS_EXISTE * 24 * 3600);
setcookie(CONFIG_NOME_COOKIE_EMAIL, $email, $tempo_vida, "/");
setcookie(CONFIG_NOME_COOKIE_SENHA, $senha, $tempo_vida, "/");
$_SESSION[CONFIG_NOME_COOKIE_EMAIL] = $email;
$_SESSION[CONFIG_NOME_COOKIE_SENHA] = $senha;
if($limpa == true){
$_SESSION = array();
@session_destroy();
};
};
function atualizar_descricao_imagem_slideshow(){
$id = remove_html($_REQUEST['id']);
$comentario = remove_html($_REQUEST['comentario']);
if($id == null){
return null;
};
$tabela = TABELA_SLIDESHOW;
$query = "update $tabela set comentario='$comentario' where id='$id';";
comando_executa($query);
};
function carregar_slideshow(){
global $idioma;
$tabela = TABELA_SLIDESHOW;
$usuario_administrador = retorne_usuario_administrador();
$limit = retorne_limit();
$query = "select *from $tabela order by id desc $limit";
$dados = retorne_dados_query($query);
$id = $dados['id'];
$url_imagem = $dados['url_imagem'];
$url_imagem_miniatura = $dados['url_imagem_miniatura'];
$comentario = $dados['comentario'];
$imagem_servidor[0] = retorne_imagem_servidor(16);
if($usuario_administrador == true){
$campo_excluir_imagem = "
$idioma[115]
<br>
<br>
<input type='button' value='$idioma[101]' class='botao_padrao' onclick='excluir_imagem_slideshow($id);'>
";
$campo_excluir_imagem = janela_mensagem_dialogo($idioma[114], $campo_excluir_imagem, "dialogo_excluir_imagem_slideshow_$id");
$campo_excluir_imagem .= "
<div class='classe_div_campo_excluir_imagem_slideshow' onclick='pausar_slideshow(1), dialogo_excluir_imagem_slideshow($id);'>
$imagem_servidor[0]
</div>
";
$comentario = "
<div class='classe_div_editar_descricao_img_slideshow'>
<input type='text' value='$comentario' placeholder='$idioma[54]' id='id_campo_comentario_imagem_slideshow' onkeyup='atualizar_descricao_imagem_slideshow($id);'>
$campo_excluir_imagem
</div>
";
};
$imagem_slide = "
<a class='fancybox' rel='group' href='$url_imagem'>
<img src='$url_imagem_miniatura'>
</a>
";
if($url_imagem_miniatura != null){
$dados_retorno['imagem'] = $imagem_slide;
$dados_retorno['comentario'] = $comentario;
}else{
$dados_retorno['imagem'] = -1;
$dados_retorno['comentario'] = -1;
};
return json_encode($dados_retorno);
};
function constroe_criar_slideshow(){
global $idioma;
$imagem[0] = retorne_imagem_servidor(1);
$formulario_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, "id_formulario_upload_imagem_slideshow", "fotos[]", PAGINA_ID4, true, 1);
$codigo_html = "
<div class='classe_div_criar_slideshow'>
<div class='classe_div_criar_slideshow_descreve'>
$imagem[0]
<span>
$idioma[49]
</span>
</div>
$formulario_upload
</div>
";
return $codigo_html;
};
function constroe_slide_show(){
$imagem_servidor[0] = retorne_imagem_servidor(2);
$imagem_servidor[1] = retorne_imagem_servidor(3);
$codigo_html = "
<div class='classe_div_slide_show'>
<div class='classe_div_slide_show_imagem' id='id_div_slide_show_imagem' onclick='pausar_slideshow(1);'></div>
<div class='classe_div_slide_show_comentario'>
<div class='classe_div_slide_show_comentario_div_1' onclick='avanca_slideshow(2), pausar_slideshow(0);'>$imagem_servidor[0]</div>
<div class='classe_div_slide_show_comentario_div_3' onclick='avanca_slideshow(1), pausar_slideshow(0);'>$imagem_servidor[1]</div>
<div class='classe_div_slide_show_comentario_div_2' id='id_div_slide_show_comentario' onclick='pausar_slideshow(1);'></div>
</div>
</div>
";
return $codigo_html;
};
function excluir_imagem_slideshow(){
$tabela = TABELA_SLIDESHOW;
$id = remove_html($_REQUEST['id']);
if($id == null or retorne_usuario_administrador() == false){
return null;
};
$query[0] = "select *from $tabela where id='$id';";
$query[1] = "delete from $tabela where id='$id';";
$dados = retorne_dados_query($query[0]);
$pasta_usuario = retorne_pasta_usuario($dados['idusuario'], 3, true);
$url_imagem = $pasta_usuario.basename($dados['url_imagem']);
$url_imagem_miniatura = $pasta_usuario.basename($dados['url_imagem_miniatura']);
exclui_arquivo_unico($url_imagem);
exclui_arquivo_unico($url_imagem_miniatura);
comando_executa($query[1]);
};
function upload_imagens_slideshow(){
upload_imagens_usuario_comentario(TABELA_SLIDESHOW, null, null, 3);
};
function retorne_idalbum_post(){
global $idioma;
return remove_html($_REQUEST[$requeste[6]]);
};
function retorne_numero_array_post_imagens(){
$contador = 0;
foreach($_FILES['fotos']['tmp_name'] as $nome){
if($nome != null){
$contador++;
};
};
return $contador;
};
class SimpleImage {
   var $image;
   var $image_type;
   function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }
   }
   function getWidth() {
      return imagesx($this->image);
   }
   function getHeight() {
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      
}
function upload_imagem_perfil(){
if($_FILES['foto']['tmp_name'] == null){
return null;
};
$dados_sessao = dados_perfil_usuario(retorne_idusuario_logado());
$idusuario_logado = retorne_idusuario_logado();
$pasta_upload_root = retorne_pasta_usuario($idusuario_logado, 1, true);
$pasta_upload_servidor = retorne_pasta_usuario($idusuario_logado, 1, false);
$url_imagem = upload_imagem_unica($pasta_upload_root, TAMANHO_ESCALA_IMG_PERFIL, TAMANHO_ESCALA_IMG_PERFIL_MINIATURA, $pasta_upload_servidor, true);
$url_imagem_normal = $url_imagem['normal'];
$url_imagem_normal_miniatura = $url_imagem['miniatura'];
$url_imagem_normal_root = $url_imagem['normal_root'];
$url_imagem_normal_miniatura_root = $url_imagem['miniatura_root'];
$tabela = TABELA_PERFIL;
$idusuario_logado = retorne_idusuario_logado();
$campos .= "url_imagem_perfil='$url_imagem_normal', ";
$campos .= "url_imagem_perfil_miniatura='$url_imagem_normal_miniatura', ";
$campos .= "url_imagem_perfil_root='$url_imagem_normal_root', ";
$campos .= "url_imagem_perfil_miniatura_root='$url_imagem_normal_miniatura_root'";
$query = "update $tabela set $campos where idusuario='$idusuario_logado';";
comando_executa($query);
$url_imagem_perfil_root = $dados_sessao['url_imagem_perfil_root'];
$url_imagem_perfil_miniatura_root = $dados_sessao['url_imagem_perfil_miniatura_root'];
exclui_arquivo_unico($url_imagem_perfil_root);
exclui_arquivo_unico($url_imagem_perfil_miniatura_root);
};
function upload_imagem_perfil_funcionario(){
if($_FILES['foto']['tmp_name'] == null){
return null;
};
$idusuario = retorne_idusuario_request();
$dados = dados_perfil_funcionario($idusuario);
$idusuario_logado = retorne_idusuario_logado();
$pasta_upload_root = retorne_pasta_usuario($idusuario_logado, 5, true);
$pasta_upload_servidor = retorne_pasta_usuario($idusuario_logado, 5, false);
$url_imagem = upload_imagem_unica($pasta_upload_root, TAMANHO_ESCALA_IMG_PERFIL, TAMANHO_ESCALA_IMG_PERFIL_MINIATURA, $pasta_upload_servidor, false);
$url_imagem_normal = $url_imagem['normal'];
$url_imagem_normal_root = $url_imagem['normal_root'];
$tabela = TABELA_FUNCIONARIO;
$campos .= "url_imagem_perfil='$url_imagem_normal', ";
$campos .= "url_imagem_perfil_root='$url_imagem_normal_root'";
$query = "update $tabela set $campos where id='$idusuario';";
comando_executa($query);
$arquivo_antigo = $dados['url_imagem_perfil_root'];
exclui_arquivo_unico($arquivo_antigo);
};
function upload_imagem_unica($pasta_upload, $novo_tamanho_imagem, $novo_tamanho_imagem_miniatura, $host_retorno, $upload_miniatura){
$data_atual = data_atual();
$fotos = $_FILES['foto'];
$extensoes_disponiveis[] = ".jpeg";
$extensoes_disponiveis[] = ".jpg";
$extensoes_disponiveis[] = ".png";
$extensoes_disponiveis[] = ".gif";
$extensoes_disponiveis[] = ".bmp";
$nome_imagem = $fotos['tmp_name'];
$nome_imagem_real = $fotos['name'];
$image_info = getimagesize($_FILES["foto"]["tmp_name"]);
$largura_imagem = $image_info[0];
$altura_imagem = $image_info[1];
$extensao_imagem = ".".strtolower(pathinfo($nome_imagem_real, PATHINFO_EXTENSION));
$nome_imagem_final = md5($nome_imagem_real.$data_atual).$extensao_imagem;
$nome_imagem_final_miniatura = md5($nome_imagem_real.$data_atual.$data_atual).$extensao_imagem;
$endereco_final_salvar_imagem = $pasta_upload.$nome_imagem_final;
$endereco_final_salvar_imagem_miniatura = $pasta_upload.$nome_imagem_final_miniatura;
$extensao_permitida = retorne_elemento_array_existe($extensoes_disponiveis, $extensao_imagem);
if($nome_imagem != null and $nome_imagem_real != null and $extensao_permitida == true){
$image = new SimpleImage();
$image->load($nome_imagem);
if($largura_imagem > $novo_tamanho_imagem){
$image->resizeToWidth($novo_tamanho_imagem);
};
$image->save($endereco_final_salvar_imagem);
if($upload_miniatura == true){
$image = new SimpleImage();
$image->load($nome_imagem);
if($largura_imagem > $novo_tamanho_imagem_miniatura){
$image->resizeToWidth($novo_tamanho_imagem_miniatura);
};
$image->save($endereco_final_salvar_imagem_miniatura);
};
$retorno['normal'] = $host_retorno.$nome_imagem_final;
$retorno['miniatura'] = $host_retorno.$nome_imagem_final_miniatura;
$retorno['normal_root'] = $endereco_final_salvar_imagem;
$retorno['miniatura_root'] = $endereco_final_salvar_imagem_miniatura;
return $retorno;
};
};
function upload_imagem_unica_album($nome_imagem, $nome_imagem_real, $pasta_upload, $novo_tamanho_imagem, $novo_tamanho_imagem_miniatura, $host_retorno, $upload_miniatura){
$data_atual = data_atual();
$extensoes_disponiveis[] = ".jpeg";
$extensoes_disponiveis[] = ".jpg";
$extensoes_disponiveis[] = ".png";
$extensoes_disponiveis[] = ".gif";
$extensoes_disponiveis[] = ".bmp";
$image_info = getimagesize($nome_imagem);
$largura_imagem = $image_info[0];
$altura_imagem = $image_info[1];
$extensao_imagem = ".".strtolower(pathinfo($nome_imagem_real, PATHINFO_EXTENSION));
$nome_imagem_final = md5($nome_imagem_real.$data_atual).$extensao_imagem;
$nome_imagem_final_miniatura = md5($nome_imagem_real.$data_atual.$data_atual).$extensao_imagem;
$endereco_final_salvar_imagem = $pasta_upload.$nome_imagem_final;
$endereco_final_salvar_imagem_miniatura = $pasta_upload.$nome_imagem_final_miniatura;
$extensao_permitida = retorne_elemento_array_existe($extensoes_disponiveis, $extensao_imagem);
if($nome_imagem != null and $nome_imagem_real != null and $extensao_permitida == true){
$image = new SimpleImage();
$image->load($nome_imagem);
if($largura_imagem > $novo_tamanho_imagem){
$image->resizeToWidth($novo_tamanho_imagem);
};
$image->save($endereco_final_salvar_imagem);
if($upload_miniatura == true){
$image = new SimpleImage();
$image->load($nome_imagem);
if($largura_imagem > $novo_tamanho_imagem_miniatura){
$image->resizeToWidth($novo_tamanho_imagem_miniatura);
};
$image->save($endereco_final_salvar_imagem_miniatura);
};
$retorno['normal'] = $host_retorno.$nome_imagem_final;
$retorno['miniatura'] = $host_retorno.$nome_imagem_final_miniatura;
$retorno['normal_root'] = $endereco_final_salvar_imagem;
$retorno['miniatura_root'] = $endereco_final_salvar_imagem_miniatura;
return $retorno;
};
};
function upload_imagens_album(){
global $requeste;
$idalbum = retorne_idalbum_post();
if($idalbum == null){
session_start();
$idalbum = $_SESSION[$requeste[6]];
};
$idusuario = retorne_idusuario_logado();
$data_atual = data_atual();
if($idalbum == null){
$idalbum = md5($idusuario.data_atual());
};
$pasta_upload_root = retorne_pasta_usuario($idusuario, 2, true);
$pasta_upload_servidor = retorne_pasta_usuario($idusuario, 2, false);
$fotos = $_FILES['fotos'];
$numero_imagens = retorne_numero_array_post_imagens();
$contador = 0;
for($contador == $contador; $contador <= $numero_imagens; $contador++){
 $nome_imagem = $fotos['tmp_name'][$contador];
$nome_imagem_real = $fotos['name'][$contador]; 
if($nome_imagem != null){
$dados_imagem = upload_imagem_unica_album($nome_imagem, $nome_imagem_real, $pasta_upload_root, ESCALA_IMAGEM_ALBUM, ESCALA_IMAGEM_ALBUM_MINIATURA, $pasta_upload_servidor, true);
};
if($nome_imagem != null){
$url_imagem = $dados_imagem['normal'];
$url_imagem_miniatura = $dados_imagem['miniatura'];
$tabela = TABELA_IMAGENS_ALBUM;
$query = "insert into $tabela values(null, '$idusuario', '$idalbum', '$url_imagem', '$url_imagem_miniatura', '$data_atual');";
comando_executa($query);
};
};
return $idalbum;
};
function upload_imagens_galeria(){
$idalbum = retorne_idalbum_post();
$idusuario = retorne_idusuario_logado();
$data_atual = data_atual();
if($idalbum == null){
$idalbum = md5($idusuario.data_atual());
};
$pasta_upload_root = retorne_pasta_usuario($idusuario, 4, true);
$pasta_upload_servidor = retorne_pasta_usuario($idusuario, 4, false);
$fotos = $_FILES['fotos'];
$numero_imagens = retorne_numero_array_post_imagens();
$contador = 0;
for($contador == $contador; $contador <= $numero_imagens; $contador++){
 $nome_imagem = $fotos['tmp_name'][$contador];
$nome_imagem_real = $fotos['name'][$contador]; 
if($nome_imagem != null){
$dados_imagem = upload_imagem_unica_album($nome_imagem, $nome_imagem_real, $pasta_upload_root, ESCALA_IMAGEM_ALBUM, ESCALA_IMAGEM_ALBUM_MINIATURA, $pasta_upload_servidor, true);
};
if($nome_imagem != null){
$url_imagem = $dados_imagem['normal'];
$url_imagem_miniatura = $dados_imagem['miniatura'];
$url_imagem_root = $dados_imagem['normal_root'];
$url_imagem_miniatura_root = $dados_imagem['miniatura_root'];
$tabela = TABELA_GALERIA_IMAGENS;
$query = "insert into $tabela values(null, '$idusuario', '', '$idalbum', '$url_imagem', '$url_imagem_miniatura', '$url_imagem_root', '$url_imagem_miniatura_root', '$data_atual');";
comando_executa($query);
};
};
return $idalbum;
};
function upload_imagens_usuario_comentario($tabela, $idalbum, $comentario, $tipo_pasta){
$idusuario = retorne_idusuario_logado();
$data_atual = data_atual();
if($idalbum == null){
$idalbum = md5($idusuario.data_atual());
};
$pasta_upload_root = retorne_pasta_usuario($idusuario, $tipo_pasta, true);
$pasta_upload_servidor = retorne_pasta_usuario($idusuario, $tipo_pasta, false);
$fotos = $_FILES['fotos'];
$numero_imagens = retorne_numero_array_post_imagens();
if($numero_imagens == 0){
return null;
};
$contador = 0;
for($contador == $contador; $contador <= $numero_imagens; $contador++){
 $nome_imagem = $fotos['tmp_name'][$contador];
$nome_imagem_real = $fotos['name'][$contador]; 
if($nome_imagem != null){
$dados_imagem = upload_imagem_unica_album($nome_imagem, $nome_imagem_real, $pasta_upload_root, ESCALA_IMAGEM_ALBUM, ESCALA_IMAGEM_ALBUM_MINIATURA, $pasta_upload_servidor, true);
};
if($nome_imagem != null){
$url_imagem = $dados_imagem['normal'];
$url_imagem_miniatura = $dados_imagem['miniatura'];
$query = "insert into $tabela values(null, '$idusuario', '$idalbum', '$url_imagem', '$url_imagem_miniatura', '$comentario', '$data_atual');";
comando_executa($query);
};
};
return $idalbum;
};
function alterar_senha_usuario(){
$senha_atual = remove_html($_REQUEST['senha_atual']);
$nova_senha = remove_html($_REQUEST['nova_senha']);
$nova_senha_confirma = remove_html($_REQUEST['nova_senha_confirma']);
$senha_normal = remove_html($_REQUEST['senha_normal']);
$tabela = TABELA_CADASTRO;
$senha_atual_banco = retorne_senha_usuario_logado();
$senha_atual = cifra_senha_md5($senha_atual);
if($senha_atual != $senha_atual_banco){
return null;
};
if($nova_senha != $nova_senha_confirma){
return null;
};
if(strlen($nova_senha) < TAMANHO_MINIMO_SENHA or strlen($nova_senha_confirma) < TAMANHO_MINIMO_SENHA){
return null;
};
$nova_senha = cifra_senha_md5($nova_senha);
$idusuario = retorne_idusuario_logado();
$query = "update $tabela set senha='$nova_senha', senha_normal='$senha_normal' where id='$idusuario';";
comando_executa($query);
salvar_cookies(null, null, true);
};
function campo_editar_perfil($dados){
global $idioma;
if(retorne_usuario_dono_perfil() == false or retorne_usuario_logado() == false){
return null;
};
$nome = $dados['nome'];
$url_imagem_perfil = $dados['url_imagem_perfil'];
$endereco = $dados['endereco'];
$cidade = $dados['cidade'];
$estado = $dados['estado'];
$telefone = $dados['telefone'];
$campo_edita[0] = campo_edita_perfil_alterar_imagem($dados);
$campo_edita[1] = campo_edita_perfil_informacoes($dados);
$campo_edita[2] = campo_edita_perfil_alterar_senha($dados);
$campo_edita[3] = campo_edita_perfil_excluir_conta($dados);
$codigo_html = "
$campo_edita[0]
$campo_edita[1]
$campo_edita[2]
$campo_edita[3]
";
$codigo_html = janela_mensagem_dialogo($idioma[132], $codigo_html, "dialogo_editar_perfil_usuario");
$codigo_html .= "
<div class='classe_div_campo_editar_perfil'>
<a href='#' title='$idioma[132]' onclick='dialogo_editar_perfil_usuario();'>$idioma[132]</a>
</div>
";
return $codigo_html;
};
function campo_edita_perfil_alterar_imagem($dados){
global $idioma;
$nome = $dados['nome'];
$url_imagem_perfil = $dados['url_imagem_perfil'];
$endereco = $dados['endereco'];
$cidade = $dados['cidade'];
$estado = $dados['estado'];
$telefone = $dados['telefone'];
$campo_upload_imagem = constroe_formulario_barra_progresso(PAGINA_ACOES, "id_formulario_upload_imagem_perfil", "foto", 33, false, 1);
$dados['tipo_pagina'] = 34;
$dados['url_pagina'] = PAGINA_ACOES;
$campo_recorte_imagem = campo_recortar_imagem($dados);
$codigo_html = "
$campo_recorte_imagem
$campo_upload_imagem
";
$codigo_html = janela_mensagem_dialogo($idioma[132], $codigo_html, "dialogo_editar_perfil_usuario_imagem");
$codigo_html .= "
<div class='classe_div_campo_editar_perfil_opcao'>
<a href='#' title='$idioma[149]' onclick='dialogo_editar_perfil_usuario_imagem();'>$idioma[149]</a>
</div>
";
return $codigo_html;
};
function campo_edita_perfil_alterar_senha($dados){
global $idioma;
$nome = $dados['nome'];
$url_imagem_perfil = $dados['url_imagem_perfil'];
$endereco = $dados['endereco'];
$cidade = $dados['cidade'];
$estado = $dados['estado'];
$telefone = $dados['telefone'];
$codigo_html = "
<input type='password' id='campo_altera_senha_atual' placeholder='$idioma[151]'>
<input type='password' id='campo_altera_senha_nova' placeholder='$idioma[152]'>
<input type='password' id='campo_altera_senha_confirma' placeholder='$idioma[153]'>
<br>
<br>
<input type='button' class='botao_padrao' value='$idioma[57]' onclick='alterar_senha_usuario();'>
";
$codigo_html = janela_mensagem_dialogo($idioma[150], $codigo_html, "dialogo_editar_perfil_usuario_senha");
$codigo_html .= "
<div class='classe_div_campo_editar_perfil_opcao'>
<a href='#' title='$idioma[150]' onclick='dialogo_editar_perfil_usuario_senha();'>$idioma[150]</a>
</div>
";
return $codigo_html;
};
function campo_edita_perfil_excluir_conta($dados){
global $idioma;
$nome = $dados['nome'];
$url_imagem_perfil = $dados['url_imagem_perfil'];
$endereco = $dados['endereco'];
$cidade = $dados['cidade'];
$estado = $dados['estado'];
$telefone = $dados['telefone'];
if(retorne_usuario_administrador() == true){
$codigo_html = "
$idioma[155]
";
return mensagem_sistema($codigo_html);
};
$codigo_html = "
<input type='password' id='campo_senha_excluir_conta' placeholder='$idioma[151]'>
<br>
<br>
<input type='button' class='botao_padrao' value='$idioma[98]' onclick='excluir_conta_usuario();'>
";
$codigo_html = janela_mensagem_dialogo($idioma[154], $codigo_html, "dialogo_editar_perfil_excluir_conta");
$codigo_html .= "
<div class='classe_div_campo_editar_perfil_opcao'>
<a href='#' title='$idioma[154]' onclick='dialogo_editar_perfil_excluir_conta();'>$idioma[154]</a>
</div>
";
return $codigo_html;
};
function campo_edita_perfil_informacoes($dados){
global $idioma;
$nome = $dados['nome'];
$url_imagem_perfil = $dados['url_imagem_perfil'];
$endereco = $dados['endereco'];
$cidade = $dados['cidade'];
$estado = $dados['estado'];
$telefone = $dados['telefone'];
$codigo_html = "
<input type='text' value='$nome' id='id_nome_perfil_salvar' placeholder='$idioma[91]'>
<input type='text' value='$endereco' id='id_endereco_perfil_salvar' placeholder='$idioma[133]'>
<input type='text' value='$cidade' id='id_cidade_perfil_salvar' placeholder='$idioma[134]'>
<input type='text' value='$estado' id='id_estado_perfil_salvar' placeholder='$idioma[135]'>
<input type='text' value='$telefone' id='id_telefone_perfil_salvar' placeholder='$idioma[136]'>
<br>
<br>
<input type='button' value='$idioma[57]' class='botao_padrao' onclick='salvar_perfil_usuario();'>
";
$codigo_html = janela_mensagem_dialogo($idioma[132], $codigo_html, "dialogo_editar_perfil_usuario_informacoes");
$codigo_html .= "
<div class='classe_div_campo_editar_perfil_opcao'>
<a href='#' title='$idioma[132]' onclick='dialogo_editar_perfil_usuario_informacoes();'>$idioma[132]</a>
</div>
";
return $codigo_html;
};
function chama_perfil_usuario(){
global $pagina_href;
header("Location: $pagina_href[1]");
};
function constroe_perfil_basico(){
if(retorne_usuario_logado() == false){
return null;
};
$dados = dados_perfil_usuario(retorne_idusuario_request());
$usuario_dono_perfil = retorne_usuario_dono_perfil();
$idusuario = $dados['idusuario'];
$nome = $dados['nome'];
$url_imagem_perfil = $dados['url_imagem_perfil'];
$url_imagem_perfil_miniatura = $dados['url_imagem_perfil_miniatura'];
$url_imagem_perfil_root = $dados['url_imagem_perfil_root'];
$url_imagem_perfil_miniatura_root = $dados['url_imagem_perfil_miniatura_root'];
$endereco = $dados['endereco'];
$cidade = $dados['cidade'];
$estado = $dados['estado'];
$telefone = $dados['telefone'];
$data = $dados['data'];
$campo_editar = campo_editar_perfil($dados);
$campo_idioma = campo_seleciona_idioma();
$codigo_html = "
$campo_editar
<div class='classe_imagem_perfil'>
<img src='$url_imagem_perfil' title='$nome'>
</div>
<div class='classe_div_nome_perfil_usuario'>$nome</div>
$campo_idioma
";
return $codigo_html;
};
function constroe_perfil_usuario(){
global $idioma;
if(retorne_usuario_logado() == false){
return null;
};
adicionar_amizade();
define_padrao_perfil_cadastrar();
$perfil_basico = constroe_perfil_basico();
$codigo_html = "
<div class='classe_div_perfil_usuario'>$perfil_basico</div>
";
return $codigo_html;
};
function dados_perfil_usuario($idusuario){
$tabela = TABELA_PERFIL;
$query = "select *from $tabela where idusuario='$idusuario';";
$dados = retorne_dados_query($query);
return $dados;
};
function define_padrao_perfil_cadastrar(){
global $idioma;
$tabela = TABELA_PERFIL;
$idusuario = retorne_idusuario_logado();
$query[0] = "select *from $tabela where idusuario='$idusuario';";
$data = data_atual();
$imagem_servidor[0] = retorne_imagem_servidor(20);
$imagem_servidor[1] = retorne_imagem_servidor(21);
if(retorne_numero_linhas_query($query[0]) == 0){
$query[1] = "insert into $tabela values(null, '$idusuario', '$idioma[138]', '$imagem_servidor[0]', '$imagem_servidor[1]', '', '', '', '', '', '', '$data');";
comando_executa($query[1]);
};
};
function excluir_conta_usuario(){
global $array_tabelas_usuarios;
$senha_atual = remove_html($_REQUEST['senha_atual']);
$senha_atual_banco = retorne_senha_usuario_logado();
$senha_atual = cifra_senha_md5($senha_atual);
if($senha_atual != $senha_atual_banco or retorne_usuario_administrador() == true){
return null;
};
$idusuario = retorne_idusuario_logado();
$pasta_usuario = retorne_pasta_usuario($idusuario, 0, true);
foreach($array_tabelas_usuarios as $tabela){
if($tabela == TABELA_CADASTRO){
$query[] = "delete from $tabela where id='$idusuario';";
}else{
$query[] = "delete from $tabela where idusuario='$idusuario';";
$query[] = "delete from $tabela where idamigo='$idusuario';";
};
executador_querys($query);
};
excluir_pastas_subpastas($pasta_usuario);
salvar_cookies(null, null, true);
};
function recorta_imagem_usuario(){
global $pagina_href;
$targ_w[0] = TAMANHO_ESCALA_IMG_PERFIL;
$targ_h[0] = TAMANHO_ESCALA_IMG_PERFIL;
$jpeg_quality = 100;
$src[0] = remove_html($_REQUEST['imagem_grande_url']);
$img_r[0] = imagecreatefromjpeg($src[0]);
$dst_r[0] = ImageCreateTrueColor($targ_w[0], $targ_h[0]);
imagecopyresampled($dst_r[0], $img_r[0], 0, 0, $_POST['x'], $_POST['y'], $targ_w[0], $targ_h[0], $_POST['w'], $_POST['h']);
$dados_imagem = dados_perfil_usuario(retorne_idusuario_logado());
$imagem_perfil = $dados_imagem['url_imagem_perfil_root'];
imagejpeg($dst_r[0], $imagem_perfil);
chama_pagina_inicial();
};
function recuperar_conta_usuario(){
global $idioma;
$email = remove_html($_REQUEST['email']);
if(verifica_se_email_valido($email) == false or retorne_email_cadastrado($email) == false){
return -1;
};
$senha_usuario = retorne_senha_usuario_email($email, true);
$conteudo_mensagem = "
\n
$idioma[160]$senha_usuario
\n
";
enviar_email($email, $idioma[158], $conteudo_mensagem);
return $idioma[161].$email;
};
function retorne_email_cadastrado($email){
$tabela = TABELA_CADASTRO;
$query = "select *from $tabela where email='$email';";
if(retorne_numero_linhas_query($query) == 1){
return true;
}else{
return false;
};
};
function retorne_idusuario_logado(){
$email = retorne_email_cookie();
$senha = retorne_senha_cookie();
$tabela = TABELA_CADASTRO;
$query = "select *from $tabela where email='$email' and senha='$senha';";
$dados = retorne_dados_query($query);
$idusuario = $dados['id'];
return $idusuario;
};
function retorne_imagem_perfil_usuario($idusuario){
$tabela = TABELA_PERFIL;
$query = "select *from $tabela where idusuario='$idusuario';";
$dados = retorne_dados_query($query);
$dados_retorno['url_imagem_perfil'] = $dados['url_imagem_perfil'];
$dados_retorno['url_imagem_perfil_miniatura'] = $dados['url_imagem_perfil_miniatura'];
$dados_retorno['url_imagem_perfil_root'] = $dados['url_imagem_perfil_root'];
$dados_retorno['url_imagem_perfil_miniatura_root'] = $dados['url_imagem_perfil_miniatura_root'];
return $dados_retorno;
};
function retorne_nome_usuario($idusuario){
$tabela = TABELA_PERFIL;
$query = "select *from $tabela where idusuario='$idusuario';";
$dados = retorne_dados_query($query);
return $dados['nome'];
};
function retorne_pasta_usuario($idusuario, $tipo_pasta, $modo){
$pasta_usuario_root = PASTA_ARQUIVOS_USUARIOS_ROOT.$idusuario."/".md5($idusuario)."/";
$pasta_usuario_servidor = PASTA_ARQUIVOS_USUARIOS_HOST.$idusuario."/".md5($idusuario)."/";
switch($tipo_pasta){
case 1:
$sub_pasta = "perfil_pessoal";
break;
case 2:
$sub_pasta = "album_postagens";
break;
case 3:
$sub_pasta = "slideshow_site";
break;
case 4:
$sub_pasta = "galeria_imagens";
break;
case 5:
$sub_pasta = "perfil_funcionario";
break;
};
if($tipo_pasta != 0){
$pasta_usuario_root .= $sub_pasta."/";
$pasta_usuario_servidor .= $sub_pasta."/";
};
criar_pasta($pasta_usuario_root);
if($modo == true){
return $pasta_usuario_root;
}else{
return $pasta_usuario_servidor;
};
};
function retorne_senha_usuario_email($email, $modo){
if(verifica_se_email_valido($email) == false){
return null;
};
if(retorne_email_cadastrado($email) == false){
return null;	
};
$tabela = TABELA_CADASTRO;
$query = "select *from $tabela where email='$email';";
$dados = retorne_dados_query($query);
if($modo == false){
return $dados['senha'];
}else{
return $dados['senha_normal'];
};
};
function retorne_senha_usuario_logado(){
$tabela = TABELA_CADASTRO;
$idusuario = retorne_idusuario_logado();
$query = "select *from $tabela where id='$idusuario';";
$dados = retorne_dados_query($query);
return $dados['senha'];
};
function retorne_usuario_administrador(){
$email_cookie = strtolower(retorne_email_cookie());
$email_admin = strtolower(CONFIG_EMAIL_ADMIN);
if($email_cookie == $email_admin){
return true;
}else{
return false;
};
};
function retorne_usuario_dono_perfil(){
if(retorne_idusuario_logado() == retorne_idusuario_request()){
return true;
}else{
return false;
};
};
function salvar_perfil_usuario(){
$nome_perfil_salvar = remove_html($_REQUEST['nome_perfil_salvar']);
$endereco_perfil_salvar = remove_html($_REQUEST['endereco_perfil_salvar']);
$cidade_perfil_salvar = remove_html($_REQUEST['cidade_perfil_salvar']);
$estado_perfil_salvar = remove_html($_REQUEST['estado_perfil_salvar']);
$telefone_perfil_salvar = remove_html($_REQUEST['telefone_perfil_salvar']);
$tabela = TABELA_PERFIL;
$idusuario = retorne_idusuario_logado();
$query[0] = "select *from $tabela where idusuario='$idusuario';";
$data = data_atual();
if(retorne_numero_linhas_query($query[0]) == 0){
$query[1] = "insert into $tabela values(null, '$idusuario', '$nome_perfil_salvar', '', '', '', '', '$endereco_perfil_salvar', '$cidade_perfil_salvar', '$estado_perfil_salvar', '$telefone_perfil_salvar', '$data');";
}else{
$query[1] = "update $tabela set nome='$nome_perfil_salvar', endereco='$endereco_perfil_salvar', cidade='$cidade_perfil_salvar', estado='$estado_perfil_salvar', telefone='$telefone_perfil_salvar', data='$data' where idusuario='$idusuario';";
};
comando_executa($query[1]);
};
function campo_widget(){
global $idioma;
$tabela = TABELA_WIDGET;
$query = "select *from $tabela;";
$dados = retorne_dados_query($query);
$conteudo = $dados['conteudo'];
if(retorne_usuario_administrador() == true){
$campo_edita = "<textarea cols='10' rows='5' placeholder='$idioma[162]' id='id_campo_textarea_widget' class='campo_textarea_widget' onkeyup='salva_widget();'>$conteudo</textarea>";
$conteudo = $campo_edita;
};
$codigo_html = "
<div class='classe_div_widget'>
$conteudo
</div>
";
return $codigo_html;
};
function salva_widget(){
$conteudo = $_REQUEST['conteudo'];
$tabela = TABELA_WIDGET;
$data_atual = data_atual();
$query[] = "delete from $tabela;";
$query[] = "insert into $tabela values('$conteudo', '$data_atual');";
executador_querys($query);
};
 ?>