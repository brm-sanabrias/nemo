<?php
include("db/requires.php");
//error_reporting(E_ALL);
///MARCAS EXISTENTES EN LA BASE DE DATOS
if(isset($_POST['datos']) && isset($_COOKIE['idBrand']) && is_numeric($_COOKIE['idBrand'])){
	//printVar($_POST['datos']);
	$datos=json_decode($_POST['datos']);
	$General = new General();
	$marca=$General->getInstanciaWhere("MpBrand",'','idBrand='.$_COOKIE['idBrand']);
//	DB_DataObject::debugLevel(1);
	$nombreMarca=$marca[0]->name;
	$idBrand=$marca[0]->idBrand;
	if($idBrand==0){
		//Inserción de la marca
		$General->idCategory=1;
		$General->picture="N/A";
		$General->name=$nombreMarca;
		$General->date=date("Y-m-d H:i:s");
		$idBrand=$General->setInstancia('MpBrand');
	}
	foreach ($datos as $key => $value) {
		switch ($key) {
			case 0:
			# Facebook	
				if($idBrand>0){
					$General->idSocialNetwork=1;
					$General->idInteraction=1;
					$General->idInteraction=$idBrand;
					$General->snID=$value->id;
					$ret=$General->setInstancia("MpBrandXSocialNetwork");
				}
			break;
			case 1:
			# Twitter
				if($idBrand>0){
					$General->idSocialNetwork=2;
					$General->idInteraction=2;
					$General->idInteraction=$idBrand;
					$General->snID=$value->screen_name;
					$ret=$General->setInstancia("MpBrandXSocialNetwork");
				}
			break;
			case 2:
			# Youtube
				if($idBrand>0){
					$General->idSocialNetwork=3;
					$General->idInteraction=3;
					$General->idInteraction=$idBrand;
					$General->snID=$value->snippet->title;
					$ret=$General->setInstancia("MpBrandXSocialNetwork");
				}
			break;
		}
	}
	echo $ret;
}
// MARCAS NO EXISTENTES EN LA BASE DE DATOS
if(isset($_POST['marca']) && !empty($_POST['marca'])){
	
	$nombreMarca=(string)$_POST['marca'];
	$General = new General();
	$General->idCategory=1;
	$General->picture="N/A";
	$General->name=$nombreMarca;
	$General->date=date("Y-m-d H:i:s");
	$idBrand=$General->setInstancia('MpBrand');
	//printVar($idBrand);
	setcookie("idBrand", $idBrand);
}
//printVar($_POST['data'],'data');
//printVar($_COOKIE['idBrand'],'idBrand de cookie');

/*agregar la direccion del sitio asociado a la marca*/
if (isset($_POST['data']) && !empty($_POST['data']) &&
	isset($_COOKIE['idBrand']) && is_numeric($_COOKIE['idBrand'])) {
	$urls=json_decode($_POST['data']);
//	printVar($urls,'urls');
	$data['idBrand']=$_COOKIE['idBrand'];
	$web = new Web();
	for ($i = 0; $i < count($urls); $i++) {
		 $data['url']=$urls[$i];
		 
		 $web->insert($data);
	}
	echo json_encode('ok');
}

/*Agrega los datos de analytics a las paginas de la marca*/

if (isset($_POST['analytics']) && !empty($_POST['analytics']) &&
	isset($_COOKIE['idBrand']) && is_numeric($_COOKIE['idBrand'])) {
		$analytics=$_POST['analytics'];
		$idBrand=$_COOKIE['idBrand'];
		$web= new Web();
		$split=explode(':)',$analytics);
		$pagina='';
		$usuario='';
		$pass='';
		for ($i = 0; $i < count($split); $i++) {
			 $datos=explode(':(',$split[$i]);
			 if ($datos[1]!='' && $datos[2]!='') {
			 	$pagina=$datos[0];
			 	$usuario=$datos[1];
			 	$pass=$datos[2];
			 	$web->insertAnalytics($pagina,$usuario,$pass,$idBrand);
			 }
		}
		echo json_encode('ok');
	}
?>

