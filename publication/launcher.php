<?php
	//var_dump($argv);
	//BUSCO LA MARCA EN LA 
//ini_set('memory_limit', '4095M');
	require("db/requires.php"); 
	if(isset($_COOKIE['idBrand']) && is_numeric($_COOKIE['idBrand'])){
		//BUSCO LA MARCA EN LA BASE DE DATOS
	$General= new General();
	$marca=$General->getInstanciaWhere("MpBrand",'','idBrand='.$_COOKIE['idBrand']);
	$terminoBuscar=$marca[0]->name;
	}
	//echo $terminoBuscar;
	//$terminoBuscar="Miller Lite";
	exec("rm /Users/Sebas/Documents/BRM/GitHub/nemo/publication/search/results/*");
	//exec("rm /Users/Sebas/Documents/BRM/GitHub/nemo/publication/search/pantallazo/*");
	///LANZO FACEBOOK
	exec('php search/fb.php '.$terminoBuscar);
	//include 'php busqueda/fb.php';
	///LANZO TWITTER
	exec('php search/tw.php '.$terminoBuscar);


	exec('php search/yt.php '.$terminoBuscar);
	//Lanzo Google
	exec("php search/google.php ".$terminoBuscar);
	//Leo JSON Sitio
	$string = file_get_contents("/Users/Sebas/Documents/BRM/GitHub/nemo/publication/search/results/resultGoogle.json");
	$json = json_decode($string, true);
	foreach ($json as $key => $value) {
    	///LANZO CASPER
		//exec('casperjs --ignore-ssl-errors=true search/google.js --url="'.$value.'" &', $output, $return);
		//print($output);
		//sleep(1);
	}
?>