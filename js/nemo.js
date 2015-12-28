var barraProgreso = document.getElementById('progress'),
	barraVacia = document.getElementById('inactiveProgress'),
	barraText = document.getElementsByTagName('progress-helper'),
	progreso = document.getElementById('progressController'),
	barraVaciaContext = barraVacia.getContext("2d");

$(document).ready(function() {

//cambio de click para hacer reveal card//
   	$(document).on('click', '.mostrar-keyb', function(e) {


   			$(this).addClass('disabled');

   		    $(this).parent().find('.card-panel').css('overflow', 'hidden');

   		    $(this).parent().find('.card-reveal').css({ display: 'block'}).velocity("stop", false).velocity({translateY: '-100%'}, {duration: 300, queue: false, easing: 'easeInOutQuad'});

   		    $(this).parent().find('.card-reveal input').focus();


   	});

   	// Pintamos check sobre marcas seleccionadas
   	$(document).on('click',  '.marca' , function () {
   		 
   		/*$('.mdi-navigation-check', this).addClass('animated bounceIn');
   		$('.mdi-navigation-check', this).removeClass('hide');
   		
   		$('.continuar').removeClass('orange darken-4').addClass('blue').html('Terminé <i class="right mdi-navigation-arrow-forward"></i>');*/


   		if ( $('.mdi-navigation-check', this).hasClass('hide') ) {
			$('.mdi-navigation-check', this).addClass('animated bounceIn');
	   		$('.mdi-navigation-check', this).removeClass('hide');
	   		$('.mostrar-keyb').addClass('disabled');
	   		if(!$('.continuar').hasClass('blue'))
	   			$('.continuar').removeClass('orange darken-4').addClass('blue').html('Terminé <i class="right mdi-navigation-arrow-forward"></i>');
   		}else{

   			$('.mdi-navigation-check', this).removeClass('bounceIn');

	   		$('.mdi-navigation-check', this).addClass('hide');

	   		
   		};

   		if ($('.marca .hide').length == $('.mdi-navigation-check').length ) {
   			console.log( $('.mdi-navigation-check hide').length);
 
   			$('.continuar').removeClass('blue').addClass('orange darken-4').html('No tengo cuenta aquí <i class="right mdi-navigation-close"></i>');

   			$('.mostrar-keyb').removeClass('disabled');
   		};

   	});

   	//Pintamos check sobre web seleccionadas
   	$(document).on('click',  '.screen' , function () {
   		 

   		if ( $('.mdi-navigation-check', this).hasClass('hide') ) {
			$('.mdi-navigation-check', this).addClass('animated bounceIn');
	   		$('.mdi-navigation-check', this).removeClass('hide');
	   		$('.mostrar-keyb').addClass('disabled');
	   		if(!$('.continuar').hasClass('blue'))
	   			$('.continuar').removeClass('orange darken-4').addClass('blue').html('Terminé <i class="right mdi-navigation-arrow-forward"></i>');
   		}else{

   			$('.mdi-navigation-check', this).removeClass('bounceIn');

	   		$('.mdi-navigation-check', this).addClass('hide');

	   		
   		};

   		if ($('.screen .hide').length == $('.mdi-navigation-check').length ) {
   			console.log( $('.mdi-navigation-check hide').length);
 
   			$('.continuar').removeClass('blue').addClass('orange darken-4').html('No tengo sitio web <i class="right mdi-navigation-close"></i>');

   			$('.mostrar-keyb').removeClass('disabled');
   		};

   	});



   	
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

		$(barraText).text( (parseInt(porcentaje * 100, 10)) + '%');
	}

		pintarProg(barraProgreso, porcentaje, barraText);

});
