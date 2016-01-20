var video = $('#video');

video.on('ended', function () {
  this.load();
  this.play();
});

$(document).on('mousemove', function () {

	
	$('.splash').addClass('animated zoomOut');
	$('.splash').removeClass('zoomIn');

	window.setTimeout(function () {
		if ( $('.splash').hasClass('zoomOut') ) {

			$('.splash').hide();

		}
	}, 500);


});


$(document).on('ready', function() {

	

		window.setTimeout(function() {

			if ( $('.splash').hasClass('zoomOut') ) {

				$('.splash').show();

				$('.splash').addClass('zoomIn');
				$('.splash').removeClass('zoomOut');

		};


		}, 5000);


});