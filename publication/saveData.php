<?php
include("db/requires.php");
if(isset($_POST['datos']) && isset($_COOKIE['idBrand']) && is_numeric($_COOKIE['idBrand'])){
	$datos=json_decode($_POST['datos']);
	$General = new General();
	$marca=$General->getInstanciaWhere("MpBrand",'','idBrand='.$_COOKIE['idBrand']);
	$nombreMarca=$marca[0]->name;
	//Inserción de la marca
	$General->idCategory=1;
	$General->picture="N/A";
	$General->name=$nombreMarca;
	$General->date=date("Y-m-d H:i:s");
	$idBrand=$General->setInstancia('MpBrand');
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
?>