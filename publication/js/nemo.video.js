var video = document.getElementById('video');
var count = 0;

$('video').on('ended', function () {
  this.load();
  this.play();
});

$(document).on('mousemove', function () {


	$('.splash').addClass('animated zoomOut');
	$('.splash').removeClass('zoomIn');

	window.setTimeout(function () {
		if ( $('.splash').hasClass('zoomOut') ) {

			$('.splash').hide();

			video.pause();

		}
	}, 500);

	count = 1;

});


$(document).on('ready', function() {

	console.log(count);

	

		if (count == 1) {

				window.setInterval(function() {

					if ( $('.splash').hasClass('zoomOut') ) {

						$('.splash').show();

						$('.splash').addClass('zoomIn');
						$('.splash').removeClass('zoomOut');
						count = 0;
						video.play();
				};


				}, 10000);

		};


});