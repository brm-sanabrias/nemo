#!/usr/bin/php
<?php
//@ini_set("display_errors","1");
//@error_reporting(E_ALL);
//echo 'llega a fb.php';
$terminoBuscar=$argv[1];
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
	$token="access_token=CAADpGr9ZBFVIBAJycVK1tiaTLc0XKzJuLVta9MADIosGXt3ahBV5AZBvA13VSfOemJNX0uemsSVXwdxdMZB05gzuERlnGacxGVMiKh7nhUp41FHMh3JrrY5i1qIQGmrcYFRahoQjifVovL8hsmX1xGWZArbRotRK8jrZADtxBLUZCrnONlSnSa336S27eSjqcZD";
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
$app_access_token=genToken();
$resultFacebook=app_request("https://graph.facebook.com/v2.5/search?q=".$terminoBuscar."&type=page&limit=10&fields=id,name,picture.type(normal),likes&".$app_access_token);
print_r($resultFacebook);

$fp = fopen('/home/ubuntu/workspace/publication/search/results/resultFacebook.json', 'w');
fwrite($fp, json_encode($resultFacebook));
fclose($fp);
?>