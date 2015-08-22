<?php

// constroe o conteudo
function constroe_conteudo(){

// globals
global $idioma;
global $pagina_href;

// usar resolucao
$usar_resolucao = retorna_usar_resolucao();

// constroe o menu de navegacao vertical
$codigo_html .= "<div class='classe_div_centro_pagina'>";

// valida id de post
if(retorne_idpost_request() == null){

// codigo html
$codigo_html .= constroe_slide_show();

// valida termo de pesquisa
if(retorne_termo_pesquisa() == null){

// codigo html
$codigo_html .= constroe_campo_bloco_pagina();

};

// valida usar resolucao
if($usar_resolucao == false){
	
// codigo html
$codigo_html .= campo_opcao_administrador();

};

};

// valida exibir destaques
if(retorne_href_get() == null and retorne_idpost_request() == null){
	
// codigo html	
$codigo_html .= constroe_campo_destaque();

};

// codigo html
$codigo_html .= constroe_campo_conteudo_postagem();
$codigo_html .= "</div>";

// valida usar resolucao
if($usar_resolucao == false){

// codigo html
$codigo_html .= "<div class='classe_div_menus_principal'>";
$codigo_html .= constroe_perfil_usuario();
$codigo_html .= constroe_campo_administrar();
$codigo_html .= campo_widget();
$codigo_html .= constroe_menu_navegacao_vertical($idioma[106], constroe_links_navegacao_postagens());
$codigo_html .= constroe_chat_usuario();
$codigo_html .= "</div>";

}else{

// codigo html
$codigo_html .= constroe_chat_usuario();
	
};

// valida constroe publicacao de usuario
if(retorne_idpost_request() != null){

// retorna o codigo html
return $codigo_html;
	
};

// constro conteudo
switch(retorne_href_get()){

case $idioma[15]:
salvar_cookies(null, null, true);
chama_pagina_especifica($pagina_href[0]);
break;

};

// retorno
return $codigo_html;

};

?>