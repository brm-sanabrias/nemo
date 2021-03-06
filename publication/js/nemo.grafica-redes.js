
/*Linea de tiempo 'bonita'*/
var data = {
  labels : ["ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC"],
  datasets : [
    {
      label: "Fans",
      fillColor : "rgba(255, 255, 255, 0.4)",
      strokeColor : "#4d6ab0",
      pointColor : "#4d6ab0",
      pointStrokeColor : "#ffffff",
      pointHighlightFill : "#ffffff",
      pointHighlightStroke : "#ffffff",
      data: [1, 5, 2, 4, 8, 5, 8, 8, 4, 2, 1, 7, 3, 6]
    },
    {
      label: "Fecha",
      fillColor : "rgba(255, 255, 255, 0.3)",
      strokeColor : "#5ba8df",
      pointColor : "#5ba8df",
      pointStrokeColor : "#ffffff",
      pointHighlightFill : "#80deea",
      pointHighlightStroke : "#80deea",
      data: [6, 2, 9, 2, 5, 10, 4, 2, 5, 10,8, 5, 8 ]
    }
  ]
};

/*Datos interacciones*/
var dataInteract = {
  labels : ["ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC"],
  datasets : [
    {
      label: "Likes",
      fillColor : "rgba(255, 255, 255, 0.4)",
      strokeColor : "#4d6ab0",
      pointColor : "#4d6ab0",
      pointStrokeColor : "#ffffff",
      pointHighlightFill : "#ffffff",
      pointHighlightStroke : "#ffffff",
      data: [1, 5, 2, 4, 8, 5, 8, 8, 4, 2, 1, 7, 3, 6]
    },
    {
      label: "Comments",
      fillColor : "rgba(255, 255, 255, 0.3)",
      strokeColor : "#5ba8df",
      pointColor : "#5ba8df",
      pointStrokeColor : "#ffffff",
      pointHighlightFill : "#80deea",
      pointHighlightStroke : "#80deea",
      data: [6, 2, 9, 2, 5, 10, 4, 2, 5, 10,8, 5, 8 ]
    },
    {
      label: "Shares",
      fillColor : "rgba(255, 255, 255, 0.6)",
      strokeColor : "#5ba8df",
      pointColor : "#5ba8df",
      pointStrokeColor : "#ffffff",
      pointHighlightFill : "#80deea",
      pointHighlightStroke : "#80deea",
      data: [7, 3, 6, 8, 5, 8, 4, 9, 2, 5,4, 2, 5]
    }
  ]
};



var nReloads = 0;
var min = 1;
var max = 10;
var l =0;
var trendingLineChart;
var InteractLineChart;
function update() {
  nReloads++;

  var x = Math.floor(Math.random() * (max - min + 1)) + min;
  var y = Math.floor(Math.random() * (max - min + 1)) + min;
  trendingLineChart.addData([x, y], data.labels[l]);
  trendingLineChart.removeData();
  l++;
  if( l == data.labels.length)
    { l = 0;}
}

function updateIN() {
  nReloads++;

  var x = Math.floor(Math.random() * (max - min + 1)) + min;
  var y = Math.floor(Math.random() * (max - min + 1)) + min;
  InteractLineChart.addData([x, y], dataInteract.labels[l]);
  InteractLineChart.removeData();
  l++;
  if( l == dataInteract.labels.length)
    { l = 0;}
}
// setInterval(update, 3000);

window.onload = function(){

  var trendingLineChart = document.getElementById("timeline-growth-facebook").getContext("2d");
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
	

	/*Creamos linea de tiempo de interacciones*/

	var InteractLineChart = document.getElementById("timeline-interact-facebook").getContext("2d");
	window.InteractLineChart = new Chart(InteractLineChart).Line(dataInteract, {    
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



};
