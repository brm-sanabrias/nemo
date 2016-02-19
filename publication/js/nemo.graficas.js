//cambio de tamaño de card seleccionada

$(document).ready(function () {

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

     }
     
     // console.log( $(this).parent().position() );

     
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
    weightMode:'both',
    weight: true,
    weightGradient: {
     0:    '#f00', // red
     0.33: '#ff0', // yellow
     0.66: '#0f0', // green
     1:    '#00f'  // blue
    }
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

// Parse the date / time
var parseDate = d3.time.format("%d-%b-%y").parse;

// Set the ranges
var x = d3.time.scale().range([0, width]);
var y = d3.scale.linear().range([height, 0]);

// Define the axes
var xAxis = d3.svg.axis().scale(x)
    .orient("bottom").ticks(5);

var yAxis = d3.svg.axis().scale(y)
    .orient("left").ticks(5);

// Define the line
var valueline = d3.svg.line()
    .x(function(d) { return x(d.date); })
    .y(function(d) { return y(d.close); });
    
// Adds the svg canvas
var svg = d3.select(".graph-demo").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform", 
              "translate(" + margin.left + "," + margin.top + ")");
var lineSvg = svg.append("g"); 

var focus = svg.append("g") 
    .style("display", "none");

// Get the data
d3.csv("search/results/dataLineChart.csv", function(error, data) {

    data.forEach(function(d) {
        d.date = parseDate(d.date);
        d.close = +d.close;
    });

    // Scale the range of the data
    x.domain(d3.extent(data, function(d) { return d.date; }));
    y.domain([0, d3.max(data, function(d) { return d.close; })]);

    // Add the valueline path.
    lineSvg.append("path")
        .attr("class", "line")
        .style("stroke", "#827717")
        
        .attr("d", valueline(data));

    // Add the X Axis
    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);

    // Add the Y Axis
    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis);

   // append the x line
    focus.append("line")
        .attr("class", "x")
        .style("stroke", "blue")
        .style("stroke-dasharray", "3,3")
        .style("opacity", 0.5)
        .attr("y1", 0)
        .attr("y2", height);

    // append the y line
    focus.append("line")
        .attr("class", "y")
        .style("stroke", "blue")
        .style("stroke-dasharray", "3,3")
        .style("opacity", 0.5)
        .attr("x1", width)
        .attr("x2", width);

    // append the circle at the intersection
    focus.append("circle")
        .attr("class", "y")
        .style("fill", "none")
        .style("stroke", "blue")
        .attr("r", 4);

    // place the value at the intersection
    focus.append("text")
        .attr("class", "y1")
        .style("stroke", "white")
        .style("stroke-width", "3.5px")
        .style("opacity", 0.8)
        .attr("dx", 8)
        .attr("dy", "-.3em");
    focus.append("text")
        .attr("class", "y2")
        .attr("dx", 8)
        .attr("dy", "-.3em");

    // place the date at the intersection
    focus.append("text")
        .attr("class", "y3")
        .style("stroke", "white")
        .style("stroke-width", "3.5px")
        .style("opacity", 0.8)
        .attr("dx", 8)
        .attr("dy", "1em");
    focus.append("text")
        .attr("class", "y4")
        .attr("dx", 8)
        .attr("dy", "1em");
    
    // append the rectangle to capture mouse
    svg.append("rect")
        .attr("width", width)
        .attr("height", height)
        .style("fill", "none")
        .style("pointer-events", "all")
        .on("mouseover", function() { focus.style("display", null); })
        .on("mouseout", function() { focus.style("display", "none"); })
        .on("mousemove", mousemove);

    function mousemove() {
    var x0 = x.invert(d3.mouse(this)[0]),
        i = bisectDate(data, x0, 1),
        d0 = data[i - 1],
        d1 = data[i],
        d = x0 - d0.date > d1.date - x0 ? d1 : d0;

    focus.select("circle.y")
        .attr("transform",
              "translate(" + x(d.date) + "," +
                             y(d.close) + ")");

    focus.select("text.y1")
        .attr("transform",
              "translate(" + x(d.date) + "," +
                             y(d.close) + ")")
        .text(d.close);

    focus.select("text.y2")
        .attr("transform",
              "translate(" + x(d.date) + "," +
                             y(d.close) + ")")
        .text(d.close);

    focus.select("text.y3")
        .attr("transform",
              "translate(" + x(d.date) + "," +
                             y(d.close) + ")")
        .text(formatDate(d.date));

    focus.select("text.y4")
        .attr("transform",
              "translate(" + x(d.date) + "," +
                             y(d.close) + ")")
        .text(formatDate(d.date));

    focus.select(".x")
        .attr("transform",
              "translate(" + x(d.date) + "," +
                             y(d.close) + ")")
                   .attr("y2", height - y(d.close));

    focus.select(".y")
        .attr("transform",
              "translate(" + width * -1 + "," +
                             y(d.close) + ")")
                   .attr("x2", width + width);
  }

});




/*PIE */
var chart = AmCharts.makeChart( "pie", {
  "type": "pie",
  "theme": "light",
  // "titles": [ {
  //   "text": "# De conversaciones por propiedad",
  //   "size": 16
  // } ],
  "dataProvider": [ {
    "country": "Facebook",
    "visits": 7252
  }, {
    "country": "Twitter",
    "visits": 3882
  }, {
    "country": "Youtube",
    "visits": 1809
  }],
  "valueField": "visits",
  "titleField": "country",
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

$('.date button').click(function() {
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
  
  //abrimos la modal 
  window.setTimeout(function() {
    $('#contenedor-picker').addClass('inset-x-date');
    picker.open();
    $('body').addClass('offset-hidden');
  }, 1001);

});

$('body').on('click', function () {
   
   if ( $('#contenedor-picker').hasClass('inset-x-date')  ) {

     picker.close();
     $('#contenedor-picker').removeClass('inset-x-date');
     $('.container').removeClass('offset-x-container');
     $('body').removeClass('offset-hidden');
     console.log('hola');

   };


});

