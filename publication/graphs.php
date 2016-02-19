<?php
require("db/requires.php");

// $MongoNemo=new MongoNemo();
// $twConversations=$MongoNemo->getWordsTw();
// $numTwitter=count($twConversations);
// $arrayFechas=array();
// //printVar($twConversations);
// $n=0;
// $words = array();
// foreach ($twConversations as $key => $value) {
// 	# code...
// 	$words=array_merge($words,explode(" ",$value['text']));
// 	$fechaArray=$value['createdAt'];
// 	$fechaExp=explode("-", $fechaArray);
// 	$fechaNum=(int)$fechaExp[0].$fechaExp[1].$fechaExp[2];

// 	$fechaString=(int)$fechaExp[2].'-'.date('M',(int)$fechaExp[1]).'-'.substr($fechaExp[0], -2);
// 	$arrayFechas[$fechaNum]['count']=$arrayFechas[$fechaNum]['count']+1;
// 	$arrayFechas[$fechaNum]['date']=$fechaString;
// 	$n++;
// }
// //printVar($arrayFechas);
// $fp = fopen('search/results/dataLineChart.csv', 'w');
// fwrite($fp, 'date,close'.PHP_EOL);

// foreach ($arrayFechas as $key => $value) {
// 	# code...
// 	$stringData=$value['date'].",".$value['count'].PHP_EOL;
// 	fwrite($fp, $stringData);

// }
// fclose($fp);
// //Cuento las palabras en el array
// $orderWords=array_count_values($words);
// ///Ordeno de mayor a menos
// arsort($orderWords);
// //Cuento el total de palabras para saber el 100% 
// $wordCloud=array();
// $i=0;
// //printVar($total,"total");
// //Recorro y excluyo las palabras
// foreach ($orderWords as $key => $value) {
// 	# code...
// 	if($value<5){
// 		unset($orderWords[$key]);
// 	}else{
// 		$total++;
// 	}
// }
// //Armo el array final
// foreach ($orderWords as $key => $value) {
// 	# code...
// 		$wordCloud[$i]['word']=$key;
// 		$wordCloud[$i]['value']=$value;
// 		$wordCloud[$i]['perc']=($value*100)/$total;
// 		$wordCloud[$i]['med']=($wordCloud[$i]['perc']*30)/100;
// 		$i++;

// }
// if(isset($_COOKIE['idBrand']) && is_numeric($_COOKIE['idBrand'])){
// 	//BUSCO LA MARCA EN LA BASE DE DATOS
// 	$General= new General();
// 	$marca=$General->getInstanciaWhere("MpBrand",'','idBrand='.$_COOKIE['idBrand']);
// 	$nombreMarca=$marca[0]->name;
// }
// $smarty->assign('nombreMarca',$nombreMarca);
// $smarty->assign('wordCloud', $wordCloud);
$smarty->display("graphs.html");
?>
