<?php  

/**
* 
*/
class Fb extends MongoFb
{
	var $next;
	var $previous;
	function genTokenUser(){
		do{
			/* Inf Cliente */
			$APP_ID = '447234735433374';
			$APP_SECRET = 'f33555e6033034decce9cfce129174db';
			/*Se crea url*/
			$url = "https://graph.facebook.com/oauth/access_token?client_id=".$APP_ID."&client_secret=".$APP_SECRET."&grant_type=client_credentials";
			/*Se consulta*/
			$proxy="172.16.224.4:8080";
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_PROXY, $proxy);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HEADER, false);
			$token = curl_exec($curl);
			curl_close($curl);
		}while($token=="");
		$token="access_token=CAAGWwfOJZAp4BAC3zQwTUZBe9L8y1FB7xgZCCB7z0phvoNrSKvumDX17L0RXw6CSjZCMkOOj58MwjspMzkDZCvN2AzZC3t3rEOYPQHz9r2lARILQSIMCdZCLkojMyVOcwrBAhkWh76YU0yupulBAlu0X6VKlQfpyoBwzkQqzjWAG55NVeoHjZBcD";
		return $token;
	}

	function genToken(){
        if ($this->token=="") {
	        /* Inf Cliente */
        	$id_client="447234735433374";
	        $secret_client="f33555e6033034decce9cfce129174db";
	        $fechaMenosVeinteDias = date ( 'Y-m-d H:i:s' , strtotime ( '-60 day' , strtotime ( date('Y-m-d H:i:s') ) ) );
	        $tokenDb=parent::getTotalDatos("MpToken",['id','token'],'dateUpdate < "'.$fechaMenosVeinteDias.'" and status="S"');
	        if ($tokenDb!=false) {
	        	/*Se crea url*/
	        	$idToken=$tokenDb[0]->id;
	        	$user_token=$tokenDb[0]->token;
		        $token_url = "https://graph.facebook.com/oauth/access_token?client_id=".$id_client."&client_secret=".$secret_client."&grant_type=fb_exchange_token&fb_exchange_token=".$user_token;
		        /*Se consulta*/
		        $c = curl_init();
		        $proxy="172.16.224.4:8080";
		        curl_setopt($c, CURLOPT_PROXY, $proxy);
		        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
		        curl_setopt($c, CURLOPT_URL, $token_url);
		        $contents = curl_exec($c);
		        $err  = curl_getinfo($c,CURLINFO_HTTP_CODE);
		        curl_close($c);
		        $paramsfb = null;
		        parse_str($contents, $paramsfb);
		        $this->token="access_token=".$paramsfb['access_token'];
		        // Actualizamos el estado del anterior token a 'N'
		        parent::setUpdateInstancia("MpToken",array("status"=>"N"),array("id"=>$idToken));
		        // insertamos el nuevo token
		        parent::setUpdateInstancia("MpToken",array("token"=>$paramsfb['access_token'],"status"=>"S","dateUpdate"=>date('Y-m-d H:i:s')),array("token"=>$paramsfb['access_token']));
	        }else{
	        	$tokenDb=parent::getTotalDatos("MpToken",['token'],'status="S"');
	        	$this->token="access_token=".$tokenDb[0]->token;
	        }
        }
    }

	function app_request ($url="") {
		$proxy="172.16.224.4:8080";
	    $curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_PROXY, $proxy);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	    $result = curl_exec($curl);
	    curl_close($curl);
	    return objectToArray(json_decode($result));
	}

	/**
	Funcion Traer datos de facebook
	**/
	function getSaveData($url="",$insertFunc){
		$tipoQuery=strtolower($this->me);
		$start = microtime(true);
		$log= "\n\tdate: ". date("Y-m-d H:i:s");
		$this->guardarLog($log);
		$data=array();
		$error=0;
		$limitNext=$this->limitNext;
		do
		{
			$log="";
			// Consultamos los datos en fb
			$result=$this->app_request($url);
			if (isset($result['data'])) {
				$data= $result['data'];
			}elseif(isset($result[$tipoQuery]['data'])){
				$data= $result[$tipoQuery]['data'];
			}
			// Si hay error al consultar los datos en fb
			if (isset($result['error'])) {
				$log.="\n\n\t----- Ocurrio un error -----\n";
				$log.="\n\t\t- message: ".$result['error']['message'];
				$log.="\n\t\t- type: ".$result['error']['type'];
				$log.="\n\t\t- code: ".$result['error']['code']."";
				$log.="\n\t\t- url: ".$url;
				$log.="\n\t----- fin error -----\n";
				sleep(20);
				$error++;
				if ($result['error']['code']==100) {
					$log.="\n\t Se Elimino o no se encuentra disponible en facebook: ". $this->idPadreFb;
					$url="";
				}
				//Si el error esta mas de 4 veces reiniciamos url para pasar al siguienete y damos mensaje de fatal error
				if ($error>=5) {
					$log.="\n\t@@@@@@@@@@@@@@@@Fatal Error@@@@@@@@@@@@@@@@";
					$url="";
				}
			// Si hay  datos en fb
			}elseif (count($data)>0) {
				//Si se soluciona el error
				if ($error > 0) {
					$log.="\n\t======== :) Se soluciono el error ========";
					$error=0;
				}
				$log.="\n\tCount: ".count($data);
				// Traemos next
					if (isset($result[$tipoQuery]['paging']["next"])) {
						$next=$result[$tipoQuery]['paging']["next"];
					}elseif (isset($result['paging']["next"])){
						$next=$result['paging']["next"];
					}else{
						$next="";
					}
				// Traemos previous
					if (isset($result[$tipoQuery]['paging']["previous"])) {
						$previous=$result[$tipoQuery]['paging']["previous"];
					}elseif (isset($result['paging']["previous"])){
						$previous=$result['paging']["previous"];
					}else{
						$previous="";
					}
				//Si la siguiente consulta existe le damos los datos a url
				if (isset($result[$tipoQuery]['paging'][$this->direccion]) || isset($result['paging'][$this->direccion])) {
					$siguiente=(isset($result[$tipoQuery]['paging'][$this->direccion])) ? $result[$tipoQuery]['paging'][$this->direccion] : $result['paging'][$this->direccion];
					$url = $siguiente;
					$log.="\n\tHay siguiente: ".$url;
				//Si no existe next reiniciamos url
				}else{
					$siguiente="";
					$url = "";
				}
				// insertamos en la base de datos
				$this->next=$next;
				$this->previous=$previous;
				$this->insertMongo($data);
				$this->actualizarRegistro='N';
			// Si no hay  datos en fb reiniciamo url para terminar proceso
			}else{
				$log.="\n\tNo hay datos";
				$url="";
			}
			$this->guardarLog($log);
			// Salir del next parametro "limitNext"
			if ($limitNext>1) {
				$limitNext--;
			}else if ($limitNext==1 && $limitNext!=""){
				break;
			}
		}while(isset($url) && $url!="");
		// Cerramos tiempo de ejecucion
		$duracionRequest = microtime(true) - $start;
		$log="\n\tTiempo de ejecucion: : ".$duracionRequest . " s";
		// Guardamos Log
		$this->guardarLog($log);
	}

	function guardarLog($log){
		$file = fopen("logs/".self::$nameDbMongo.".log", "a");
		fwrite($file, $log . PHP_EOL);
		fclose($file);
	}

}

?>