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
 
 $m = new MongoClient();
//MongoClient();
   echo "Connection to database successfully<br>";
   // select a database
   $db = $m->nemo;
   echo "Database ac selected<br>";

   $hashC = $db->ins_hashtagsearch;
   //$fechaMongo= $db->fechaConsulta;
   echo "Collection selected ". $hashC." succsessfully<br>";

 
 //die();
require 'class/Instagram.php';

//use MetzWeb\Instagram\Instagram;
// initialize class
$instagram = new Instagram(array(
    'apiKey' => 'ab3366d4402245ac9da6ccc519c62a98',
    'apiSecret' => '38ca6d66f4124ceaa3e24ccbecbbc164',
    'apiCallback' => 'https://nemo-sebas1022.c9users.io/publication/success.php', // must point to success.php
    'scope'       => array('basic','public_content')
));
// receive OAuth code parameter
//$code = $_GET['code'];
$code = 'existo';

// check whether the user has granted access
if (isset($code)) {
    // receive OAuth token object
    $data = $instagram->getOAuthToken($code);
    $username = $data->user->username;
    // store user access token
    $instagram->setAccessToken($data);
    // now you have access to all authenticated user methods
    $result = $instagram->getUserMedia();
    //die();

    $limit=1;
    //$codea=$data->access_token;
   $codea='3106448811.1677ed0.02f5e21af36e48719aac3932ffd35a68';
    print_r($codea);
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

    $tag = 'jehgoddess';
    $client_id = "ab3366d4402245ac9da6ccc519c62a98";
    $urlCount = 'https://api.instagram.com/v1/tags/'.$tag.'?access_token='.$codea;
    $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?access_token='.$codea;

    $inst_stream = callInstagram($url);
    $inst_streamC = callInstagram($urlCount);
    $results = json_decode($inst_stream, true);
    $resultsCount = json_decode($inst_streamC, true);
   //printVar($resultsCount['data']['media_count']);
    $contadorTotal=$resultsCount['data']['media_count'];
    if(isset($results['pagination']['next_max_id'])){
        
        $pagination=$results['pagination']['next_max_id'];
    }else{
        $pagination='';
    }
    echo '<pre>';
    print_r($pagination);
    echo '</pre>';
    /*Recorre la información de instagram*/
    $dataR=$results['data'];
    print_r($dataR);

    /*Guarda conteo de instagram*/
    //$campos['cantidad']=$contadorTotal;
    //$conteoG=guardaTweet::guardaConteoInsta($campos);
    //printVar($conteoG);
    
$fechaG= new MongoDate(strtotime(date('Y-m-d H:m:s')));
$fechaMongoG=$fechaG->sec;

    //die();
    $conteoResultado=count($dataR);
    print_r($conteoResultado);
    print_r($contadorTotal);
    $repeticionesBase=(int)$contadorTotal-(int)$conteoResultado;
    $repeticiones=(int)$repeticionesBase/(int)$conteoResultado;
    print_r($repeticiones);
    //die();
    for ($i=0; $i < $conteoResultado; $i++) { 
        
        $imgUrl=$dataR[$i]['images']['standard_resolution']['url'];
        $fcreacion=date('Y-m-d H:i:s',$dataR[$i]['created_time']);
        $link=$dataR[$i]['link'];
        $type=$dataR[$i]['type'];
        //$link=$dataR[$i]['link'];
        $texto=$dataR[$i]['caption']['text'];
        $cantidadComentarios=$dataR[$i]['comments']['count'];
        $likesUrl=$dataR[$i]['likes']['count'];
        $username=$dataR[$i]['user']['username'];
        $userimg=$dataR[$i]['user']['profile_picture'];
        $idUsuarioIng=$dataR[$i]['user']['id'];
        $displayName=$dataR[$i]['user']['full_name'];
        
        /*Verifica si existe el  link para guardarlo u omitirlo*/
         $filtroTr=array('link'=>$link);
        //$orden=array('fechaConsultada'=>1);
         $consultLink=$hashC->find($filtroTr);
          echo '---------------------------------------';
        $cuentaL=$consultLink->count();
          echo '---------------------------------------';
       
         //die();
         if($cuentaL > 0){
            
             echo 'Ya guardamos esto';
         }else{
             /**/
              echo $link;
             $insHash = array( 
                    "link" => (string)$link,
      				'fechaCreacion'=> $fcreacion,
      				"imgUrl" => (string)$imgUrl,
      				"type" => (string)$type,
      				"texto" => (string)$texto,
      				"cantidadComentarios" => (string)$cantidadComentarios,
					"likesCount" => (string)$likesUrl,
					"username" => (string)$username,
					"userimg" => (string)$userimg,
					"idUsuarioIng" => (string)$idUsuarioIng,
					"displayName" => (string)$displayName,
					"fecha" => date('Y-m-d H:m:s'),
					"fechaM" => $fechaMongoG
  				 );
   				$hashC->insert($insHash);
   				
         }
       
        echo '---------------------------------------';
        //$guardarInsta = guardaTweet::guardaInstagram($campos);
        sleep(1);      
        
    }

    while ($i <=$repeticiones) {

        if(isset($paginationN)){

        $urlN = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?access_token='.$codea.'&max_id='.$paginationN;
        $paginado=$paginationN;
        }else{
            $urlN = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?access_token='.$codea.'&max_id='.$pagination;
            $paginado=$pagination;
        }

        $inst_streamN = callInstagram($urlN);
        $resultsN = json_decode($inst_streamN, true);
    
        
        $paginationN=$resultsN['pagination']['next_max_id'];
        echo '<pre>';
        print_r($paginationN);
        echo '</pre>';
        /*Recorre la información de instagram*/
        $dataRN=$resultsN['data'];
        //printVar($dataR);
        $conteoResultadoN=count($dataRN);
        for ($i=0; $i < $conteoResultadoN; $i++) { 
            
            $imgUrl=$dataRN[$i]['images']['standard_resolution']['url'];
            $fcreacion=date('Y-m-d H:i:s',$dataRN[$i]['created_time']);
            $link=$dataRN[$i]['link'];
            $type=$dataRN[$i]['type'];
            //$link=$dataRN[$i]['link'];
            $texto=$dataRN[$i]['caption']['text'];
            $cantidadComentarios=$dataRN[$i]['comments']['count'];
            $likesUrl=$dataRN[$i]['likes']['count'];
            $username=$dataRN[$i]['user']['username'];
            $userimg=$dataRN[$i]['user']['profile_picture'];
            $idUsuarioIng=$dataRN[$i]['user']['id'];
            $displayName=$dataRN[$i]['user']['full_name'];
            
            
             /*Verifica si existe el  link para guardarlo u omitirlo*/
         $filtroTr=array('link'=>$link);
        //$orden=array('fechaConsultada'=>1);
        $consultLink=$hashC->find($filtroTr);
          echo '---------------------------------------';
        $cuentaL=$consultLink->count();
          echo '---------------------------------------';
       
         //die();
         if($cuentaL > 0){
            
             echo 'Ya guardamos esto';
         }else{
             /**/
              echo $link;
             $insHash = array( 
                    "link" => (string)$link,
      				'fechaCreacion'=> $fcreacion,
      				"imgUrl" => (string)$imgUrl,
      				"type" => (string)$type,
      				"texto" => (string)$texto,
      				"cantidadComentarios" => (string)$cantidadComentarios,
					"likesCount" => (string)$likesUrl,
					"username" => (string)$username,
					"userimg" => (string)$userimg,
					"idUsuarioIng" => (string)$idUsuarioIng,
					"displayName" => (string)$displayName,
					"fecha" => date('Y-m-d H:m:s'),
					"fechaM" => $fechaMongoG
  				 );
   				$hashC->insert($insHash);
   				
         }
            echo '---------------------------------------';
            //$guardarInsta = guardaTweet::guardaInstagram($campos);
            sleep(1);      
        
    }
    }
    
} else {
    // check whether an error occurred
    if (isset($_GET['error'])) {
        echo 'An error occurred: ' . $_GET['error_description'];
    }
}
?>