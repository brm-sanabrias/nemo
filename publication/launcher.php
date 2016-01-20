<?php
	//BUSCO LA MARCA EN LA 
	require("db/requires.php"); 
	if(isset($_COOKIE['idBrand']) && is_numeric($_COOKIE['idBrand'])){
		//BUSCO LA MARCA EN LA BASE DE DATOS
		$General= new General();
		$marca=$General->getInstanciaWhere("MpBrand",'','idBrand='.$_COOKIE['idBrand']);
		$terminoBuscar=$marca[0]->name;
	}
	echo $terminoBuscar;
	///LANZO FACEBOOK
	exec('php search/fb.php '.$terminoBuscar);
	//include 'php busqueda/fb.php';
	///LANZO TWITTER
	exec('php search/tw.php '.$terminoBuscar);


	exec('php search/yt.php '.$terminoBuscar);
	
	///LANZO CASPER
	//echo exec('casperjs --ignore-ssl-errors=true search/google.js --search="'.$terminoBuscar.'"');
	//printVar($_COOKIE);

?>