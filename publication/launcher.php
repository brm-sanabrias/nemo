<?php
require "search/thread.php";
require("db/requires.php"); 


function launchFacebook($terminoBuscar){
	exec('php search/fb.php '.$terminoBuscar);
	exit("End FACEBOOK ".PHP_EOL);
}
function launchTwitter($terminoBuscar){
	exec('php search/tw.php '.$terminoBuscar);
	exit("End TWITTER ".PHP_EOL);

}
function launchYoutube($terminoBuscar){
	exec('php search/yt.php '.$terminoBuscar);
	exit("End YOUTUBE ".PHP_EOL);

}
function launchGoogle($terminoBuscar){
	exec('php search/google.php '.$terminoBuscar);
	$thread5 = new Thread('lauchCasper');
	$thread5->start($terminoBuscar);

	exit("End Google ".PHP_EOL);

}
function lauchCasper() {
	$sites = array();
    $string = file_get_contents("/Users/Sebas/Documents/BRM/GitHub/nemo/publication/search/results/resultGoogle.json");
	$json = json_decode($string, true);
	foreach ($json as $key => $value) {
	 	///LANZO CASPER
	 	//echo "Desde php".$value.PHP_EOL;
	 	$sites['url']=$value;
	 	$sites['imagen']=$key;
	 	echo 'casperjs --ignore-ssl-errors=true search/google.js --url="'.$value.'" --name="'.$key.'"';
	 	exec('casperjs --ignore-ssl-errors=true search/google.js --url="'.$value.'" --name="'.$key.'"', $output, $return);
		print_r($output);
		sleep(1);
	}
	exit("End CASPER");

}
if(isset($_COOKIE['idBrand']) && is_numeric($_COOKIE['idBrand'])){
	//BUSCO LA MARCA EN LA BASE DE DATOS
	$General= new General();
	$marca=$General->getInstanciaWhere("MpBrand",'','idBrand='.$_COOKIE['idBrand']);
	$terminoBuscar=$marca[0]->name;
}
//$terminoBuscar="CLARO";
///Defino los hilos
$thread1 = new Thread('launchFacebook');
$thread2 = new Thread('launchTwitter');
$thread3 = new Thread('launchYoutube');
$thread4 = new Thread('launchGoogle');
//Lanzo los proceso
 
$thread1->start($terminoBuscar);
$thread2->start($terminoBuscar);
$thread3->start($terminoBuscar);
$thread4->start($terminoBuscar);

//$thread2->start(2, 40);
//$thread3->start(1, 30);
 
//while ($thread1->isAlive() || $thread2->isAlive() || $thread3->isAlive() || $thread4->isAlive() || $thread5->isAlive()){

?>