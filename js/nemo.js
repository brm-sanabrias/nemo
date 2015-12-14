<<<<<<< HEAD
var barraProgreso = document.getElementById('progress'),
	barraVacia = document.getElementById('inactiveProgress'),
	barraText = document.getElementsByTagName('progress-helper'),
	progreso = document.getElementById('progressController'),
	barraVaciaContext = barraVacia.getContext("2d");

$(document).ready(function() {

//cambio de click para hacer reveal card//
   	$(document).on('click', '.agregar-marca', function(e) {


   		     $(this).parent().find('.card-panel').css('overflow', 'hidden');

   		    $(this).parent().find('.card-reveal').css({ display: 'block'}).velocity("stop", false).velocity({translateY: '-100%'}, {duration: 300, queue: false, easing: 'easeInOutQuad'});


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




=======
var marcas = "";
$(function() {
    var $write = $('#search'),
        shift = false,
        capslock = false;

    $('#keyboard li').click(function() {
        //  alert("click")
        var $this = $(this),
            character = $this.html(); // If it's a lowercase letter, nothing happens to this variable
        // alert(character);
        // Shift keys
        if ($this.hasClass('left-shift') || $this.hasClass('right-shift')) {
            $('.letter').toggleClass('uppercase');
            $('.symbol span').toggle();

            shift = (shift === true) ? false : true;
            capslock = false;
            return false;
        }

        // Caps lock
        if ($this.hasClass('capslock')) {
            $('.letter').toggleClass('uppercase');
            capslock = true;
            return false;
        }

        // Delete
        if ($this.hasClass('delete')) {
            var html = $write.val();

            $write.val(html.substr(0, html.length - 1));
            searchBrand($write.val());
            return false;
        }

        // Special characters
        if ($this.hasClass('symbol')) character = $('span:visible', $this).html();
        if ($this.hasClass('space')) character = ' ';
        if ($this.hasClass('tab')) character = "\t";
        if ($this.hasClass('return')) character = "\n";

        // Uppercase letter
        if ($this.hasClass('uppercase')) character = character.toUpperCase();

        // Remove shift once a key is clicked.
        if (shift === true) {
            $('.symbol span').toggle();
            if (capslock === false) $('.letter').toggleClass('uppercase');

            shift = false;
        }

        // Add the character
        $write.val($write.val() + character);
        searchBrand($write.val());
    });
});

function animate(div, x) {
    $('#' + div).show().removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
        $(this).removeClass();
    });
};

function searchBrand(term) {
    var n = term.length;
    var $resultCont=$('.resultados-marcas');
    if (n >= 3) {
        $resultCont.html('');
        $.each(marcas, function(i, v) {
            //console.log(v)
            var re = new RegExp(term.toLowerCase());
            var name = v.name.toLowerCase();
            if (name.search(re) != -1) {
                // alert(v.picture);
                $resultCont.append('<li><a href="#"><figure><img src="' + v.picture + '" alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1"></figure><span class="marca">' + v.name + '</span></a></li>');
                return;
            }
        });
    }else{
        $resultCont.html('');
    }
}
/// funciones cuando el documento este listo
$(document).ready(function() {
    $.ajax({
        url: 'buscar.php',
        dataType: 'json',
        success: function(data) {
            marcas = data;
        },
        type: 'GET'
    });



    $('#search').focusin(function() {
        animate("keyboard_parent", "bounceIn");
    }).focusout(function() {


    });
});
>>>>>>> d5df7147a5cc0e202dd1f4e11691920193081113
