<?php 
    
    //putenv("PHANTOMJS_EXECUTABLE=/home/ubuntu/workspace/publication/node_modules/phantomjs/bin/phantomjs");
     $sites = array();
    $string = file_get_contents($_SERVER['DOCUMENT_ROOT']."/publication/search/results/resultGoogle.json");
	//echo $_SERVER['DOCUMENT_ROOT']."/publication/search/results/resultGoogle.json";
	$json = json_decode($string, true);
	//var_dump($json);
   $res=shell_exec('rm -R '.$_SERVER['DOCUMENT_ROOT'].'/publication/search/pantallazo/*');
   //var_dump($res);
	foreach ($json as $key => $value) {
	 	///LANZO CASPER
	 	//echo "Desde php".$value.PHP_EOL;
	 	$sites['url']=$value;
	 	$sites['imagen']=$key;
	 	//echo 'casperjs --ignore-ssl-errors=true search/google.js --url="'.$value.'" --name="'.$key.'"';
	 	
	 	$res=shell_exec('casperjs --ignore-ssl-errors=true '.$_SERVER['DOCUMENT_ROOT'].'/publication/search/google.js --url="'.$value.'"');
		//echo json_encode($res);
		//sleep(1); 
	}
?>