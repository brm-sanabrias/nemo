<?php
// Documentación : https://developers.google.com/youtube/v3/docs/search/list?hl=es
$key_api="AIzaSyC1PB5ml8U32_sqIknk33VJZb5CmtQ1v0Q";
$limit=30;
$search="mango";
// Order Fields = date, rating, relevance, title, videoCount, viewCount
$order="rating";
$url = "https://www.googleapis.com/youtube/v3/search?key=".$key_api."&part=snippet&type=channel&maxResults=".$limit."&order=".$order."&q=".$search;
$curl = curl_init($url);
$proxy="172.16.224.4:8080";
curl_setopt($curl, CURLOPT_PROXY, $proxy);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$return = curl_exec($curl);
curl_close($curl);
$result = json_decode($return, true);
echo"<pre>";
print_r($result);
?>