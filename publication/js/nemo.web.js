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

$(document).on('click', '.mostrar-keyb', function(e) {


		$(this).addClass('disabled');

		$(".mask").addClass('animated flipOutX');

		window.setTimeout(function() {
			$(".mask").addClass('hide');
			$(".ingresar-url").removeClass('hide');
			$('.keyboard-input').focus();

		}, 500);
		$(".ingresar-url").addClass('flipInX');



		$(this).parent().parent().addClass('hide');




});