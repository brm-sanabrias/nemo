<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
$query=$_POST['search'];
$num=5;
$curl=curl_init('http://www.google.com.co/search?output=search&q='.$query.'&num='.$num);    // Please study the url and params.   q=php or q={your keyword here}
$proxy="172.16.224.4:8080";
//curl_setopt($curl, CURLOPT_PROXY, $proxy);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$data=curl_exec($curl);
curl_close($curl);
$mathces=array();
preg_match_all('|<h3 class="r">.*?href="/url\?q=(.*?)&amp;.*?".*?</h3>|', $data, $mathces);
//echo"<pre>";
//print_r($mathces[1]);
echo json_encode($mathces[1]);

?>