var marcas = "";
jQuery(document).ready(function($) {

    ///BUSQUEDA DE MARCAS
    $.ajax({
        url: 'buscar.php',
        dataType: 'json',
        success: function(data) {
            marcas = data;
            $('.resultados-marcas').html('');
        },
        type: 'GET'
    });

    $('.keyboard-input').focusin(function() {
        animate("keyboard_parent", "bounceIn");
    }).focusout(function() {
    });

    $('.keyboard-input').keypress(function(event) {
        if ($(this).val().length >= 3) {
            /* Act on the event */
            searchBrand($(this).val());
        }
    });
});

$(function() {

    var $write = $('.keyboard-input'),

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
    var $resultCont = $('.resultados-marcas');
    var $crearMarca = $('#crear-marca');
    var cons = 0;
    console.log(n);
    if (n >= 3) {
        $resultCont.html('');
        $.each(marcas, function(i, v) {
            //console.log(v)
            var re = new RegExp(term.toLowerCase());
            var name = v.name.toLowerCase();
            if (name.search(re) != -1) {
                // alert(v.picture);
                $resultCont.append('<li><a href="javascript:;" onclick="selectBrand(' + v.idBrand + ');"><figure><img src="' + v.picture + '" alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1"></figure><span class="marca">' + v.name + '</span></a></li>');
                cons++;
                return;
            }
        });
        if (cons >= 1) {
            $crearMarca.html('No es ninguna <i class="right mdi-content-add"></i>');
        }
    } else {
        $resultCont.html('');
    }
    $crearMarca.removeClass('hide');

}

function selectBrand(idBrand) {
    setLoader();
    setCookie("idBrand", idBrand, 1);
    $.ajax({
        url: 'launcher.php',
        data: {
            idBrand: idBrand
        },
        success: function(data) {
            window.location = "redes.php";
        }
    });
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function setLoader() {
    $('.loader').removeClass('hide');
}

function createBrand() {
    setLoader()
    var marca = $('input[name="buscador"]').val();
    if (marca.length >= 3 && marca != "") {
        $.ajax({
                url: 'saveData.php',
                type: 'POST',
                data: {
                    marca: marca
                },
            })
            .done(function() {
                $.ajax({
                    url: 'launcher.php',
                    done: function(data) {
                    }
                });
            });
           setTimeout(function(){ window.location = "redes.php"; }, 3000);
    } else {
        alert("Error marca");
    }

}