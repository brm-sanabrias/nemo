<?php
/* 
Clase Para las graficas
*/
class Graphs {
    /* 
    Constructor De la variable
    */
    public function __construct(){
        $this->idBrand = $_COKKIE['idBrand'];
        $this->fechaInicio = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s"). ' - 15 days'));
        $this->fechaFin = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s"). ' - 1 days'));
        $this->varMongo=new MongoNemo();
    }
    function superGraficadora(){
        $Datos=new array();
        ///Linea de tiempo
        $Datos['lineaDeTiempo']=lineaDeTiempo();
        ///WordCloud
        $Datos['wordCloud']=wordCloud();
        ///# Conversaciones
        $Datos['conversaciones']=conversaciones();
        ///Generos 
        $Datos['generos']=generos();
        ///Demografia
        $Datos['demografia']=demografia();
        ///Return
        return $Datos;
        
    }
    function lineaDeTiempo(){
        
    }
    function wordCloud(){
        $twConversations=$this->varMongo->getWordsTw($this->fechaInicio,$this->fechaFin);
        $numTwitter=count($twConversations);
        $arrayFechas=array();
        //printVar($twConversations);
        $n=0;
        $words = array();
        foreach ($twConversations as $key => $value) {
            # code...
            $words=array_merge($words,explode(" ",$value['text']));
            $fechaArray=$value['createdAt'];
            $fechaExp=explode("-", $fechaArray);
            $fechaNum=(int)$fechaExp[0].$fechaExp[1].$fechaExp[2];
            $fechaString=(int)$fechaExp[2].'-'.date('M',(int)$fechaExp[1]).'-'.substr($fechaExp[0], -2);
            $arrayFechas[$fechaNum]['count']=$arrayFechas[$fechaNum]['count']+1;
            $arrayFechas[$fechaNum]['date']=$fechaString;
            $n++;
        }

        //Cuento las palabras en el array
        $orderWords=array_count_values($words);
        ///Ordeno de mayor a menos
        arsort($orderWords);
        //Cuento el total de palabras para saber el 100% 
        $wordCloud=array();
        $i=0;
        //printVar($total,"total");
        //Recorro y excluyo las palabras
        foreach ($orderWords as $key => $value) {
            # code...
            if($value<5){
                unset($orderWords[$key]);
            }else{
                $total++;
            }
        }
        //Armo el array final
        foreach ($orderWords as $key => $value) {
            # code...
            $wordCloud[$i]['word']=$key;
            $wordCloud[$i]['value']=$value;
            $wordCloud[$i]['perc']=($value*100)/$total;
            $wordCloud[$i]['med']=($wordCloud[$i]['perc']*30)/100;
            $wordCloud[$i]['color']='#'.random_color();
            $i++;
        }  
    }
    function conversaciones(){
        
    }
    function generos(){
        
    }
    function demografia(){
        
    }
}

?>