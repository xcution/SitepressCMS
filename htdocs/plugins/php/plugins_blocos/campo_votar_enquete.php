<?php

// campo votar em enquete
function campo_votar_enquete($dados){

// separa os dados
$id = $dados['id'];
$conteudo = $dados['conteudo'];
$data = $dados['data'];

// votacao atual
$votacao_atual = votacao_atual_enquete($id);

// codigo html
$codigo_html = "
<div class='classe_div_votar_enquete_bloco' id='id_div_votar_enquete_bloco_$id'>
$votacao_atual
</div>
";

// retorno
return $codigo_html;

};

?>