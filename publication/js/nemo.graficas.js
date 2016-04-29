//cambio de tamaño de card seleccionada

//variable de control que guarda el numero de puntos en la ultima grafica, es usada para borrar esos puntos a la hora de actualizar la grafica 
var puntosLinea=0;

$(document).ready(function () {
  
  /*botones de dia/mes/año para seleccionar rango  */
   $('.filtros .btn').click(function(event) {
     /*Para cambiar los rangos en el filtro*/
        event.preventDefault();
        event.stopPropagation();
        
        var tipo = $(this).attr('id');
        var rango  = $('#rango');
         
        switch(tipo){
          case 'dia':
            var arreglo=ultimos15Dias();
            var min=arreglo[14];
            var max=arreglo[0];
            rango.attr('max', max);
            rango.attr('min', min);
            $('.filtros .btn').removeClass('active');
            $(this).addClass('active');
          break;
            
          case 'mes':
            rango.attr('max', '12');
            rango.attr('min', '01');
            $('.filtros .btn').removeClass('active');
            $(this).addClass('active');
          break;
            
          case 'year':
            var actual = new Date();
            var ano=actual.getFullYear();
            var min=parseInt(ano)-2;
            rango.attr('max', ano);
            rango.attr('min', min);
            $('.filtros .btn').removeClass('active');
            $(this).addClass('active');
          break;
        };
    });
  /* activar/desactivar redes*/
  $('.row-numeros .card').click(function(event) {
    /* Act on the event */
    event.stopPropagation();

    $(this).find('.card-content').toggleClass('grey');
    $(this).find('.card-content').removeClass('darken-4');

  });

  var card = $('.expand');
   card.on('click', function() {

     $('.container').toggleClass('graficas');
     if( $(this).hasClass('dos') ){
       $(this).toggleClass('card-active card-active-dos');
     }
     if( $(this).hasClass('uno') ){
       $(this).toggleClass('card-active card-active-uno');
     }if( $(this).hasClass('tres') ){
       $(this).toggleClass('card-active card-active-tres');
     }if( $(this).hasClass('cuatro') ){
       $(this).toggleClass('card-active card-active-cuatro');
     }
     if( $(this).hasClass('cinco') ){
           $(this).toggleClass('card-active card-active-cinco');
     };
   });

//relleno de icono de genero
var offset;

function rellenarM(offset){
    $('#grad stop').attr('offset',offset+'%');
    $('.gen-man .white-text').html(offset+'%');
};

function rellenarF(offset){
    $('#grad2 stop').attr('offset',offset+'%');
    $('.gen-girl .white-text').html(offset+'%');
};
rellenarF(77.7);
rellenarM(22.3);
});

$(document).ready(function() {
  if(!$('#myCanvas').tagcanvas({
    //textColour: '#ff0000',
    outlineColour: '#ff00ff',
    reverse: true,
    depth: 0.8,
    maxSpeed: 0.05,
    textFont: null,
    textColour: null,
  },'tags')) {
    // something went wrong, hide the canvas container
    //$('#myCanvasContainer').hide();
  }
});


// Set the dimensions of the canvas / graph
var margin = {
     top: 40,
     right: 40,
     bottom: 50,
     left: 60
   }
   var width = 900 - margin.left - margin.right;
   var height = 300 - margin.top - margin.bottom;

/*PIE */
var chart = AmCharts.makeChart( "pie", {
  "type": "pie",
  "theme": "light",
  'colors': ['#4d6ab0','#5ba8df','#e2492a' ],
  // "titles": [ {
  //   "text": "# De conversaciones por propiedad",
  //   "size": 16
  // } ],
  "dataProvider": [ {
    "platform": "Facebook",
    "visits": 7252
  }, {
    "platform": "Twitter",
    "visits": 3882
  }, {
    "platform": "Youtube",
    "visits": 1809
  }],
  "valueField": "visits",
  "titleField": "platform",
  "startEffect": "elastic",
  "startDuration": 2,
  "labelRadius": 15,
  "innerRadius": "75%",
  "depth3D": 5,
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 15,
  "export": {
    "enabled": true
  }
} );


/*mapa de calor*/

google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([
          ['Departamento', 'Migración'],
          ['Panama', 28035],
          ['Mexico', 27359],
          ['Spain', 21614],
          ['Canada', 3678],
          ['Ecuador', 19764],
          ['Argentina', 4740],
          ['Germany', 3045],
          ['Colombia', 95012],
          ['Brazil', 6610],
          ['Peru', 10967],
          ['Dominican Republic', 5876],
          ['Aruba', 4595],
          ['United Kindom', 4276],
          ['Costa Rica', 3584],
          ['France', 3293],  
          ['Venezuela', 7553],
          ['Chile', 6760],
          ['Cuba', 2093],
          ['Italy', 1880],  
          ['Netherlands', 2232]
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('mapa'));

        chart.draw(data, options);
      }


/*datepicker*/
var picker;

$('.date button, .date .datepicker').click(function() {
  /*para el evento para que se ejecute el evento del datepicker*/

  event.stopPropagation();
  event.preventDefault();

  // Pikadate datepicker

var $input =  $(this).parent().find('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
    today: 'Hoy',
    clear: 'Limpiar',
    close: 'Cerrar',
    closeOnSelect: true,
    closeOnClear: true,
    container: '#contenedor-picker'
    // container: '#root-picker-outlet' elemento en el que se pinta el div
  });

picker = $input.pickadate('picker');

  $('.container').addClass('offset-x-container');
  $('body').addClass('offset-hidden');
  
  //abrimos la modal 
  window.setTimeout(function() {
    $('#contenedor-picker').addClass('inset-x-date');
    picker.open();
  }, 1001);

});

$('body').on('click', function () {
   if ( $('#contenedor-picker').hasClass('inset-x-date')  ) {
     picker.close();
     $('#contenedor-picker').removeClass('inset-x-date');
     $('.container').removeClass('offset-x-container');
     $('body').removeClass('offset-hidden');
   };
});

/*Linea de tiempo 'bonita'*/

/*var nReloads = 0;
var min = 1;
var max = 10;
var l =0;
var trendingLineChart;
function update() {
  nReloads++;
  var x = Math.floor(Math.random() * (max - min + 1)) + min;
  var y = Math.floor(Math.random() * (max - min + 1)) + min;
  trendingLineChart.addData([x, y], data.labels[l]);
  trendingLineChart.removeData();
  l++;
  if( l == data.labels.length)
    { l = 0;}
}*/

/*Redes sociales inicializadas en 10 5 y 3*/
facebook=[5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5,5, 5, 5, 5, 5, 5,5, 5, 5, 5, 5, 5, 5, 5, 5,5];
twitter =[10, 10, 10, 10, 10, 10, 10, 10, 10, 10,10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10,10, 10,10, 10];
youtube =[3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3,3, 3, 3, 3, 3, 3,3, 3, 3, 3, 3];

/*Funcion para obtener los ultimos 30 dias calendario apartir de la fecha actual*/
function ultimos30Dias(){
  var actual = new Date();
  var dia=actual.getDate();
  var mes=actual.getMonth();
  var ano=actual.getFullYear();
  var fechaPasada= new Date(ano, mes, 0);//para obtener el ultimo dia del mes anterior al actual
  var ultDiaMesPasado=fechaPasada.getDate();
  var arr=[];
  var temp='';
  temp=dia;
  for (var i = 1; i <= 30; i++) {
      if (temp==1) {
        arr.push(temp);
        temp=ultDiaMesPasado;
      }else{
        arr.push(temp);
        temp--;
      }
  }
  return arr;
}

/*Funcion que devuelve el dia (en numero ) actual */
function diaActual(){
  var dias=ultimos15Dias();
  return dias[0]; //valor maximo (fecha)
}

function mesActual(){
  var actual = new Date();
  var mes=actual.getMonth();
  return mes;
}

function anoActual(){
  var actual = new Date();
  var ano=actual.getFullYear();
  return ano;
}
/*Funcion que devuelve un arreglo con los ultimos 15 dias apartir de la fecha actual*/
function ultimos15Dias(){
  var actual = new Date();
  var dia=actual.getDate();
  var mes=actual.getMonth();
  var ano=actual.getFullYear();
  var fechaPasada= new Date(ano, mes, 0);//para obtener el ultimo dia del mes anterior al actual
  var ultDiaMesPasado=fechaPasada.getDate();
  var arr=[];
  var temp='';
  temp=dia;
  for (var i = 1; i <= 15; i++) {
      if (temp==1) {
        arr.push(temp);
        temp=ultDiaMesPasado;
      }else{
        arr.push(temp);
        temp--;
      }
  }
  return arr;
}

//Funcion que devuelve los ultimos seis meses a partir del mes actual en un arreglo eje mes actual = abril a[nov,dic,ene,feb,marz,abril]
function ultimos6Meses(){
  var mes=mesActual();
  mes=parseInt(mes);
  var ret=[];
  var arr=['01','02','03','04','05','06','07','08','09','10','11','12'];
  var temp=mes;
  for (var i = 1; i <= 6; i++) {
    if (temp==0) {
      ret.push(arr[temp]);
      temp = 12;
    }else{
      ret.push(arr[temp]);
    }//if-else
    temp--;
  }//for
  return ret;
}
/*funcion que devuelve un arreglo con los dias entre un rango de de fechas */
function getArrDias(min, max){
  var arr=[];
  for ( min; min <= max; min++) {
    arr.push(min);
  }
  return arr;
}
//esta funcion cambia el num del mes por su equivalente en letras ej 4 => Abr
function cambioLabel(mes){
  var letras='';
  switch(mes){
    case 1:letras ='Ene';break;
    case 2:letras ='Feb' ;break;
    case 3:letras ='Mar' ;break;
    case 4:letras ='Abr' ;break;
    case 5:letras ='May' ;break;
    case 6:letras ='Jun' ;break;
    case 7:letras ='Jul' ;break;
    case 8:letras ='Ago' ;break;
    case 9:letras ='Sep' ;break;
    case 10:letras ='Oct' ;break;
    case 11:letras ='Nov' ;break;
    case 12:letras ='Dic' ;break;
  }
  return letras;
}
/*funcion que pinta la linea de tiempo @facebook arreglo con datos @twitter arreglo con datos @youtube arreglo con datos @rango arr con los dias*/
function dibujaLineaTiempo(facebook,twitter,youtube,rango){
  arr=rango;
  puntosLinea=arr.length;
  var data='';
   data = {
  labels : arr,
  datasets : [
    {
      label: "Json",
      fillColor : "rgba(255, 255, 255, 0.6)",
      strokeColor : "#4d6ab0",
      pointColor : "#4d6ab0",
      pointStrokeColor : "#ffffff",
      pointHighlightFill : "#ffffff",
      pointHighlightStroke : "#ffffff",
      data:facebook 
    },
    {
      label: "Twitter",
      fillColor : "rgba(255, 255, 255, 0.3)",
      strokeColor : "#5ba8df",
      pointColor : "#5ba8df",
      pointStrokeColor : "#ffffff",
      pointHighlightFill : "#80deea",
      pointHighlightStroke : "#80deea",
      data: twitter
    },
    {
      label: "YouTube",
      fillColor : "rgba(255, 255, 255, 0.15)",
      strokeColor : "#e2492a",
      pointColor : "#e2492a",
      pointStrokeColor : "#ffffff",
      pointHighlightFill : "#80deea",
      pointHighlightStroke : "#80deea",
      data: youtube
    }
  ]
};

 var trendingLineChart = document.getElementById("timeline").getContext("2d");
  window.trendingLineChart = new Chart(trendingLineChart).Line(data, {    
    scaleShowGridLines : true,///Boolean - Whether grid lines are shown across the chart    
    scaleGridLineColor : "rgba(255,255,255,0.4)",//String - Colour of the grid lines    
    scaleGridLineWidth : 1,//Number - Width of the grid lines   
    scaleShowHorizontalLines: true,//Boolean - Whether to show horizontal lines (except X axis)   
    scaleShowVerticalLines: false,//Boolean - Whether to show vertical lines (except Y axis)    
    bezierCurve : true,//Boolean - Whether the line is curved between points    
    bezierCurveTension : 0.4,//Number - Tension of the bezier curve between points    
    pointDot : true,//Boolean - Whether to show a dot for each point    
    pointDotRadius : 5,//Number - Radius of each point dot in pixels    
    pointDotStrokeWidth : 2,//Number - Pixel width of point dot stroke    
    pointHitDetectionRadius : 20,//Number - amount extra to add to the radius to cater for hit detection outside the drawn point    
    datasetStroke : true,//Boolean - Whether to show a stroke for datasets    
    datasetStrokeWidth : 3,//Number - Pixel width of dataset stroke   
    datasetFill : true,//Boolean - Whether to fill the dataset with a colour        
    animationSteps: 15,// Number - Number of animation steps    
    animationEasing: "easeOutQuart",// String - Animation easing effect     
    tooltipTitleFontFamily: "'Roboto','Helvetica Neue', 'Helvetica', 'Arial', sans-serif",// String - Tooltip title font declaration for the scale label    
    scaleFontSize: 12,// Number - Scale label font size in pixels   
    scaleFontStyle: "normal",// String - Scale label font weight style    
    scaleFontColor: "#fff",// String - Scale label font colour
    tooltipEvents: ["mousemove", "touchstart", "touchmove"],// Array - Array of string names to attach tooltip events   
    tooltipFillColor: "rgba(255,255,255,0.8)",// String - Tooltip background colour   
    tooltipTitleFontFamily: "'Roboto','Helvetica Neue', 'Helvetica', 'Arial', sans-serif",// String - Tooltip title font declaration for the scale label    
    tooltipFontSize: 12,// Number - Tooltip label font size in pixels
    tooltipFontColor: "#000",// String - Tooltip label font colour    
    tooltipTitleFontFamily: "'Roboto','Helvetica Neue', 'Helvetica', 'Arial', sans-serif",// String - Tooltip title font declaration for the scale label    
    tooltipTitleFontSize: 14,// Number - Tooltip title font size in pixels    
    tooltipTitleFontStyle: "bold",// String - Tooltip title font weight style   
    tooltipTitleFontColor: "#000",// String - Tooltip title font colour   
    tooltipYPadding: 8,// Number - pixel width of padding around tooltip text   
    tooltipXPadding: 16,// Number - pixel width of padding around tooltip text    
    tooltipCaretSize: 10,// Number - Size of the caret on the tooltip   
    tooltipCornerRadius: 6,// Number - Pixel radius of the tooltip border   
    tooltipXOffset: 10,// Number - Pixel offset from point x to tooltip edge
    responsive: true
    });
}
  
  /*Script para pintar linea con 30 dias calendario con datos de mongo*/

dibujaLineaTiempo(facebook,twitter,youtube,ultimos30Dias());
/*funcion para obtener un arr con los dias entre un rango de dias */

/*pinta los ultimos treinta dias */
setTimeout(function(){
  $.ajax({
  url:'lineaTiempo.php',
  dataType:'json',
  type:'POST',
  data:{
    asd:'asd'
  },success:function(data){
     for (var i = 0; i < puntosLinea; i++) {
                trendingLineChart.removeData();
              }
              var dias=ultimos30Dias();
              puntosLinea=dias.length;
              for (var i = 0; i < dias.length; i++) {
                trendingLineChart.addData([data[0][i], data[1][i],data[2][i]], dias[i]);
              }
  }
});
},5000);

$(document).on('change','#rango',function(){
  var rango=$('#rango').val();
  var filtro = $('.botones-fecha').find('a.active').attr('id');
  switch(filtro){
          case 'dia':
            var min = rango;
            var max = diaActual();
           $.ajax({
             url:'lineaTiempo.php',
             dataType:'json',
             type:'POST',
             data:{
               dia:'dia',
               min:min,
               max:max
             },success:function(data){
             
              /*For Para remover los datos de la anterior grafica*/
             for (var i = 0; i < puntosLinea; i++) {
                trendingLineChart.removeData();
              }
              /*obtiene un array con los dias que comprenden el periodo de tiempo entre min y max, y crear la nueva grafica
              *addData primer parametro el valor para c/u de los puntos y cada uno de los elementos a medir en este caso 
              *[data[0]->facebook,data[1]->twitter,data[2]->youtube]
              *addData segundo parametro unidades de medida sobre el eje x en este caso los ultimo quince dias (como maximo) 
              */
              var dias=getArrDias(min,max);
              puntosLinea=dias.length;
              for (var i = 0; i < data[0].length; i++) {
                trendingLineChart.addData([data[0][i], data[1][i],data[2][i] ], dias[i]);
              }
             }
           });
          break;
            
          case 'mes':
            var band=0;
            var min = rango;
            var max = mesActual();
            //indaga si el mes actual es mayor al mes seleccionado para asignar el año a dicho mes
            if (max>min) {
              max='01-'+mesActual()+'-'+anoActual();
              min='01-'+min+'-'+parseInt(anoActual());
            }else{
              max='01-'+mesActual()+'-'+anoActual();
              min='01-'+min+'-'+(parseInt(anoActual())-1);
            }
           $.ajax({
             url:'lineaTiempo.php',
             dataType:'json',
             type:'POST',
             data:{
               mes:'mes',
               min:min,
               max:max
             },success:function(data){
                //For Para remover los datos de la anterior grafica
               for (var i = 0; i < puntosLinea; i++) {
                  trendingLineChart.removeData();
                }
            
              //*obtiene un array con los dias que comprenden el periodo de tiempo entre min y max, y crear la nueva grafica
              //*addData primer parametro el valor para c/u de los puntos y cada uno de los elementos a medir en este caso 
              //*[data[0]->facebook,data[1]->twitter,data[2]->youtube]
              //*addData segundo parametro unidades de medida sobre el eje x en este caso los ultimo 6 meses (como maximo) 
              //*
              var label='';
              puntosLinea=data[3].length;
              for (var i = 0; i < data[3].length; i++) {
                label=cambioLabel( data[3][i]);//cambio los numeros de los meses por su equivalente en letras y lo paso como label en la grafica
                trendingLineChart.addData([data[0][i], data[1][i],data[2][i]],label);
              }
             }
           });
          break;
            
          case 'year':
            var min = rango;
            var max = anoActual()+'-'+mesActual()+'-'+diaActual();
           $.ajax({
              url:'lineaTiempo.php',
             dataType:'json',
             type:'POST',
             data:{
               year:'year',
               min:min,
               max:max
             },success:function(data){
                //For Para remover los datos de la anterior grafica
               for (var i = 0; i < puntosLinea; i++) {
                  trendingLineChart.removeData();
                }
            
              //*obtiene un array con los dias que comprenden el periodo de tiempo entre min y max, y crear la nueva grafica
              //*addData primer parametro el valor para c/u de los puntos y cada uno de los elementos a medir en este caso 
              //*[data[0]->facebook,data[1]->twitter,data[2]->youtube]
              //*addData segundo parametro unidades de medida sobre el eje x en este caso los ultimos 36 meses (como maximo) 
              //*
              var label='';
              puntosLinea=data[3].length;
              for (var i = 0; i < data[3].length; i++) {
                label=cambioLabel( data[3][i]);
                trendingLineChart.addData([data[0][i], data[1][i],data[2][i]],label);
             }
             }
           });
          break;
        };
});
var inputDos=''; //valor del segundo picker
var inputUno=''; //valor del primer picker
var spans=$('span'); //objetos span mediante los cuales accedemos a los inputs de de los pickers
var desde=''; //objeto input del date picker desde
var hasta=''; // objeto input del date picker hasta 
//var inUno=false; // vandera que indica si ya contamos con un valor nuevo de input uno 
//var inDos=false; // vandera que indica si ya contamos con un valor nuevo de input dos 

/*recorrer los span para obtener los inputs*/
for (var i = 0; i < spans.length; i++) {
  if ($(spans[i]).html()=='Desde') {
    desde=$(spans[i]).next();
  }
  if ($(spans[i]).html()=='Hasta') {
    hasta=$(spans[i]).next();
  }
}
/*funcion que cambia el formato de la fecha obtenido de los pickers ej 23 April, 2016 => 2016-04-23*/
function cambiaFormatoFecha(input){
  var split = input.split(',');
  var splitDos = split[0].split(' ');
  var dia=splitDos[0];
  var mes=splitDos[1];
  var ano=split[1];
  switch(mes){
    case 'January':mes='01' ;break;
    case 'February':mes='02' ;break;
    case 'March':mes='03' ;break;
    case 'April':mes='04' ;break;
    case 'May':mes='05' ;break;
    case 'June':mes='06' ;break;
    case 'July':mes='07' ;break;
    case 'August':mes='08' ;break;
    case 'September':mes='09' ;break;
    case 'October':mes='10' ;break;
    case 'November':mes='11' ;break;
    case 'December':mes='12' ;break;
  }
  var re=ano+'-'+mes +'-'+dia;
  return re; 
}
/*Pendiente al cambio en el input de picker uno (desde)*/
$(document).on('change',desde,function(){
  inputUno=$(desde).val();
  //inUno=true;
  if (inputDos!='' && inputUno!='') {
   var fechaUno=cambiaFormatoFecha(inputUno);
   var fechaDos=cambiaFormatoFecha(inputDos);
   
   $.ajax({
     url:'lineaTiempo.php',
     dataType:'json',
     type:'POST',
     data:{
       picker:'picker',
       min:fechaUno,
       max:fechaDos
     },success:function(data){
        //For Para remover los datos de la anterior grafica
       for (var i = 0; i < puntosLinea; i++) {
          trendingLineChart.removeData();
        }
      inputDos='';
      inputUno='';
      //*obtiene un array con los dias que comprenden el periodo de tiempo entre min y max, y crear la nueva grafica
      //*addData primer parametro el valor para c/u de los puntos y cada uno de los elementos a medir en este caso 
      //*[data[0]->facebook,data[1]->twitter,data[2]->youtube]
      //*addData segundo parametro unidades de medida sobre el eje x en este caso los ultimos 36 meses (como maximo) 
      //*
      var label='';
      puntosLinea=data[3].length;
      for (var i = 0; i < data[3].length; i++) {
        //label=cambioLabel( data[3][i]);
        trendingLineChart.addData([data[0][i], data[1][i],data[2][i]],data[3][i]);
     }//fin for
     }//fn success
   });
   
  }//fin if 
});

/*Pendiente al cambio en el input de picker dos (hasta)*/
$(document).on('change',hasta,function(){
  inputDos=$(hasta).val();
 // inDos=true;
  if (inputDos!='' && inputUno!='') {
   var fechaUno=cambiaFormatoFecha(inputUno);
   var fechaDos=cambiaFormatoFecha(inputDos);
   $.ajax({
     url:'lineaTiempo.php',
     dataType:'json',
     type:'POST',
     data:{
       picker:'picker',
       min:fechaUno,
       max:fechaDos
     },success:function(data){
        //For Para remover los datos de la anterior grafica
       for (var i = 0; i < puntosLinea; i++) {
          trendingLineChart.removeData();
        }
      inputDos='';
      inputUno='';/*]]]]]]]]]]]]]]]]]]]]]]]]]]]]Qude aqui[[[[[[[[[[[[[[[[[[[[[[[[[[*/
      //*obtiene un array con los dias que comprenden el periodo de tiempo entre min y max, y crear la nueva grafica
      //*addData primer parametro el valor para c/u de los puntos y cada uno de los elementos a medir en este caso 
      //*[data[0]->facebook,data[1]->twitter,data[2]->youtube]
      //*addData segundo parametro unidades de medida sobre el eje x en este caso los ultimos 36 meses (como maximo) 
      //*
      var label='';
      puntosLinea=data[3].length;
      for (var i = 0; i < data[3].length; i++) {
        //label=cambioLabel( data[3][i]);
        trendingLineChart.addData([data[0][i], data[1][i],data[2][i]],data[3][i]);
     }//fin for
     }//fn success
   });
  }
});
//console.log(desde);
//console.log(hasta);