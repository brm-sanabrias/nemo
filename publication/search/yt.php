<?php
// Documentación : https://developers.google.com/youtube/v3/docs/search/list?hl=es
$key_api="AIzaSyC1PB5ml8U32_sqIknk33VJZb5CmtQ1v0Q";
$limit=6;
$search=$argv[1];

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

$fp = fopen('/Users/Sebas/Documents/BRM/GitHub/nemo/publication/search/results/resultYoutube.json', 'w');
fwrite($fp, json_encode($resultYoutube));
fclose($fp);
?>