<?php
require("db/requires.php"); 

// Open a directory, and read its contents
$dir = "search/pantallazo/";
$images=array();
$i=1;
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
    	$file=$dir.$file;
		if(is_file($file)){
		//   echo "filename:" . $file . "<br>";
			$images[$i]=$file;
      		$i++;

		}
    }
    closedir($dh);
  }
}
if(isset($_COOKIE['idBrand']) && is_numeric($_COOKIE['idBrand'])){
//  //BUSCO LA MARCA EN LA BASE DE DATOS
 $General= new General();
 $marca=$General->getInstanciaWhere("MpBrand",'','idBrand='.$_COOKIE['idBrand']);
 $nombreMarca=$marca[0]->name;
}
$smarty->assign('nombreMarca',$nombreMarca);
$smarty->assign('images', $images);
$smarty->display("web.html");
?>