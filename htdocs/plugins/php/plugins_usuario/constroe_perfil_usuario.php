<?php

// constroe o perfil do usuario
function constroe_perfil_usuario(){

// globals
global $idioma;

// valida usuario logado
if(retorne_usuario_logado() == false){

// retorno nulo
return null;
	
};

// executa funcoes necessarias
adicionar_amizade();
define_padrao_perfil_cadastrar();

// perfil basico do usuario
$perfil_basico = constroe_perfil_basico();

// codigo html
$codigo_html = "
<div class='classe_div_perfil_usuario'>$perfil_basico</div>
";

// retorno
return $codigo_html;

};

?>