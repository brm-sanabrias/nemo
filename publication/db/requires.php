<?php
@ini_set("display_errors","1");
error_reporting(1);
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');
session_start();
$_SESSION['email']="HOLA";

global $prefijo;

require($prefijo."db/DBO.php");

//DataObjects

require($prefijo."db/requires.ini.php");

//Clases
require($prefijo."class/class.General.inc.php");
require($prefijo."class/class.MongoNemo.inc.php");
//require($prefijo."class/datosGrafica.php");

//Smarty
//echo $_SERVER["DOCUMENT_ROOT"];
//require($_SERVER["DOCUMENT_ROOT"]."/Smarty/libs/Smarty.class.php");
require("../Smarty/libs/Smarty.class.php");
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->left_delimiter = '{#';
$smarty->right_delimiter = '#}';

function cambiaParaEnvio($cadena){
	//$cadena = htmlentities($cadena,ENT_NOQUOTES,"ISO8859-1");
	$cadena = utf8_encode($cadena);
	return($cadena);
}

function printVar( $variable, $title = "" ){
	$var = print_r( $variable, true );
	echo "<pre style='background-color:#dddd00; border: dashed thin #000000;'><strong>[$title]</strong> $var</pre>";
}
/* Funciones Facebook */
function objectToArray($d) {
	if (is_object($d)) {
		$d = get_object_vars($d);
	}
	if (is_array($d)) {
		return array_map(__FUNCTION__, $d);
	} else {
		return $d;
	}
}
		
function genToken(){
	do{
		$APP_ID = '256301091132754';
		$APP_SECRET = 'dc897d6e5ec629a429aa39c416b506e1';
		$url = "https://graph.facebook.com/oauth/access_token?client_id=".$APP_ID."&client_secret=".$APP_SECRET."&grant_type=client_credentials";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		$token = curl_exec($curl);	
		curl_close($curl);
	}while($token=="");
	//$token="access_token=CAADpGr9ZBFVIBAJycVK1tiaTLc0XKzJuLVta9MADIosGXt3ahBV5AZBvA13VSfOemJNX0uemsSVXwdxdMZB05gzuERlnGacxGVMiKh7nhUp41FHMh3JrrY5i1qIQGmrcYFRahoQjifVovL8hsmX1xGWZArbRotRK8jrZADtxBLUZCrnONlSnSa336S27eSjqcZD";
	return $token;
}

function app_request($url="") {

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	$result = curl_exec($curl);
	curl_close($curl);
	return objectToArray(json_decode($result));
}
/* Fin funciones facebook*/

/*Funciones Twitter*/
function buildBaseString($baseURI, $method, $params)
{
    $r = array(); 
    ksort($params);
    foreach($params as $key=>$value){
        $r[] = "$key=" . rawurlencode($value); 
    }
    return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r)); 
}

function buildAuthorizationHeader($oauth)
{
    $r = 'Authorization: OAuth '; 
    $values = array(); 
    foreach($oauth as $key=>$value)
        $values[] = "$key=\"" . rawurlencode($value) . "\""; 
    $r .= implode(', ', $values); 
    return $r; 
}
/*Fin funciones Twitter*/
?>