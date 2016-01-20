<?php  
@ini_set("display_errors","1");
@error_reporting(E_ALL);

function queryTwitter($search) 
{
    $url = "https://api.twitter.com/1.1/users/search.json";
    //if($search != "")
        //$search = "#".$search;
    $query = array( 'count' => 100, 'q' => urlencode($search), "result_type" => "recent");
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
        $proxy="172.16.224.4:8080";

    $options = array( CURLOPT_HTTPHEADER => $header,
                      CURLOPT_HEADER => false,
                      CURLOPT_URL => $url,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_SSL_VERIFYPEER => false,
                      CURLOPT_PROXY=>$proxy);

    $feed = curl_init();
    curl_setopt_array($feed, $options);
    $json = curl_exec($feed);
    curl_close($feed);
    return  json_decode($json);
}

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
$terminoBuscar=$argv[1];
$resultTwitter=queryTwitter($terminoBuscar);
$fp = fopen('/Users/Sebas/Documents/BRM/GitHub/nemo/publication/search/results/resultTwitter.json', 'w');
fwrite($fp, json_encode($resultTwitter));
fclose($fp);
?>