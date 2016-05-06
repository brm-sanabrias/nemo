<?php

/**
* 
*/
class Barredora extends Fb
{
	var $idFanpage;
	var $me;
	var $padre;
	var $camposTraer;
	var $direcciones;
	var $since;
	var $until;
	var $idPadreFb;
	var $actualizarRegistro;
	var $direccion;
	var $otherUrl;
	var $limite;
	var $limitNext;
	var $desdeCeros;
	var $meSearch;
	var $token="";
	var $reply="";

	function __construct($conf)
	{
		self::$nameDbMongo=$conf['nameCollection'];
		$this->idFanpage=$conf['idFanpage'];
		$this->me=$conf['me'];
		$this->padre=$conf['padre'];
		$this->direcciones=$conf['direcciones'];
		$this->since=(strtotime($conf['since'])=="") ? "" : "&since=".strtotime($conf['since']);
		$this->until=(strtotime($conf['until'])=="") ? "" : "&until=".strtotime($conf['until']);
		$this->otherUrl=$conf['otherUrl'];
		$this->limite=($conf['limite'] != "") ? "limit(".$conf['limite'].")" : "";
		$this->camposTraer=($conf['camposTraer'] != "") ? "&fields=".implode(",", $conf['camposTraer']) : "";
		$this->limitNext=($conf['limitNext'] > 0) ? $conf['limitNext'] : "";
		$this->desdeCeros=$conf['desdeCeros'];
		$this->meSearch=$conf['meSearch'];
		$this->reply=$conf['reply'];
	}

	function start(){
		$meLower=strtolower($this->me);
		$meSearch=strtolower($this->meSearch);
		$padreLower=strtolower($this->padre);
		$padreMongo = $this->mongoConnect($padreLower);
		$meMongo = $this->mongoConnect($meLower);
		$nameIdPadre='id'.$this->padre.'Fb';
		$nameIdPadreMe=($this->reply=="S") ? 'idReply'.$this->padre.'Fb' : $nameIdPadre ;
		// Cabiar Nombre de la tabla "Fanpage"
		if ($this->padre=="Fanpage") {
			$padreRows=parent::getTotalDatos("MpBrandXSocialNetwork",['snID'],'id='.$this->idFanpage);
		}else{
			//$padreRows=iterator_to_array($padreMongo->find(["idFanpageFb"=>$this->idFanpage],[$nameIdPadre=>1,"idFanpageFb"=>1]));
			if ($this->reply=="S") {
				$padreRows=iterator_to_array($padreMongo->find(["idFanpage"=>$this->idFanpage,"reply"=>"N"]));
			}else{
				$padreRows=iterator_to_array($padreMongo->find(["idFanpage"=>$this->idFanpage]));
			}
		}

		$nPadre=count($padreRows);
		$replyIdTemp=($this->reply=="S") ? "Reply" : "";
		$idTempDb=parent::getTotalDatos("MpIdTemp",['idFbField'],'typeFbField="'.$this->me.$replyIdTemp.'" and idBrandXSocialNetwork='.$this->idFanpage);
		$tempIdPadreFb=(count($idTempDb)>0) ? $idTempDb[0]->idFbField : "";
		$titleReply = ($this->reply=="S") ? " reply " : "" ;
		$log="\n\n/******* Empezo nuevo request de ".$this->me.$titleReply." - ". date("Y-m-d H:i:s") . " *******/\n\nTotal ".$this->padre.": ".$nPadre."\n";
		$this->guardarLog($log);
		$estadoReload=0;
		
		foreach ($padreRows as $padre) {
			if ($this->padre=="Fanpage") {
				$this->idPadreFb=(isset($padre->snID)) ? $padre->snID : $padre["idFanpage"];
			}else{
				$this->idFanpadeFb=(isset($padre->idFanpageFb)) ? $padre->idFanpageFb : $padre["idFanpageFb"];
				$this->idPadreFb=(isset($padre->$nameIdPadre)) ? $padre->$nameIdPadre : $padre[$nameIdPadre];
			}

			//--Si se cae el servidor, va a realizar el proceso en el ultimo idFanpage que termino 
			$estadoReload=($estadoReload==0 && $tempIdPadreFb==$this->idPadreFb) ? 1: $estadoReload;
			if ($tempIdPadreFb=="" || $estadoReload==1) {
				$log= "\n\n### ".$this->padre." : ".$this->idPadreFb." - ".$nPadre." ###\n";
				$this->guardarLog($log);
				//Recorremos las direcciones (next,previous)
				foreach ($this->direcciones as $direccion) {
					$logDireccion="\nDireccion: ".$direccion;
					$this->guardarLog($logDireccion);
					// miramos si existen post con el idFanpage en la base de datos

					$meExiste=$meMongo->findOne([$nameIdPadreMe=>$this->idPadreFb, "direccion" => $direccion]);

					/*printVar($meExiste);
					printVar($nameIdPadreMe);
					printVar($this->idPadreFb);die;*/
					// Si no hay post en la base de datos
					if ((count($meExiste)==0 && $direccion=="next") || ($this->desdeCeros=="S" && $direccion=="next"))
					{
						$this->actualizarRegistro='N';
						$this->genToken();
						$url="https://graph.facebook.com/v2.5/".$this->idPadreFb."/".$meSearch.$this->otherUrl."?".$this->limite.$this->since.$this->until.$this->camposTraer."&filter=stream&".$this->token;
					}else
					// 
					if ((count($meExiste)==0 && $direccion=="previous") || ($this->desdeCeros=="S" && $direccion=="previous"))
					{
						$primerPrevious=$meMongo->find([$nameIdPadreMe=> $this->idPadreFb],['previous'=>1])->limit(1)->sort(['dateMysql'=>1]);
						foreach (iterator_to_array($primerPrevious) as $key => $value) {$urlPrevious=$value['previous'];}
						$this->actualizarRegistro='N';
						$url=(isset($urlPrevious) && $urlPrevious!="") ? $urlPrevious : "";
					}/*else
					// Si hay post en la base de datos
					{
						// Traemos los ultimos dos next
						$limitNext=$this->limite+1;
						if ($this->reply!="") {
							$data=$meMongo->find([$nameIdPadreMe=> $this->idPadreFb,'direccion'=>$direccion, "reply" => $this->reply],[$direccion=>1])->limit($limitNext)->sort(['dateMysql'=>-1]);
						}else{
							$data=$meMongo->find([$nameIdPadreMe=> $this->idPadreFb,'direccion'=>$direccion],[$direccion=>1])->limit($limitNext)->sort(['dateMysql'=>-1]);
						}
						//$data=$meMongo->find([$nameIdPadreMe=> $this->idPadreFb,'direccion'=>$direccion],[$direccion=>1])->limit($limitNext)->sort(['dateMysql'=>-1]);
						$nextDB=[];
						foreach (iterator_to_array($data) as $key => $value) {
							if (!in_array($value[$direccion], $nextDB)) {
								array_push($nextDB, $value[$direccion]);
							}
						}
						$urlUltimoNextDB=(isset($nextDB[0])) ? $nextDB[0] : "";
						$urlPenultimoNextDB=(isset($nextDB[1])) ? $nextDB[1] : "";
						//Si no hay next y tampoco hay urlPenultimoNextDB
						if ($urlUltimoNextDB == "" && $urlPenultimoNextDB=="") {
							$this->actualizarRegistro='S';
							$this->genToken();
							$url="https://graph.facebook.com/v2.5/".$this->idPadreFb."/".$meSearch.$this->otherUrl."?".$this->limite.$this->since.$this->until.$this->camposTraer."&filter=stream&".$this->token;
						}else
						// Si el num de registros del ultimo next es menos o mayor al limite, va al penultimo next
						{
							$this->actualizarRegistro='S';
							$url = ($urlPenultimoNextDB != "") ? $urlPenultimoNextDB : $urlUltimoNextDB;
						}
					}*/
					$log=($this->actualizarRegistro=="S")? "\nActualizando....." : "";
					$this->guardarLog($log);
					$this->direccion=$direccion;
					//Consulta datos y guarda en mongo
					if ($url!="") {
						$this->getSaveData($url,"insertPost");
					}else{
						// Guardamos Log no hay datos
						$log="\n\tNo hay datos";
						$this->guardarLog($log);
						break(2);
					}
					// Guardamos idFanpage en temporal
					$this->setUpdateInstancia("MpIdTemp",['idFbField'=> $this->idPadreFb,'idBrandXSocialNetwork'=>$this->idFanpage],["typeFbField"=>$this->me.$replyIdTemp,"idBrandXSocialNetwork"=>$this->idFanpage]);
				}
			}
			$nPadre--;
		}
		//Reiniciamos temporal vacio
		$this->setUpdateInstancia("MpIdTemp",['idFbField'=> ""],["typeFbField"=>$this->me.$replyIdTemp,"idBrandXSocialNetwork"=>$this->idFanpage]);
		// Guardamos Log
		$log="\n\n/******* Termino Request de ".$this->me.$titleReply." - ". date("Y-m-d H:i:s") . "*******/";
		$this->guardarLog($log);
		//$this->export();
	}

	function export(){
		$exportFile = file_get_contents('export.txt');
		$export=str_replace("fb_name_db", self::$nameDbMongo, $exportFile);
		shell_exec($export);
	}
}

?>