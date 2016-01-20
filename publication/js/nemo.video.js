var video = document.getElementById('video');
var count = 1;

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

