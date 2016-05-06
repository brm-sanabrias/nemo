<?php
require "search/thread.php";
require("db/requires.php"); 
//@error_reporting(E_ALL);
function launchFacebook($terminoBuscar){
   
	$app_access_token=genToken();
	$resultFacebook=app_request("https://graph.facebook.com/v2.5/search?q=".$terminoBuscar."&type=page&limit=10&fields=id,name,picture.type(normal),likes&".$app_access_token);
	$fp = fopen(/*$path.*/'/home/ubuntu/workspace/publication/search/results/resultFacebook.json', 'w');
    //printVar($resultFacebook);
   // printVar($resultFacebook['data'][0]['picture']['data']['url']);
	fwrite($fp, json_encode($resultFacebook));
	fclose($fp);
	$obj = DB_DataObject::Factory('MpBrand');
	//	DB_DataObject::debugLevel(1);
		//printVar($obj);
		$obj->name=$terminoBuscar;
		$find=$obj->find();
	//	printVar($find,'find');
		if($find >0) {
		   // echo 'entra al if';
			while($obj->fetch()){
			    //DB_DataObject::debugLevel(1);
			     $obj->picture=$resultFacebook['data'][0]['picture']['data']['url'];
			    $obj->update();
			  	
			}
		}else{
		    
		}
		$obj->free();
//	$obj = new General();
//	$obj->picture($terminoBuscar);
  //exit("End FACEBOOK ".PHP_EOL);
	echo json_encode('');
}
function launchTwitter($terminoBuscar){
	/*from tw.php*/
	$url = "https://api.twitter.com/1.1/users/search.json";
    $query = array( 'count' => 100, 'q' => urlencode($terminoBuscar), "result_type" => "recent");
    $oauth_access_token = "336107062-3FRWmW9u2WqAD8K2BYkkhRyYPiuElAls5xGSPxHO"; // original 336107062-3FRWmW9u2WqAD8K2BYkkhRyYPiuElAls5xGSPxHO
    $oauth_access_token_secret = "EYOobKPmD0Ym4f30AEOM0xGjlfnaan1Vt17fkUYuJKOnY";// original EYOobKPmD0Ym4f30AEOM0xGjlfnaan1Vt17fkUYuJKOnY
    $consumer_key = "zCYb1EGbavxyFI26TSCYpDVHT";//original zCYb1EGbavxyFI26TSCYpDVHT
    $consumer_secret = "limIRUXH0FiFRVcdDpOi6SwAxt3ZZpNvj58P2WVXr5mspF0J7t"; // original limIRUXH0FiFRVcdDpOi6SwAxt3ZZpNvj58P2WVXr5mspF0J7t
    $oauth = array(
                    'oauth_consumer_key' => $consumer_key,
                    'oauth_nonce' => time(),
                    'oauth_signature_method' => 'HMAC-SHA1',
                    'oauth_token' => $oauth_access_token,
                    'oauth_timestamp' => time(),
                    'oauth_version' => '1.0');

    $base_params = empty($query) ? $oauth : array_merge($query,$oauth);
    $base_info = buildBaseString($url, 'GET', $base_params);
    $url = empty($query) ? $url : $url . "?" . http_build_query($query);

    $composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
    $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
    $oauth['oauth_signature'] = $oauth_signature;

    $header = array(buildAuthorizationHeader($oauth), 'Expect:');
    $options = array( CURLOPT_HTTPHEADER => $header,
                      CURLOPT_HEADER => false,
                      CURLOPT_URL => $url,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_SSL_VERIFYPEER => false);

    $feed = curl_init();
    curl_setopt_array($feed, $options);
    $json = curl_exec($feed);
    curl_close($feed);
    $resultTwitter=json_decode($json);
    
	$fp = fopen('/home/ubuntu/workspace/publication/search/results/resultTwitter.json', 'w');
	fwrite($fp, json_encode($resultTwitter));
	fclose($fp);
	/*fin from tw.php */
	
//	exec('php search/tw.php '.$terminoBuscar);
//	exit("End TWITTER ".PHP_EOL);

}
function launchYoutube($terminoBuscar){
    $key_api="AIzaSyC1PB5ml8U32_sqIknk33VJZb5CmtQ1v0Q";
    $limit=6;
    $search=$terminoBuscar;
    
    // Order Fields = date, rating, relevance, title, videoCount, viewCount
    $order="relevance";
    $url = "https://www.googleapis.com/youtube/v3/search?key=".$key_api."&part=snippet&type=channel&maxResults=".$limit."&order=".$order."&q=".$search;
    $curl = curl_init($url);
    //$proxy="172.16.224.4:8080";
    curl_setopt($curl, CURLOPT_PROXY, $proxy);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $return = curl_exec($curl);
    curl_close($curl);
    $resultYoutube = json_decode($return, true);
    
    $fp = fopen('/home/ubuntu/workspace/publication/search/results/resultYoutube.json', 'w');
    fwrite($fp, json_encode($resultYoutube));
    fclose($fp);
	//exec('php search/yt.php '.$terminoBuscar);
	//exit("End YOUTUBE ".PHP_EOL);

}
function launchGoogle($terminoBuscar){
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    $query=$terminoBuscar;
    $num=5;
    $curl=curl_init('http://www.google.com./search?output=search&q="'.$query.'"&num='.$num."&gl=CO");    // Please study the url and params.   q=php or q={your keyword here}
    //$proxy="172.16.224.4:8080";
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data=curl_exec($curl);
    curl_close($curl);
    $mathces=array();
    preg_match_all('|<h3 class="r">.*?href="/url\?q=(.*?)&amp;.*?".*?</h3>|', $data, $mathces);
	$fp = fopen('/home/ubuntu/workspace/publication/search/results/resultGoogle.json', 'w');
    fwrite($fp, json_encode($mathces[1]));
    fclose($fp);
}
/*Funcion callInstagram*/
function callInstagram($url){
    $ch = curl_init();
    curl_setopt_array($ch, array(CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => 2
    ));

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function launchInstagram($terminoBuscar){
    $codea='3106448811.1677ed0.02f5e21af36e48719aac3932ffd35a68';
    /*hace el llamado a instagram*/
    $userarroa = $terminoBuscar;
    $userarroa=strtolower($userarroa);
    $client_id = "ab3366d4402245ac9da6ccc519c62a98";
    //$urlCount = 'https://api.instagram.com/v1/tags/'.$tag.'?access_token='.$codea;
    $url = 'https://api.instagram.com/v1/users/search?q='.$userarroa.'&access_token='.$codea.'&count=10';

    $inst_stream = callInstagram($url);
    //$inst_streamC = callInstagram($urlCount);
    $results = json_decode($inst_stream, true);
    /*Recorre la información de instagram*/
    $dataR=$results['data'];
    //print_r($dataR);
    $armaUsuario=json_encode($dataR);
    //var_dump($armaUsuario);
    /*Creacion de archivo json de instagram*/
    $fp = fopen('/home/ubuntu/workspace/publication/search/results/resultInstagram.json', 'w');
    fwrite($fp, $armaUsuario);
    fclose($fp);
}

if(isset($_COOKIE['idBrand']) && is_numeric($_COOKIE['idBrand'])){
	//BUSCO LA MARCA EN LA BASE DE DATOS
	$General= new General();
	$marca=$General->getInstanciaWhere("MpBrand",'','idBrand='.$_COOKIE['idBrand']);
	$terminoBuscar=$marca[0]->name;
	//cambia estado para que mrplow haga lo suyo 
	$mrplow =new Mrplow();
	$id =$_COOKIE['idBrand'];

	$mrplow->lunchReport($id,1,1); //lunchReport($idBrand,$idSocialNetwork,$idInteraction){
	$mrplow->lunchReport($id,2,1);
	launchFacebook($terminoBuscar);
	launchTwitter($terminoBuscar);
	launchInstagram($terminoBuscar);
	//launchYoutube($terminoBuscar);
	launchGoogle($terminoBuscar);
}
?>