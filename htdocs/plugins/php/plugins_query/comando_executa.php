<?php

// executador de comando
function comando_executa($query){

// em caso de esquecer o ; do fim da string
if($query{strlen($query) - 1} != ";"){

// adiciona ; no fim da query
$query .= ";";
	
};

// comando
if($query != null){

// executa comando
$comando = mysql_query($query);

}else{

// retorno nulo
return null;

};

// retorna comando
return $comando;

};

?>