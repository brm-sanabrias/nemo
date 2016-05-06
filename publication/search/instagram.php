<?php
ini_set('display_errors','1');
error_reporting(E_ALL);
//require("db/requires.php");
//require_once("class/guardaTweet.php");

/**
 * Instagram PHP API
 *
 * @link https://github.com/cosenary/Instagram-PHP-API
 * @author Christian Metz
 * @since 01.10.2013
 */
 

require '../class/Instagram.php';

//use MetzWeb\Instagram\Instagram;
// initialize class
$instagram = new Instagram(array(
    'apiKey' => 'ab3366d4402245ac9da6ccc519c62a98',
    'apiSecret' => '38ca6d66f4124ceaa3e24ccbecbbc164',
    'apiCallback' => 'https://nemo-sebas1022.c9users.io/publication/successusr.php', // must point to success.php
    'scope'       => array('basic','public_content')
));
// receive OAuth code parameter
//$code = $_GET['code'];



    $limit=1;
    //$codea=$data->access_token;
    $codea='3106448811.1677ed0.02f5e21af36e48719aac3932ffd35a68';
    //print_r($codea);
    // Get recently tagged media
    function callInstagram($url)
    {
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

    $userarroa = 'mentedecadente';
   $userarroa=strtolower($userarroa);
    $client_id = "ab3366d4402245ac9da6ccc519c62a98";
    //$urlCount = 'https://api.instagram.com/v1/tags/'.$tag.'?access_token='.$codea;
    $url = 'https://api.instagram.com/v1/users/search?q='.$userarroa.'&access_token='.$codea;

    $inst_stream = callInstagram($url);
    //$inst_streamC = callInstagram($urlCount);
    $results = json_decode($inst_stream, true);
    
    
   //print_r($results['data']);
    
    
  
    //$resultsCount = json_decode($inst_streamC, true);
   //printVar($resultsCount['data']['media_count']);
    //$contadorTotal=$resultsCount['data']['media_count'];

    /*Recorre la información de instagram*/
    $dataR=$results['data'];
    //print_r($dataR);
    $armaUsuario=json_encode($dataR);
    var_dump($armaUsuario);
  die();
    /*Guarda conteo de instagram*/
    //$campos['cantidad']=$contadorTotal;
    //$conteoG=guardaTweet::guardaConteoInsta($campos);
    //printVar($conteoG);
    


?>