
// avanca o slideshow
function avanca_slideshow(modo){

// inicia slideshow
pausar_slideshow(0);

// valida modo
if(modo == 2 && v_contador_slideshow >= 2){

//decresce
v_contador_slideshow -= 2;

};


// valida tamanho positivo de contador
if(v_contador_slideshow >= 0){
	
// carrega o slideshow	
carregar_slideshow();

};

};
