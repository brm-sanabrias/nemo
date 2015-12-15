<?php
require("db/requires.php");

if(isset($_COOKIE['idBrand']) && is_numeric($_COOKIE['idBrand'])){
	//BUSCO LA MARCA EN LA BASE DE DATOS
	$General= new General();
	$marca=$General->getInstanciaWhere("MpBrand",'','idBrand='.$_COOKIE['idBrand']);
	$nombreMarca=$marca[0]->name;
}
$smarty->assign('nombreMarca',$nombreMarca);
$smarty->display("redes.html");
?>
