<?php  

/**
* 
*/
class MongoFb extends General
{
	public static $nameDbMongo;
	var $PowerArray=array();
	//--Conexion mongo

	public function mongoConnect($collection=""){
		/**** Config mongo ****/
		$dbhost = 'localhost';
		$dbname = self::$nameDbMongo;
		$mongo = new MongoClient("mongodb://$dbhost");
		$barredora = $mongo->$dbname;
		if ($collection=="") {
			return $barredora;
		}else{
			return $barredora->$collection;
		}
		/****/
	}

	public function insertMongo($arrayDimensions){
		$nameIdMe='id'.$this->me.'Fb';
		$meLower=strtolower($this->me);
		foreach ($arrayDimensions as $key => $value) {
			$this->PowerArray=array();
			$datos=$this->arrayReacher($value,'');
			$meMongo = $this->mongoConnect($meLower);
			// actuliza
			if ($this->actualizarRegistro=="S") {
				$meMongo->update([ $nameIdMe => $value['id'] ],$datos,[ 'upsert' => true ]);
			}else
			// inserta 
			{
				$meMongo->insert($datos);
			}
		}
	}

   //Recorre cada una de las dimensiones de un arreglo
	public function arrayReacher($arrayN,$father){
		if (count($arrayN)>0) {
			$idMe=(isset($arrayN['id'])) ? $arrayN['id'] : "";
			$father= ($father=="") ? "data" : $father ;
	    	foreach ($arrayN as $key => $value) {
				$father1="";	
				$key=str_replace(".", "_", $key);
				if(is_array($value)){
					$father1=(is_int($key)) ? "" : $father."_".$key  ;
					$this->arrayReacher($value,$father1);
				} else{
					$value=str_replace(["\n",";"], [" ",","],$value);
					$this->PowerArray[$father."_".$key]=$value;
					if ($this->reply!="") {
						$this->PowerArray['reply']=$this->reply;
						if ($this->reply=="S") {
							$nameIdPadre='idReply'.$this->padre.'Fb';
						}else{
							$nameIdPadre='id'.$this->padre.'Fb';
						}
					}else{
						$nameIdPadre='id'.$this->padre.'Fb';
					}
					$nameIdMe='id'.$this->me.'Fb';
					$this->PowerArray[$nameIdMe]=$idMe;
					$this->PowerArray[$nameIdPadre]=$this->idPadreFb;
					$this->PowerArray['idFanpage']=$this->idFanpage;
					$this->PowerArray['direccion']=$this->direccion;
					$this->PowerArray['next']=$this->next;
					$this->PowerArray['previous']=$this->previous;
					$this->PowerArray['dateMysql']=date("Y-m-d H:i:s");
					$this->PowerArray['dateMongo'] = new MongoDate();
					
					
					if ($this->padre!="Fanpage") {
						$this->PowerArray['idFanpageFb'] = $this->idFanpadeFb;
					}
				}
	    	}
		}
    	return $this->PowerArray;
	}

}

?>