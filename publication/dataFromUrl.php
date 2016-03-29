<?php 
error_reporting(E_ALL);
include 'db/requires.php';
if (isset($_POST['red']) && 
    isset($_POST['url']) && !empty($_POST['url'] )) {
    $red = $_POST['red'];
    $url = $_POST['url'];
    $find='0';
  //  printVar($url.'Url de post');
    //printVar($red,'flag de red 0->f, 1->t, 2->y');
    
    switch ($red) {
        case '0':
            $dividir = explode('/?',$url);
            $dividir =(is_array($dividir))?$dividir:explode('?',$url);
            $url=(is_array($dividir))?$dividir[0]:$dividir;
            $dividir =(is_array($dividir))?explode('www.facebook.com/',$dividir[0]):explode('www.facebook.com/',$dividir);
            $terminoBuscar = $dividir['1'];
            $app_access_token=genToken();
        	$resultFacebook=app_request("https://graph.facebook.com/v2.5/search?q=".$terminoBuscar."&type=page&limit=6&fields=id,name,link,picture.type(normal),likes&".$app_access_token);
        	for($i=0;$i<count($resultFacebook['data']);$i++){
        	 //   printVar($url,'url recortada');
        	 //  printVar($resultFacebook['data'][$i]['link']);
        	    if ($resultFacebook['data'][$i]['link'] == $url || $resultFacebook['data'][$i]['link'] == $url.'/' ){
            	$fp = fopen(/*$path.*/'/home/ubuntu/workspace/publication/search/results/resultFacebook.json', 'w');
            	fwrite($fp, json_encode($resultFacebook));
            	fclose($fp);
            	$find='1';
        	    }
        	}
        	if ($find != '0') {
        	   echo json_encode('1');
        	}else{
        	    echo json_encode('0');
        	}break;
        case '1':
            $dividir = explode('/?',$url);
            $dividir =(is_array($dividir))?$dividir:explode('?',$url);
            $urls=(is_array($dividir))?$dividir[0]:$dividir;
            $dividir =(is_array($dividir))?explode('twitter.com/',$dividir[0]):explode('twitter.com/',$dividir);
            $terminoBuscar = $dividir['1'];
            $url = "https://api.twitter.com/1.1/users/search.json";
            $query = array( 'count' => 6, 'q' => urlencode($terminoBuscar), "result_type" => "recent");
            $oauth_access_token = "336107062-3FRWmW9u2WqAD8K2BYkkhRyYPiuElAls5xGSPxHO";
            $oauth_access_token_secret = "EYOobKPmD0Ym4f30AEOM0xGjlfnaan1Vt17fkUYuJKOnY";
            $consumer_key = "zCYb1EGbavxyFI26TSCYpDVHT";
            $consumer_secret = "limIRUXH0FiFRVcdDpOi6SwAxt3ZZpNvj58P2WVXr5mspF0J7t";
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
           for ($i = 0; $i < count($resultTwitter); $i++) {
                 if ($resultTwitter[$i]->screen_name == $terminoBuscar) {
                    	$resultTwitter=$resultTwitter[$i];
                    	$fp = fopen('/home/ubuntu/workspace/publication/search/results/resultTwitter.json', 'w');
            	        $arr[0]=$resultTwitter;
            	        fwrite($fp, json_encode($arr));
            	        fclose($fp);
            	        $control='existe';
                 }  
            }
            if (isset($control) ) {
                echo json_encode('2'); 
                break;
            }else{echo json_encode('0');} break;
            
        case '2':
            $dividir = explode('/user/',$url);
            $dividir =(is_array($dividir))?$dividir:explode('/channel/',$url);
            $search = $dividir['1'];  
            $key_api="AIzaSyC1PB5ml8U32_sqIknk33VJZb5CmtQ1v0Q";
            $limit=25;
          //  printVar($search,'search');
            $order="relevance";
            $url = "https://www.googleapis.com/youtube/v3/search?key=".$key_api."&part=snippet&type=channel&maxResults=".$limit."&order=".$order."&q=".$search;
            $curl = curl_init($url);
            // $proxy="172.16.224.4:8080";
            curl_setopt($curl, CURLOPT_PROXY, $proxy);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $return = curl_exec($curl);
            curl_close($curl);
            $resultYoutube = json_decode($return, true);
          //printVar($resultYoutube);
           // printVar(count($resultYoutube['items']));
            for ($i = 0; $i < count($resultYoutube['items']); $i++) {
               // printVar($resultYoutube['items'][$i],'items traidos de youtube');
            //    printVar($search,'search');
                if ($resultYoutube['items'][$i]['snippet']['title'] == $search) {
                   
                    $resultYoutube= $resultYoutube['items'][$i];
                    $arr['items'][0] =$resultYoutube;
                   $fp = fopen('/home/ubuntu/workspace/publication/search/results/resultYoutube.json', 'w');
                     fwrite($fp, json_encode($arr));
                    fclose($fp);
                }
            }
            echo json_encode('3');
    }//fin del switch  
    
} // fin if que pregunta por datos por post
else {
    echo 'no viene nada';
}
?>