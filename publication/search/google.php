<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
$query=$argv[1];
$query="adidas";
$num=10;
$curl=curl_init('http://www.google.com.co/search?output=search&q="'.$query.'"&num='.$num."&gl=CO");    // Please study the url and params.   q=php or q={your keyword here}
$proxy="172.16.224.4:8080";
//curl_setopt($curl, CURLOPT_PROXY, $proxy);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$data=curl_exec($curl);
curl_close($curl);
$mathces=array();
preg_match_all('|<h3 class="r">.*?href="/url\?q=(.*?)&amp;.*?".*?</h3>|', $data, $mathces);
//echo"<pre>";
print_r($mathces[1]);
$fp = fopen('/Users/Sebas/Documents/BRM/GitHub/nemo/publication/search/results/resultGoogle.json', 'w');
fwrite($fp, json_encode($mathces[1]));
fclose($fp);

?>