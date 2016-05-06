<?php
require("db/requires.php");


if (isset($_POST['asd']) && !empty($_POST['asd'])) {
    $facebook=[1, 5, 2, 4, 8, 5, 8, 8, 4, 2, 1, 7, 3, 6,5, 10, 4, 2, 5, 10,8, 5, 8, 8, 4, 2, 1, 7, 3,5];
$twitter =[6, 2, 9, 2, 5, 10, 4, 2, 5, 10,8, 5, 8, 8, 2, 4, 8, 5, 8, 8, 4, 2, 1, 7, 3, 6,5, 10,1, 7];
$youtube =[8, 4, 2, 1, 7, 3, 6, 5, 2, 9, 2, 5, 8, 4, 2, 1, 7, 3, 6,5, 10, 4, 2, 5, 10,5, 10, 4, 2, 5];
$data=[$facebook,$twitter,$youtube];
    echo json_encode($data);
}

/*Script de prueba primer if (dia) devuelve datos de pruebas para el filtro de dia Rango de fechas min = fecha actual - 15 dias(como maximo); max= dia actual*/
if (isset($_POST['dia']) && !empty($_POST['dia'])) {
   // echo 'esta entrando';
    $min=$_POST['min']; //rango de dias atras de la fecha actual
    $max=$_POST['max']; // dia actual 
    $ultimo=$_POST['ultDiaMesPasado']; // si paso al mes anterior 
    /*codigo de prueba; simula consulta mongo*/
    if ($min>$max) {// si el rango es mayor al dia actual 
        $sobra = (int)$min-(int)$max;
        $desde=(int)$ultimo-$sobra;
        $hasta = $desde+(int)$min;
        $temp=$desde;
        
        $facebook = array();
        $twitter  = array();
        $youtube = array();
        $data=array();
        for ($desde; $desde <= $hasta; $desde++) {
            array_push($facebook,rand(1, 15));
            array_push($twitter,rand(1, 15));
            array_push($youtube,rand(1, 15));
             if ($temp==$ultimo) {
                array_push($data,$temp);
                $temp=1;
             }else{
                 array_push($data,$temp);
                 $temp++;
             }
        }
        $datas=[$facebook,$twitter,$youtube,$data];
    }else{
        $desde=(int)$max - (int)$min+1 ;
        $hasta=(int)$max;
    //echo $hasta;
         $facebook = array();
        $twitter  = array();
        $youtube = array();
        $data=array();
        for ($desde; $desde <= $hasta; $desde++) {
            array_push($facebook,rand(1, 15));
            array_push($twitter,rand(1, 15));
            array_push($youtube,rand(1, 15));
            array_push($data,$desde);
        }
    $datas=[$facebook,$twitter,$youtube,$data];
    }
    
    echo json_encode($datas);
}
/*Script de prueba segundo if (mes) devuelve datos de pruebas para el filtro de mes min=mes actual - 6 meses(maximo); max=mes actual */
if (isset($_POST['mes']) && !empty($_POST['mes'])) {
    $min=$_POST['min'];
    $max=$_POST['max'];
   // printVar($min,'min');
    //printVar($max,'max');
    $splitMin=explode('-',$min);
    $splitMax=explode('-',$max);  
    $minMes= intval($splitMin[1]);
    $maxMes=intval($splitMax[1])+1; //hay que subirle una unidad al mes actual
    $meses=['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
    $label=[];
    $count=0;
    if ($maxMes>$minMes) { //si el mes actual (numero) es mayor al otro mes
        $count=($maxMes-$minMes)+1;
    }else{ //si el otro mes es mayor
        
        $count=(12-$minMes)+$maxMes+1;
    }
    /*armando el periodo de tiempo */
        $facebook = array();
        $twitter  = array();
        $youtube  = array();
        $labels   = array();
        if ($count>6) {  //se forza a que sean los ultimos 6 meses
            $count=6;
        }
        $temp=$maxMes;
    for ($i = 1; $i <= $count; $i++) {
         array_push($facebook,rand(1, 15));
         array_push($twitter,rand(1, 15));
         array_push($youtube,rand(1, 15));
         //llenando el arreglo con los labels del eje x de la grafica
         if ($temp==1) {
            array_push($labels,$temp);
            $temp=12;
         }else{
             array_push($labels,$temp);
             $temp--;
         }
         
    }
    $data=[$facebook,$twitter,$youtube,$labels];
  // printVar($data);
  echo json_encode($data);
}
/*tercer if devuelve datos para el filtro por año */
if (isset($_POST['year']) && !empty($_POST['year'])) {
    /*max = ano-mes-dia(fecha actual) ;  min=ano*/
    $min=$_POST['min'];
    $max=$_POST['max'];
   // printVar($min,'min');
    //printVar($max,'max');
   
    $splitMax=explode('-',$max);  
    $minAno= intval($min);
    $maxAno=intval($splitMax[0]); 
    $maxMes=intval($splitMax[1]);
    $meses=['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
    $label=[];
    $count=0;
    
    if ($maxAno==$minAno) {
        $count=$maxMes+1;//se suma una unidad al mes
    }else{
        $count=(($maxAno-$minAno)*12)+$maxMes+1;
    }
    /*armando el periodo de tiempo */
        $facebook = array();
        $twitter  = array();
        $youtube  = array();
        $labels   = array();
        
        $temp=$maxMes;
    for ($i = 1; $i <= $count; $i++) {
         array_push($facebook,rand(1, 15));
         array_push($twitter,rand(1, 15));
         array_push($youtube,rand(1, 15));
         //llenando el arreglo con los labels del eje x de la grafica
         if ($temp==1) {
            array_push($labels,$temp);
            $temp=12;
         }else{
             array_push($labels,$temp);
             $temp--;
         }
         
    }
    $data=[$facebook,$twitter,$youtube,$labels];
  // printVar($data);
    
    echo json_encode($data);
}

/*cuarto if devuelve datos para el filtro por fechas puntuales */
if (isset($_POST['picker']) && !empty($_POST['picker'])) {
    /*max = ano-mes-dia(fecha actual) ;  min=ano*/
    $min=$_POST['min'];
    $max=$_POST['max'];
    $facebook = array();
    $twitter  = array();
    $youtube  = array();
    $labels   = array();
    //printVar($min,'min');
    //printVar($max,'max');
   
    $splitMax=explode('-',$max); 
    $splitMin=explode('-',$min);
    $maxDia=intval($splitMax[2]);
    $maxMes=intval($splitMax[1]);
    $maxAno=intval($splitMax[0]);
   
    $minDia=intval($splitMin[2]);
    $minMes=intval($splitMin[1]);
    $minAno=intval($splitMin[0]);
     
    if ($maxAno==$minAno) { //las dos fechas se ubican en el mismo año 
        if ($maxMes==$minMes) { // si son el mismo año y son mismo mes 
            $count = ((int)$maxDia-(int)$minDia)+1;
            $temp=$maxDia;
            for ($i = 0; $i < $count; $i++) {
                 array_push($facebook,rand(1, 15));
                 array_push($twitter,rand(1, 15));
                 array_push($youtube,rand(1, 15));
                 array_push($labels,$temp);
                 $temp--;
            }//for
            $data=[$facebook,$twitter,$youtube,$labels];
        }/*if 2do nivel*/else{// es el mismo año pero no es el mismo mes Contar en consulta por mes 
            $count = ((int)$maxMes-(int)$minMes)+1;
             $meses=['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
            $temp=$maxMes;
            for ($i = 0; $i < $count; $i++) {
                 array_push($facebook,rand(1, 15));
                 array_push($twitter,rand(1, 15));
                 array_push($youtube,rand(1, 15));
                 if ($temp==1) {
                     // code...
                     array_push($labels,$meses[(int)$temp-1]);
                     $temp=12;
                 }else{
                     array_push($labels,$meses[(int)$temp-1]);
                     $temp--;
                 }
            }//for
            $data=[$facebook,$twitter,$youtube,$labels];
        }
    }else{//no son en el mismo año 
       /* $maxAno
        $minAno
        $maxMes
        $minMes*/
            
        if ( ((int)$maxAno-(int)$minAno) ==1 ) { //solo hay un año o menos de diferencia
            $count=(12-(int)$minMes) +$maxMes+1;
            $meses=['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
            $temp=$maxMes;
            for ($i = 0; $i < $count; $i++) {
                 array_push($facebook,rand(1, 15));
                 array_push($twitter,rand(1, 15));
                 array_push($youtube,rand(1, 15));
                 if ($temp==1) {
                     // code...
                     array_push($labels,$meses[0]);
                     $temp=12;
                 }else{
                     array_push($labels,$meses[(int)$temp-1]);
                     $temp--;
                 }
            }
            $data=[$facebook,$twitter,$youtube,$labels];
        }
    }
    //$data=[$facebook,$twitter,$youtube,$labels];
    // printVar($data);
    echo json_encode($data);
}



?>