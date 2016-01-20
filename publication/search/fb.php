#!/usr/bin/php
<?php
//@ini_set("display_errors","1");
//@error_reporting(E_ALL);
$terminoBuscar=$argv[1];
function genToken(){
	do{
		$APP_ID = '256301091132754';
		$APP_SECRET = '924a02e28b7c42cc885ed849f674d6f7';
		$url = "https://graph.facebook.com/oauth/access_token?client_id=".$APP_ID."&client_secret=".$APP_SECRET."&grant_type=client_credentials";
		$proxy="172.16.224.4:8080";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_PROXY, $proxy);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		$token = curl_exec($curl);	
		curl_close($curl);
	}while($token=="");
	$token="access_token=CAADpGr9ZBFVIBABZBFzyLpHZC12Glz8EVuKxjoZA05BYhOPn0OkRWginr0cv6aW1X5AjeZAX1M2RNfchZB10EM2DkvCozEcbzsvDbV47yFnUnAZA4v9WttULPTGlquEV3ZAQVOEKVtsgYlOm47mEs6D4K9BQ6bhYScwCelRkgNaOv4OZBpI3OLdAXvTyACYCzbG4jCZCC2d6lQcQZDZD";
	return $token;
}

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

function app_request($url="") {
	$proxy="172.16.224.4:8080";
    $curl = curl_init($url);
   curl_setopt($curl, CURLOPT_PROXY, $proxy);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    $result = curl_exec($curl);
    curl_close($curl);
    return objectToArray(json_decode($result));
}
$app_access_token=genToken();
$resultFacebook=app_request("https://graph.facebook.com/v2.4/search?q=".$terminoBuscar."&type=page&limit=6&fields=id,name,picture{url}&".$app_access_token);
//print_r($resultFacebook);
$fp = fopen('/Users/Sebas/Documents/BRM/GitHub/nemo/publication/search/results/resultFacebook.json', 'w');
fwrite($fp, json_encode($resultFacebook));
fclose($fp);
?>