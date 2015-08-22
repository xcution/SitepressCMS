<?php

// inicia o timer do sistema
function timer_sistema($segundos, $funcoes_timer){

// calcula os segundos
$segundos *= 1000;

$codigo_md5[0] = "a".md5($segundos.$funcoes_timer);
$codigo_md5[1] = "b".md5($segundos.$funcoes_timer);
$codigo_md5[2] = "c".md5($segundos.$funcoes_timer);

// inicia o timer
$codigo_html = "
\n
<script language='javascript'>

// inicia o timer
\n
var $codigo_md5[2] = setInterval(function(){ $codigo_md5[1]() }, $segundos);
\n
function $codigo_md5[1]() {
\n
$codigo_md5[0]();
\n
};
\n
// funcoes do timer
function $codigo_md5[0](){
\n
$funcoes_timer
\n
};
\n

</script>
\n
";

// retorno
return $codigo_html;

};

?>