var barraProgreso = document.getElementById('progress'),
	barraVacia = document.getElementById('inactiveProgress'),
	barraText = document.getElementsByTagName('progress-helper'),
	progreso = document.getElementById('progressController'),
	barraVaciaContext = barraVacia.getContext("2d");

$(document).ready(function() {

      	
/*Pintamos la barra de progeso*/
	var barraVaciaContext = barraVacia.getContext("2d"),
		porcentaje = $(progreso).val() / 100;

	//cambios en el input range para pintar
	$(progreso).on('change', function(){
		var porcentaje = $(this).val() / 100;
		console.log(porcentaje + '%');
		pintarProg(barraProgreso, porcentaje, barraText);
	});

	barraSinProg(barraVaciaContext);

	

		pintarProg(barraProgreso, porcentaje, barraText);

});

function barraSinProg (barraVaciaContext) {
	barraVaciaContext.beginPath(),
	barraVaciaContext.lineWidth = 5,
	barraVaciaContext.strokeStyle = '#fff',
	barraVaciaContext.arc(60, 60, 55, 0, 2*Math.PI),
	barraVaciaContext.stroke();
};


	function pintarProg(bar, porcentaje, barraText){
		var barCTX = bar.getContext("2d");
		var quarterTurn = Math.PI / 2;
		var endingAngle = ((2*porcentaje) * Math.PI) - quarterTurn;
		var startingAngle = 0 - quarterTurn;

		bar.width = bar.width;
		barCTX.lineCap = 'square';

		barCTX.beginPath();
		barCTX.lineWidth = 5;
		barCTX.strokeStyle = '#448ccb';
		barCTX.arc(60, 60, 55,startingAngle, endingAngle);
		barCTX.stroke();
		var valor=(parseInt(porcentaje * 100, 10));
		$(barraText).text(valor+'%');
	}
function setLoader() {
    $('.loader').removeClass('hide');
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}
