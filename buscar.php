<?php
require("db/requires.php"); 
$General= new General();

$todasLasMarcas=$General->getInstanciaWhere("MpBrand");
echo json_encode($todasLasMarcas);
?>