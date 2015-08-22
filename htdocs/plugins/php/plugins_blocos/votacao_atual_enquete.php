<?php

// votacao atual de enquete
function votacao_atual_enquete($id){

// globals
global $idioma;

// tabela
$tabela = TABELA_VOTO_ENQUETE;

// query
$query[0] = "select *from $tabela where id_enquete='$id';";
$query[1] = "select *from $tabela where id_enquete='$id' and resposta_sim='1';";
$query[2] = "select *from $tabela where id_enquete='$id' and resposta_nao='1';";

// numero de linhas
$numero_linhas = retorne_numero_linhas_query($query[0]);

// separa os dados
$resposta_sim = retorne_numero_linhas_query($query[1]);
$resposta_nao = retorne_numero_linhas_query($query[2]);

// calculo de porcentagem
$porcentagem[0] = @(($resposta_sim * 100) / $numero_linhas);
$porcentagem[1] = @(($resposta_nao * 100) / $numero_linhas);

// arredonda
$porcentagem[0] = round($porcentagem[0], 2);
$porcentagem[1] = round($porcentagem[1], 2);

// codigo html
$codigo_html = "

<div class='classe_numero_votos_enquete'>$idioma[130]: $numero_linhas</div>
<div class='classe_votos_enquete_porcentagem' onclick='votar_enquete($id, 1);'>$idioma[101]: $porcentagem[0]%</div>
<div class='classe_votos_enquete_porcentagem' onclick='votar_enquete($id, 0);'>$idioma[131]: $porcentagem[1]%</div>

";

// retorno
return $codigo_html;

};

?>