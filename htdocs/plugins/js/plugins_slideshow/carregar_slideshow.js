
// carrega o slideshow
function carregar_slideshow(){

// valida slideshow pausado
if(v_slideshow_pausado == 1){

// retorno nulo
return null;
	
};

// monta requisicao
$.post(v_pagina_acoes, {dataType : "json", contador_avanco_conteudo: v_contador_slideshow, href: 5}, function(retorno){

// objeto com dados de retorno
var objeto = jQuery.parseJSON(retorno);

// valida conteudo
if(objeto['imagem'] == -1){

// zera o contador
v_contador_slideshow = 0;

}else{

// atualiza o contador	
v_contador_slideshow++;
	
};

// apresenta a imagem e comentario
if(objeto['imagem'] != -1){
	
document.getElementById("id_div_slide_show_imagem").innerHTML = objeto['imagem'];
document.getElementById("id_div_slide_show_comentario").innerHTML = objeto['comentario'];

};

});

};

