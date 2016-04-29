<?php 
    
    //putenv("PHANTOMJS_EXECUTABLE=/home/ubuntu/workspace/publication/node_modules/phantomjs/bin/phantomjs");
     $sites = array();
    $string = file_get_contents("/home/ubuntu/workspace/publication/search/results/resultGoogle.json");
	$json = json_decode($string, true);
   shell_exec('rm -R /home/ubuntu/workspace/publication/search/pantallazo/*');
   
	foreach ($json as $key => $value) {
	 	///LANZO CASPER
	 	//echo "Desde php".$value.PHP_EOL;
	 	$sites['url']=$value;
	 	$sites['imagen']=$key;
	 	echo 'casperjs --ignore-ssl-errors=true search/google.js --url="'.$value.'" --name="'.$key.'"';
	 	
	 	shell_exec('casperjs --ignore-ssl-errors=true /home/ubuntu/workspace/publication/search/google.js --url="'.$value.'"');
	
		//sleep(1); 
	}
?>