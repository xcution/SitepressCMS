<?php

// exclui pastas e subpastas
function excluir_pastas_subpastas($endereco_pasta_remover){

// removendo pastas e subpastas
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

?>
